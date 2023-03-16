<template>
    <div class="container-fluid page">
        <div class="row">
            <div class="col-sm-3">
                <categories-list
                    :mainCategory="this.category_name"
                    :categories="this.subcategories"
                />
            </div>
            <div class="col-lg-9 products">
                <div class="all__link">
                    <a href="/home">products</a>&#187;<a :href="'products/' + this.category_name">{{this.category_name}}</a>
                </div>
                  <div class="row">
                    <div class="col-3" v-for="product in products">
                        <list-item
                            :product="product.data"
                        />
                    </div>
                  </div>
                <paginator
                    v-model:total="total"
                    :get="getProducts"
                    @update="onUpdate"
                />
            </div>
        </div>
    </div>

</template>

<script>
import CategoriesList from "./CategoriesList.vue";
import Paginator from "../../UserList/Paginator.vue";
import ListItem from "../ListItem.vue";
import Math from "lodash";
export default {
    components: {
        Paginator,
        ListItem,
        CategoriesList
    },

    data() {
        return {
            limit: 9,
            total: 1,
            page: 1,
            products: [],
            category_name: window.location.href.substring(31),
            subcategories: []
        }
    },


    created() {
        this.getProducts(this.page)
        this.getSubcategories()
        this.rightLinks()
    },

    methods: {
        rightLinks() {
            for (const key in this.category_name.split('%20',)){
                if(this.category_name.includes('%20')) {
                    this.category_name = this.category_name.replace('%20', ' ')
                }
            }
        },

        async getSubcategories()
        {
            const response = await axios.get('/get_subcategories', {
                params: {
                    category: this.category_name
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
            const response = await axios.get('/admin/get_all_products_by_category?page=' + page, {
                params: {
                    categoryName: this.category_name
                }
            })
                .then((response) => {
                    this.products = response.data
                    console.log(response)
                })
                .catch(err => console.log(err))
        },
    }
}
</script>

<style scoped>
.products {
    border: 2px solid silver;
    box-shadow: 3px 3px 3px lightgray;
}

.all__link a {
    padding: 10px;
    text-decoration: none;
    text-transform: uppercase;
    color: black;
    font-size: 14px;
}

.all__link a:hover {
    text-decoration: underline;
    color: #df4949;
}
</style>
