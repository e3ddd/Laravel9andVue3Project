<template>
    <div class="container shopping_cart_page">
        <div class="row">
                <div class="row product" v-for="(product,key) in this.products">
                    <div class="col-2 image">
                        <img :src="'/storage/images/SMALL_' + product.image[0].product_id + '_' + product.image[0].hash_id">
                    </div>
                    <div class="col-6  name">
                        {{product.name}}
                    </div>
                    <div class="col-2 amount">
                        <div class="row">
                            <div class="col amount_item">
                                <span class="minus" :id="key" @click="decrementCount">-</span>
                                <input type="text" v-model="product.count">
                                <span class="plus" :id="key" @click="incrementCount">+</span></div>
                        </div>
                    </div>
                    <div class="col-2 price mt-2">
                        {{product.price}} UAH
                    </div>
                </div>
            <div class="row checkoutBtn">
                <div class="col">
                    <a href="">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
        }
    },

    created() {
      this.getProducts()
    },

    methods: {
        decrementCount(event) {
                if(this.products[event.target.id].count != 0){
                    --this.products[event.target.id].count
                }else{
                    this.products[event.target.id].count = 0
                }
        },

        incrementCount(event) {
            ++this.products[event.target.id].count
        },

        async getProducts() {
            const response = await axios.get('/get_auth_user_products_from_shopping_cart')
                .then((response) => {
                    this.products = response.data
                    this.products.forEach((item) => {
                        item.count = 0
                    })
                })
                .catch(err => console.log(err))
        },


    }
}
</script>

<style scoped>
.shopping_cart_page {
    margin-top: 50px;
    display: flex;
    justify-content: center;
}

.amount_item input{
    width: 40px;
    text-align: center;
    font-size: 14px;
    user-select: none;
}

.minus {
    cursor: pointer;
    font-size: 22px;
    margin-right: 10px;
    user-select: none;
}

.plus {
    cursor: pointer;
    font-size: 22px;
    margin-left: 10px;
    user-select: none;
}

.name {
    margin-top: 10px;
    text-align: center;
}

.product {
    background: #f8f7f7;
    padding: 10px;
}

.checkoutBtn {
    margin-top: 30px;
    text-align: right;
}

.checkoutBtn a{
    border-radius: 10px;
    color: white;
    border: 1px solid #df4949;
    padding: 10px;
    background: #df4949;
    text-decoration: none;
}

.checkoutBtn a:hover {
    transition: 0.5s;
    background: #661515;
}

</style>
