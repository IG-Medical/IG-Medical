Vue.component('product-details', {
    data() {
        return {
            route: 'products',
            price: 0,
            input_qty: 1,
            checkbox: [],
            options: [],
            radio_1: null,
            radio_2: null,
            radio_3: null,
            price_after_discount: null,
            total_price: 0.00,
            currency: CURRENCY_ISO,
        }
    },
    props: {
        product: null,
        cartQty: null,
        productOptions: null,
    },
    mounted() {
        if (this.product) {
            this.total_price = parseFloat(this.product.price_after_discount);
        }
    },
    watch: {},
    methods: {
        // handlerRadio() {
        //     if (this.productOptions) {
        //
        //         $.each(this.productOptions, (i, o) => {
        //
        //             // checkbox
        //             if (o['type'] === 1) {
        //             }
        //
        //             // radio
        //             if (o['type'] === 2) {
        //                 $.each(o['values'], (indx, v) => {
        //                 });
        //             }
        //         });
        //     }
        // },
        resetOptionRadio(groupNum = 1) {
            let prices = [];

            $('.div-radio-' + groupNum + ' label').removeClass('active');
            let radio_id = 0;

            if (groupNum === 1) {
                radio_id = this.radio_1;
                this.radio_1 = null;
                //prices.push();
            }
            if (groupNum === 2) {
                radio_id = this.radio_2;
                this.radio_2 = null;
            }
            if (groupNum === 3) {
                radio_id = this.radio_3;
                this.radio_3 = null;
            }

            let indexOptions = null;

            let old_price = 0;

            $.each(this.options, (index, option) => {
                if (option.id == radio_id) {
                    indexOptions = index;
                    old_price = parseFloat(option.price);
                }
            });
            if (indexOptions != null) {
                this.options.splice(indexOptions, 1)
                if (old_price) {
                    let total = this.total_price - old_price;
                    this.total_price = parseFloat(total.toFixed(2));
                }
            }

        },
        addToWishlist() {
            axios.post(BASE_URL + '/' + this.route + '/add-to-wishlist', {
                id: this.product.id,
            }).then(response => {
                if (response.data.data === null) {
                    $('#favorite').removeClass('fas');
                    $('#favorite').addClass('far');
                } else {
                    $('#favorite').removeClass('far');
                    $('#favorite').addClass('fas');
                }
                toastSuccess(response.data.message);
                this.$store.dispatch('getCountItemFavorites')
            }).catch(error => {
                toastError(error);
            });
        },
        addToCart() {
            if (this.radio_1)
                this.checkbox.push(this.radio_1);

            if (this.radio_2)
                this.checkbox.push(this.radio_2);

            if (this.radio_3)
                this.checkbox.push(this.radio_3);

            axios.post(BASE_URL + '/cart/add', {
                item: {
                    id: this.product.id,
                    name: this.product.name,
                    slug: this.product.slug,
                    price: this.total_price,
                    price_after_discount: this.total_price,
                    qty: this.input_qty,
                    new_qty: this.input_qty,
                    options: this.options,
                    checkbox: this.checkbox,
                    main_image_url: this.product.main_image_url,
                },
            }).then(response => {
                toastSuccess(response.data.message);
                this.$store.dispatch('getCart')
            }).catch(error => {
                toastError(error);
            });
        },
        onChangeOptions(event, obj, type, groupNum = 1) {

            let is_checked = event.target.checked;
            let obj_price = obj.price ? parseFloat(obj.price) : 0;

            if (type === 1) {

                if (is_checked) {
                    this.options.push(
                        {
                            id: obj.id,
                            label: obj.label,
                            price: obj_price,
                            option_id: obj.option_id,
                            type: 1
                        }
                    );

                    if (obj_price) {
                        let total = this.total_price + obj_price;
                        this.total_price = parseFloat(total.toFixed(2));
                    }


                } else {
                    let indexOptions = null;

                    $.each(this.options, (index, option) => {
                        if (option.id === obj.id) {
                            indexOptions = index;
                        }
                    });
                    if (indexOptions != null) {
                        if (obj_price) {
                            let total = this.total_price - obj_price;
                            this.total_price = parseFloat(total.toFixed(2));
                        }
                        this.options.splice(indexOptions, 1)
                    }
                }
            }

            if (type === 2) {
                $('.div-radio-' + groupNum + ' label').removeClass('active');
                $('#label_radio_' + obj.id).addClass('active');

                let indexOptions = null;

                let old_price = 0;

                $.each(this.options, (index, option) => {
                    if (option.option_id === obj.option_id) {
                        indexOptions = index;
                        old_price = option.price;
                    }
                });


                if (indexOptions != null) {
                    this.options.splice(indexOptions, 1)
                    if (old_price) {
                        let total = this.total_price - old_price;
                        this.total_price = parseFloat(total.toFixed(2));
                    }
                }

                this.options.push(
                    {
                        id: obj.id,
                        label: obj.label,
                        price: obj_price,
                        option_id: obj.option_id,
                        type: 2
                    }
                );
                if (obj_price) {
                    let total = this.total_price + obj_price;
                    this.total_price = parseFloat(total.toFixed(2));
                }
            }
        },
        incrementQty() {
            ++this.input_qty;
        },
        decrementQty() {
            if (this.input_qty !== 1)
                --this.input_qty;
        }
    }
});
