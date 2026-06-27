Vue.component('products-search', {
    data() {
        return {
            route: 'products',
            products: [],
            filter: {
                text: '',
                category_id: null,
                price: {
                    max: null,
                    min: null,
                },
                view_only: [],
            },
            lang: LANG,
            categories: [],
            sort: '',
            order_by: 'desc',
            limit: '30',
            isLoading: false,
            page: {
                currentPage: 1,
                totalPages: 0,
                totalItems: 0,
                itemsPerPage: 10
            },
        }
    },
    props: {
        text: null,
        category: null,
        discount: null,
        mostSales: null,
        newArrivals: null,

    },
    mounted() {
        $('#breadcrumbs').css('display', 'flex');
        if (this.discount) {
            this.filter.view_only.push('discount')
        }
        if (this.mostSales) {
            this.filter.view_only.push('most_sales')
        }
        if (this.newArrivals) {
            this.filter.view_only.push('new_arrivals')
        }
        if (this.category) {
            this.filter.category_id = this.category;
        }
        this.fetchData();
        this.getCategories();
    },
    watch: {
        "filter.price.min": function (val) {
            this.fetchData();
        },
        "filter.price.max": function (val) {
            this.fetchData();
        },
        "filter.view_only": function (val) {
            this.fetchData();
        }
    },
    methods: {
        fetchData() {
            if (this.text) {
                this.filter.text = this.text;
            }
            this.isLoading = true;
            axios.get(BASE_URL + '/' + this.route + '/data', {
                params: {
                    page: this.page.currentPage,
                    filter: this.filter,
                    sort: this.sort,
                    order_by: this.order_by,
                    limit: this.limit
                }
            }).then(response => {
                this.isLoading = false;
                this.products = response.data.data.data;
                this.page.totalPages = response.data.data.meta.last_page;
                this.page.totalItems = response.data.data.meta.total;
            }).catch(error => {
                this.isLoading = false;
            });
        },
        getCategories() {
            axios.get(BASE_URL + '/categories/all', {}).then(response => {
                this.categories = response.data.data;
            }).catch(error => {
            });
        },
        onCategory(category) {
            $('#breadcrumbs').css('display', 'none');
            //$('#breadcrumbs').css('display', 'flex');

            if (category) {
                this.filter.category_id = category.id;

                window.history.pushState("", "", '/' + this.lang + '/products?category=' + category.slug);
                $('#breadcrumbs2').html('<ol class="breadcrumb float-left" id="breadcrumbs">' +
                    '<li class="breadcrumb-item"><a href="/">' + this.$t("home") + '</a></li>'+
                   ' <li class="breadcrumb-item active">' +
                   ' <a href="">'+category.text+'</a>'+
                    '</li>'
                );
            } else {
                this.filter.category_id = null;
                window.history.pushState("", "", '/' + this.lang + '/products');
                $('#breadcrumbs2').html('<ol class="breadcrumb float-left" id="breadcrumbs">' +
                    '<li class="breadcrumb-item"><a href="/">' + this.$t("home") + '</a></li>'+
                    ' <li class="breadcrumb-item active">' +
                    ' <a href="">'+this.$t('all_categories')+'</a>'+
                    '</li>'
                );
            }
            this.fetchData(true);
        },
        nextPage(val) {
            this.page.currentPage = val;
            this.fetchData();
        },
        sortBy(event) {
            this.sort = event.target.value;
            this.fetchData();
        },
        onLimit(event) {
            this.limit = event.target.value;
            this.fetchData();
        },
        addToWishlist(item) {
            axios.post(BASE_URL + '/' + this.route + '/add-to-wishlist', {
                id: item.id,
            }).then(response => {
                if (response.data.data === null) {
                    $('#favorite_' + item.id).removeClass('fas');
                    $('#favorite_' + item.id).addClass('far');
                    $('#favorite_2' + item.id).removeClass('fas');
                    $('#favorite_2' + item.id).addClass('far');
                } else {
                    $('#favorite_' + item.id).removeClass('far');
                    $('#favorite_' + item.id).addClass('fas');
                    $('#favorite_2' + item.id).removeClass('far');
                    $('#favorite_2' + item.id).addClass('fas');
                }
                toastSuccess(response.data.message);
                this.$store.dispatch('getCountItemFavorites')
            }).catch(error => {
                toastError(error);
            });
        },
        addToCart(item) {
            axios.post(BASE_URL + '/cart/add', {
                item: item,
            }).then(response => {
                toastSuccess(response.data.message);
                this.$store.dispatch('getCart')
                open_cart($('#cd-cart'), $('#cd-shadow-layer'), $('body'));
            }).catch(error => {
                toastError(error);
            });
        }
    }
});
