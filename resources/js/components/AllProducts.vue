<template>
    <div class="container page">
        <div class="row">
          <categories-list
              :mainCategory="''"
              :categories="this.categories"
          />
            <div class="col-10 products">
                <div class="row">
        <div class="page_item" :class="{'col-lg': adaptive, 'col-4': non_adaptive}" v-for="item in products">
            <list-item
                :id="item.id"
                :email="item.user.email"
                :name="item.name"
                :price="item.price"
                :description="item.description"
                :images="item.image"
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
import ListItem from "./AllProductsList/ListItem.vue";
import Paginator from "./UserList/Paginator.vue";
import CategoriesList from "./AllProductsList/ByCategory/CategoriesList.vue";
import Math from "lodash";
export default {
    components: {
        ListItem,
        Paginator,
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
            categories: []
        }
    },

    created() {
        this.onAdaptive()
        this.getCategories()
        window.addEventListener("resize", this.onAdaptive);
    },

    mounted() {
        this.getProducts(this.page)
        },

    methods: {

        async getCategories()
        {
            const response = axios.post('get_categories')
                .then((response) => {
                    this.categories = response.data
                })
        },

        onAdaptive() {
            if(window.innerWidth < 1200){
                this.adaptive = true
                this.non_adaptive = false
            }else{
                this.adaptive = false
                this.non_adaptive = true
            }
        },

        onUpdate() {
            this.products = []
        },

        async getProducts(page) {
            console.log(page)
            const response = await axios.get('/products_list?page=' + page)
                .then((response) => {
                    this.total = Math.ceil(response.data.total / this.limit)
                    this.products = response.data.data
            })
        },
    }
}
</script>

<style scoped>
.products {
    border: 2px solid silver;
    box-shadow: 3px 3px 3px lightgray;
}
</style>
