<template>
    <div class="container adminPanel">
        <div class="createCategory">
        <div class="row">
            <h4 class="d-flex justify-content-center">Create Category</h4>
        </div>
            <create-category/>
        </div>
        <div class="container-fluid categoryListTable">
            <categories-list/>
        </div>
    </div>
</template>

<script>
import CategoriesList from "./CategoriesList.vue";
import CreateCategory from "./CreateCategory.vue";
export default {
components: {
    CategoriesList,
    CreateCategory
}
}
</script>

<style scoped>
.adminPanel {
    padding: 20px;
}

.createCategory {
    border: 2px solid silver;
    box-shadow: 2px 2px 2px silver;
    width: 280px;
    height: 220px;
}

.categoryListTable {
    margin-top: 50px;
}
</style>
