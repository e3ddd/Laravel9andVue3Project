<template>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <create-product/>
            </div>
            <div class="col-8">

            </div>
        </div>
    </div>
</template>

<script>

import CreateProduct from "./CreateProduct.vue";
export default {
    components: {
        CreateProduct
    },

    data() {
        return {

        }
    },

    created() {
    },

    methods: {

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
