<template>
        <div class="row">
            <div class="col">
                 <a :href="'/products/' + product.name + '/about'">
                    <div class="row">
                        <img :src="'/storage/images/' + product.image[0].product_id + '_' + product.image[0].hash_id"/>
                    </div>
                    <div class="row">
                        <b>{{product.name}}</b>
                    </div>
                </a>
                <div class="row">
                    <div class="col button">
                        <action-btn>
                            Buy
                        </action-btn>
                    </div>
                </div>
            </div>
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

   props: {
        product: Array
   },
}
</script>

<style scoped>
a {
    color: black;
    text-decoration: none;
  }
.button {
    text-align: end;
}
</style>
