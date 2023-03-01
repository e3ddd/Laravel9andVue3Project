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
            product: {
                0: {name: 'name', order: 0, value: ''},
                1: {name: 'price', order: 1, value: ''},
                2: {name: 'producer', order: 2, value: ''},
                3: {name: 'description', order: 3, value: ''},
            },
        }
    },
    methods: {
    }
}
</script>

<style scoped>

</style>
