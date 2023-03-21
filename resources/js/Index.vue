<template>
    <div class="container-fluid page">
        <div class="row">
            <div class="col">
                <main-categories-list
                    :categories="this.categories"
                    :subcategories="this.subcategories"
                />
            </div>
        </div>
        </div>
</template>

<script>
import MainCategoriesList from "./components/CategoiesList/ByCategory/MainCategoriesList.vue";
export default {
    components: {
        MainCategoriesList
    },

    data() {
        return {
            products: [],
            categories: [],
            subcategories:[]

        }
    },

    created() {
        this.getCategories()
    },

    mounted() {
        this.getProducts(this.page)
    },

    methods: {

        async getCategories()
        {
            const response = axios.get('/get_all_categories')
                .then((response) => {
                    this.categories = response.data.filter(item => item.parent_id == null)
                    this.subcategories = response.data.filter(item => item.parent_id !== null)
                })
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
</style>
