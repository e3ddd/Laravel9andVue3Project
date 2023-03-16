<template>
    <div class="container page">
        <div class="row">
            <div class="col-10 products">
                <div class="all__link">
                    <a href="/home">products</a>&#187;
                    <a :href="'/' + this.categories[0] + '/' + this.categories[1]">{{this.categories[1]}}</a>&#187;
                    <a :href="'/' + this.categories[0] + '/' + this.categories[1] + '/' + this.categories[2]">{{this.categories[2]}}</a>
                </div>
                <div class="row">
                    <div class="page_item" v-for="item in products">
                        <list-item

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
            limit: 9,
            total: 1,
            page: 1,
            products: [],
            adaptive: false,
            non_adaptive: true,
            categories: window.location.href
                .replace(/^http:\/\/127.0.0.1:8000\//, '')
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
            this.categories = arr
        },
        onUpdate() {
            this.products = []
        },

        async getProducts(page) {

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
