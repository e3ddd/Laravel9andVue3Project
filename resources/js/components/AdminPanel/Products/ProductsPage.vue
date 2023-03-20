<template>
    <div class="container-fluid page">
        <div class="row">
            <div class="col-sm-5">
                <div class="row">
                    <create-product/>
                </div>
                <div class="row">
                    <add-attributes-value/>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <product-list/>
                </div>
            </div>
        </div>
    </div>







</template>

<script>

import CreateProduct from "./CreateProduct.vue";
import AddAttributesValue from "./AddAttributesValue.vue";
import ProductList from "./ProductList.vue";
export default {
    components: {
        AddAttributesValue,
        ProductList,
        CreateProduct
    },

    data() {
        return {

        }
    },

    methods: {
    }
}
</script>

<style scoped>
.page {
    margin-top: 50px;
    border: 2px solid silver;
    padding: 20px;
}
</style>
