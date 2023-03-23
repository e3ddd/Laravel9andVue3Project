<template>
    <div class="container page">
        <div class="row">
            <div class="col-sm-3">
                <categories-list
                    :mainCategory="this.category"
                    :subcategories="this.subcategories"
                />
            </div>
            <div class="col-lg-9 products">
                <product-list-by-category
                    :category="this.category"
                    :products="this.products"
                />
                <div class="row">
                    <div class="col">
                        <paginator
                            v-model:total="total"
                            :get="getProducts"
                            @update="onUpdate"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CategoriesList from "./CategoriesList.vue";
import Paginator from "../../UserList/Paginator.vue";
import ProductListByCategory from "./ProductListByCategory.vue";
import Math from "lodash";

export default {
    components: {
        Paginator,
        CategoriesList,
        ProductListByCategory
    },

    data() {
        return {
            limit: 9,
            total: 1,
            page: 1,
            products: [],
            category: window.location.href,
            subcategories: [],
            user: ''
        }
    },


    created() {
        this.rightLinks()
        this.getSubcategories()
        this.getProducts(this.page)
    },

    methods: {

        rightLinks() {
            this.category = decodeURI(this.category.split('/')[4])
        },

        async getSubcategories()
        {
            const response = await axios.get('/get_subcategories_by_parent_category_name', {
                params: {
                    categoryName: this.category
                }
            })
                .then((response) => {
                    this.subcategories = response.data
                })
                .catch((err) => {
                    console.log(err)
                })
        },

        onUpdate() {
            this.products = []
        },

        async getProducts(page) {
            const response = await axios.get('/get_all_products_by_category_name?page=' + page, {
                params: {
                    categoryName: this.category
                }
            })
                .then((response) => {
                    this.products = response.data.data
                    this.total = Math.ceil(response.data.total / response.data.per_page)
                })
                .catch(err => console.log(err))
        },
    }
}
</script>

<style scoped>
.page {
    margin-top: 50px;
}

.products {
    border: 2px solid silver;
    box-shadow: 3px 3px 3px lightgray;
}

</style>
