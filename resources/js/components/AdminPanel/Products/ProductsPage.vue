<template>
    <div class="container-fluid">
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
</template>

<script>

import CreateProduct from "./CreateProduct.vue";
import AddAttributesValue from "./AddAttributesValue.vue";
export default {
    components: {
        AddAttributesValue,
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

</style>
