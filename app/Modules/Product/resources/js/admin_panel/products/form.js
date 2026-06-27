import VJstree from 'vue-jstree'
import myUpload from 'vue-image-crop-upload/upload-2.vue';

Vue.component('product-form', {
    data() {
        return {
            route: 'products',
            id: null,
            name: languages(),
            short_description: languages(),
            description: languages(),
            basic_configuration: languages(),
            is_active: false,
            price: null,
            youtube: null,
            discount_percentage: null,
            qty: null,
            category: null,
            image_gallery: [],
            main_image: null,
            icon: null,
            pdf: null,
            pdf_url: null,
            main_image_url: null,
            icon_url: null,
            categories: [],
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
            options: {
                toolbar1: 'formatselect | fontselect | fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | help ',
                language_url: null,
                height: 500,
                images_upload_url: ROOT_URL + '/uploads/editor',
                directionality: LANG === 'ar' ? 'rtl' : 'ltr',  //ltr,rtl
            },
            loading: false,
            attribute_id: null,
            attributes: [],
            attributeSets: [],
            attributeValues: [],
            selectAttributeValues: [],
            rowsAttributes: [
                {
                    attribute_id: null,
                    values: []
                }
            ],
            rowsOptions: [
                {
                    name: languages(),
                    type: '',
                    values: [
                        {
                            label: languages(),
                            price: null,
                            price_type: null,
                        }
                    ],
                }
            ],
            index: 0,

            headers: {
                'X-CSRF-TOKEN': TOKN,
            },
            show: false,
            imgDataUrl: userImageDefault(), // the base64 url of created image
        }
    },
    components: {
        VJstree,
        myUpload
    },
    props: {
        product: null,
    },
    watch: {
        rowsAttributes: {
            handler(val) {
                let length = val.length;
                this.index = length - 1;
                if (length > 0) {
                    this.attribute_id = val[this.index]['attribute_id'];
                }
            },
            deep: true
        },
        attribute_id: function (val) {
            if (val)
                this.getValues(null, val);
        }
    },
    mounted() {

        this.getAttributes();

        this.getCategories();

        if (LANG === 'ar') {
            this.options.language_url = '/app/tinymce_languages/langs/ar.js';
        }

        if (this.product) {
            this.id = this.product.id;
            this.name = this.product.name;
            this.short_description = this.product.short_description;
            this.description = this.product.description;
            this.is_active = this.product.is_active;
            this.price = this.product.price;
            this.discount_percentage = this.product.discount_percentage;
            this.qty = this.product.qty;
            this.main_image = this.product.main_image;
            this.icon = this.product.icon;
            this.main_image_url = this.product.main_image_url;
            this.imgDataUrl = this.product.main_image_url;
            this.icon_url = this.product.icon_url;
            this.pdf = this.product.pdf;
            this.pdf_url = this.product.pdf_url;
            this.image_gallery = this.product.gallery;
            this.rowsAttributes = this.product.rows_attributes;
            this.rowsOptions = this.product.rows_options;
            this.basic_configuration = this.product.basic_configuration;
            this.youtube = this.product.youtube;

            this.category = this.product.category_id;

            setTimeout(() => {
                _.forEach(this.categories, (data, index) => {
                    if (data.id == this.category) {
                        this.categories[index]['selected'] = true;
                    }
                });
            }, 300)
        }
    },
    methods: {
        deleteRowOptionsValues(index, i) {
            Vue.delete(this.rowsOptions[index]['values'], i);
        },
        deleteRowOptions(index) {
            this.index = index;
            Vue.delete(this.rowsOptions, index);
        },
        addRowOptions() {
            let count = 0;

            _.forEach(this.rowsOptions, (data, index) => {
                if (data.type == 2) {
                    ++count
                }
            });
            if (count === 3) {
                swalError(this.$t('max_add_options'));
                return false;
            }

            this.rowsOptions.push({
                name: languages(),
                type: '',
                values: [
                    {
                        label: languages(),
                        price: null,
                        price_type: null,
                    }
                ],
            });
        },
        addRowOptionsValues(index) {
            this.rowsOptions[index]["values"].push({
                label: languages(),
                price: null,
                price_type: null,
            });
        },
        deleteRowAttributes(index) {
            this.index = index;
            Vue.delete(this.rowsAttributes, index);
        },
        addRowAttributes() {
            this.attributeValues = [];
            this.rowsAttributes.push({
                attribute_id: null,
                values: []
            });
        },
        onChangeGetValuesSelectElement(event, index) {
            this.attribute_id = this.rowsAttributes[index].attribute_id;
            this.getValues();
        },
        getValues(query, attribute_id = null) {
            //convert to client side
            if (query !== '') {
                this.loading = true;
                _.forEach(this.attributeSets, (data, index) => {
                    _.forEach(data.options, (d, i) => {
                        if (d.id === this.attribute_id) {
                            this.attributeValues = d.values;
                        }
                    });
                });
                this.loading = false;
                // axios.get(ADMIN_URL + '/attribute-values/search', {
                //     params: {
                //         filter: query,
                //         attribute_id: this.attribute_id
                //     }
                // }).then(response => {
                //     this.loading = false;
                //     this.attributeValues = response.data.data;
                // })
            } else {
                this.loading = false;
                this.attributeValues = [];
            }
        },
        getAttributes() {
            axios.get(ADMIN_URL + '/attributes/all', {}).then(response => {
                this.attributes = _.groupBy(response.data.data, "attribute_set_name");
                _.forEach(this.attributes, (data, index) => {
                    this.attributeSets.push({
                        label: index,
                        options: data
                    });
                });
            }).catch(error => {
            });
        },
        getCategories() {
            axios.get(ADMIN_URL + '/categories/data', {}).then(response => {
                this.categories = response.data.data;
                this.collapseAll();
            }).catch(error => {
            });
        },
        collapseAll() {
            $.each(this.categories, (index, obj) => {
                obj.opened = false;

                if (obj.hasOwnProperty('children')) {
                    this.each(obj.children, false);
                }
            });
        },
        nodeClick(node) {
            this.category = node.model.id;
        },
        save() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                id: this.id,
                main_image: this.handlerImage(),
                image_gallery: this.handlerImageGallery(),
                icon: this.handlerIcon(),
                name: this.name,
                description: this.description,
                short_description: this.short_description,
                price: this.price,
                discount_percentage: this.discount_percentage,
                qty: this.qty,
                category: this.category,
                rowsAttributes: this.rowsAttributes,
                rowsOptions: this.rowsOptions,
                is_active: this.is_active,
                basic_configuration: this.basic_configuration,
                youtube: this.youtube,
                pdf: this.handlerPDF(),
            }).then(response => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                this.reset();
                swalSuccess(response.data.message);
                adminRedirectTo(this.route);
            }).catch(error => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                this.form.validation = error.response.data.errors;
                swalError(error);
            })
        },
        handlerImage() {
            if (this.main_image != null && this.main_image['file_link'] != null)
                this.main_image = this.main_image['file_link'] ? this.main_image['file_link'] : this.main_image

            return this.main_image
        },
        handlerIcon() {
            if (this.icon != null && this.icon['file_link'] != null){
                this.icon = this.icon['file_link'] ? this.icon['file_link'] : this.icon
            }

            // if (this.icon && this.icon['file_link'] == null) {
            //     this.icon = null;
            //     this.icon_url = null;
            // }
            // console.log(this.icon && this.icon['file_link'] == null)

            return this.icon
        },
        handlerPDF() {
            if (this.pdf != null)
            {
                this.pdf = this.pdf['file_link'] ? this.pdf['file_link'] : this.pdf
                return this.pdf
            }
            return null;

        },
        handlerImageGallery() {
            // if (this.image_gallery.length > 0)
            //     $.each(this.image_gallery, (index, obj) => {
            //         this.image_gallery[index] = obj['file_link'] ? obj['file_link'] : obj
            //     });
            return this.image_gallery
        },
        reset() {
            this.id = null;
            this.name = languages();
            this.short_description = languages();
            this.description = languages();
            this.is_active = false;
            this.attribute_id = null;
            this.price = null;
            this.discount_percentage = null;
            this.qty = null;
            this.category = null;
            this.image_gallery = [];
            this.main_image = null;
            this.main_image_url = null;
            this.rowsAttributes = [
                {
                    attribute_id: null,
                    values: []
                }
            ];
            this.rowsOptions = [
                {
                    name: languages(),
                    type: '',
                    values: [
                        {
                            label: languages(),
                            price: null,
                            price_type: null,
                        }
                    ],
                }
            ];
            this.index = 0;
            this.form.validation = null;
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
        },

        toggleShow(key = null) {
            this.show = !this.show;
        },
        cropSuccess(imgDataUrl, field) {
            console.log('-------- crop success --------');
            this.imgDataUrl = imgDataUrl;
        },
        cropUploadSuccess(jsonData, field) {
            console.log('-------- upload success --------');
            this.main_image = jsonData.location;
        },
        cropUploadFail(status, field) {
            console.log('-------- upload fail --------');
            swalError(status);
        },

    }
});
