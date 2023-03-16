<template>
        <div class="row list_item d-flex justify-content-center" v-for="item in product">

                <img :src="'/storage/images/' + item.image[0].product_id + '_' + item.image[0].hash_id"/>

                {{item.name}}


        </div>
</template>

<script>
import ViewProduct from "./ViewProduct.vue";
import ActionBtn from "../UserList/ActionBtn.vue";

export default {
    components: {
        ViewProduct,
        ActionBtn
    },

    data() {
        return {

        }
    },

   props: {
        product: Array
   },

    mounted() {

    },

    methods: {

    }
}
</script>

<style scoped>
.list_item {
    width: 50%;
    padding: 5px;
    margin: 5px;
    border: 2px solid silver;
    box-shadow: 2px 2px 2px silver;
}

.list_item img {
    z-index: -1;
}
</style>
