<template>
    <div class="row">
        <div class="col-5">
            <div class="container-fluid page">
                <div class="row">
                    <div class="col">
                        <create-product
                        :product="this.product"
                        />
                    </div>
                </div>

                <div class="row">
                    <div class="col mt-4">
                        <add-attributes-value/>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-7">
        <div class="container-fluid page">
            <product-list/>
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
            product: [
                 {name: 'name', order: 0, value: '', type: 'string'},
                 {name: 'price', order: 1, value: '', type: 'banknote'},
                 {name: 'producer', order: 2, value: '', type: 'string'},
                 {name: 'description', order: 3, value: '', type: 'string'},
            ],
        }
    },

    methods: {
    }
}
</script>

<style scoped>
.page {
    border: 2px solid silver;
    padding: 20px;
}
</style>
