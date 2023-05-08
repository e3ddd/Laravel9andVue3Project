<template>
    <div class="container page">
        <div class="row">
            <div class="col products">
                <div class="all__link">
                    <a href="/home">products</a>&#187;
                    <a :href="'/' + 'products' + '/' + this.category">{{this.category}}</a>&#187;
                    <a :href="'/' + 'products' + '/' + this.category + '/' + this.subcategory">{{this.subcategory}}</a>
                </div>
                <div class="row">
                    <div class="col-3 p-4" v-for="product in products">
                        <list-item
                            :product="product"
                        />
                    </div>
                    <paginator
                        v-model:total="total"
                        :get="getProducts"
                        @update="onUpdate"
                    />
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import CategoriesList from "../CategoriesList.vue";
import ListItem from "../../ListItem.vue";
import Paginator from "../../../UserList/Paginator.vue";
import Math from "lodash";
export default {
    components: {
        Paginator,
        ListItem,
        CategoriesList
    },

    data() {
        return {
            total: 1,
            page: 1,
            products: [],
            adaptive: false,
            non_adaptive: true,
            categories: window.location.href,
            category: '',
            subcategory: '',

        }
    },


    mounted() {
        this.rightLinks()
        this.getProducts(this.page)
    },

    methods: {
        rightLinks() {
            const arr = this.categories.split('/')
            for (const key in arr){
                if(arr[key].includes('%20')) {
                    if(arr[key].split('%20')){
                        for (const keyKey in arr[key]) {
                            arr[key] = arr[key].replace('%20', ' ')
                        }
                    }
                    arr[key] = arr[key].replace('%20', ' ')
                }
            }
            this.category = arr[4]
            this.subcategory = arr[5]
        },
        onUpdate() {
            this.products = []
        },

        async getProducts(page) {
            axios.get('/get_all_products_by_subcategory_name?page=' + page, {
                params: {
                    subcategoryName: this.subcategory
                }
            })
                .then((response) => {
                    this.products = response.data.data
                    this.total = Math.ceil(response.data.total / response.data.per_page)
                })
                .catch(err => console.log(err))
        },
    },
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
