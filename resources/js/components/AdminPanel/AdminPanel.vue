<template>
    <div class="container-fluid">
        <div class="row page">
            <div class="col-sm-4">
                <div class="row m-4 p-1 form">
                    <h4>Create category</h4>
                    <create-category/>
                </div>
                <div class="row m-4 p-1 form">
                    <h4>Create attribute</h4>
                    <create-attribute
                        :categories="this.categories"
                    />
                 </div>
            </div>
            <div class="col-md-8">
                <div class="row m-4">
                    <categories-list/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CategoriesList from "./Categories/CategoriesList.vue";
import CreateCategory from "./Categories/CreateCategory.vue";
import CreateAttribute from "./Attributes/CreateAttribute.vue";
export default {
    components: {
        CategoriesList,
        CreateCategory,
        CreateAttribute,
    },

    data() {
        return {
            categories: [],
        }
    },

    created() {
        this.getCategories()
        },

    methods: {
    async getCategories() {
            const response = await axios.get('/get_all_categories')
                .then((response) => {
                    this.categories = response.data
                })
     }
    }
}
</script>

<style scoped>
body {
    margin: 0;
    padding: 0;
}

.page {
    margin-top: 50px;
}

.form {
    border: 2px solid silver;
    box-shadow: 2px 2px 2px silver;
}

.createForm label {
    margin-left: 20px;
}
</style>
