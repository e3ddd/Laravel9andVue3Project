<template>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="row createForm">
                    <label><h4>Create category</h4></label>
                    <create-category/>
                </div>
                <div class="row createForm">
                    <label><h4>Create attribute</h4></label>
                    <create-attribute
                        :categories="this.categories"
                    />
                 </div>
            </div>
            <div class="col-8">
                <div class="container adminPanel">
                    <div class="container-fluid categoryListTable">
                        <categories-list/>
                    </div>
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
.adminPanel {
    padding: 20px;
}

.createForm {
    margin-top: 55px;
    padding: 10px;
    border: 2px solid silver;
    box-shadow: 2px 2px 2px silver;

}

.categoryListTable {
}
</style>
