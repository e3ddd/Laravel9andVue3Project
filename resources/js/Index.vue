<template>
    <div class="container-fluid page">
            <main-categories-list
                :categories="this.categories"
            />


        </div>
</template>

<script>
import MainCategoriesList from "./components/AllProductsList/ByCategory/MainCategoriesList.vue";
import Math from "lodash";
export default {
    components: {
        MainCategoriesList
    },

    data() {
        return {
            limit: 9,
            total: 1,
            page: 1,
            products: [],
            adaptive: false,
            non_adaptive: true,
            categories: [],
            subcategories:[]

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
                    console.log(response)
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
