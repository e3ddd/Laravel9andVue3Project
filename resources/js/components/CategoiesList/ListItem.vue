<template>
        <div class="row">
            <div class="col">
                 <a :href="'/about_product/' + product.id">
                    <div class="row">
                        <img :src="'/storage/images/' + product.image[0].product_id + '_' + product.image[0].hash_id"/>
                    </div>
                    <div class="row">
                        <b>{{product.name}}</b>
                    </div>
                </a>
                <div class="row">
                    <div class="col button">
                        <a @click="buyProduct" :href="'/shopping_cart'">Buy</a>
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
        product: Array,
        user: String
   },



    methods: {
        async buyProduct() {
            const response = await axios.get('/buy_product', {
                params: {
                    productId: this.product.id,
                }
            })
                .then((response) => {

                })
                .catch(err => console.log(err))
        }
    }

}
</script>

<style scoped>
a {
    color: black;
    text-decoration: none;
  }

.button a{
    float: right;
    padding: 5px;
    border-radius: 5px;
    border: none;
    background: #ff3838;
    color: white;
    box-shadow: 2px 2px 5px grey;
    margin: 5px;
}

.button a:hover {
    background: #661515;
    transition: 0.4s;
    color: white;
}
</style>
