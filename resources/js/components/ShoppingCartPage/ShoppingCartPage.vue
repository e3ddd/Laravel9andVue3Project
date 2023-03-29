<template>
    <div class="container shopping_cart_page">
        <div class="row" v-if="this.products.length == 0">
            <div class="col d-flex justify-content-center align-content-center">
                <h1>Shopping cart is empty !</h1>
            </div>
        </div>
        <div class="row">
                <div class="row product" v-for="(product,key) in this.products">
                    <div class="col-2 image">
                        <img :src="'/storage/images/SMALL_' + product.image[0].product_id + '_' + product.image[0].hash_id">
                    </div>
                    <div class="col-5  name">
                        {{product.name}}
                    </div>
                    <div class="col-2 amount">
                        <div class="row">
                                <div class="col amount_item">
                                    <span class="minus" :id="product.id" @click="decrementCount">-</span>
                                    <input type="text" v-model="this.quantity[product.id].quantity">
                                    <span class="plus" :id="product.id" @click="incrementCount">+</span>
                                </div>
                            </div>
                        </div>
                    <div class="col-3 price mt-2">
                        <div class="row">
                            <div class="col-8">
                                {{(product.price * this.quantity[product.id].quantity).toFixed(2)}} UAH
                            </div>
                            <div class="col-4 cross" :id="product.id" @click="del">
                                &times;
                            </div>
                        </div>
                    </div>
                </div>
            <form action="/checkout" v-if="this.products.length !== 0">
                <div class="row checkoutBtn">
                    <div class="col">
                        <input type="submit" value="Checkout">
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
            quantity: {}
        }
    },

    created() {
        this.getProducts()
        this.getUserShoppingCart()
    },

    methods: {
        decrementCount(event) {
                if(this.quantity[event.target.id].quantity != 1){
                    --this.quantity[event.target.id].quantity
                }else{
                    this.quantity[event.target.id].quantity = 1
                }
                this.updateQuantity(this.quantity[event.target.id].productId, this.quantity[event.target.id].quantity, event.target.id)
        },

        incrementCount(event) {
            ++this.quantity[event.target.id].quantity
            this.updateQuantity(this.quantity[event.target.id].productId, this.quantity[event.target.id].quantity, event.target.id)
        },

        async updateQuantity(productId, quantity, id) {
            const response = await axios.post('/update_product_quantity', {
                productId: productId,
                quantity: quantity,
            })
        },

        async getUserShoppingCart() {
            const response = axios.get('/get_user_shopping_cart', {})
                .then((response) => {
                    for (const key in response.data) {
                        this.quantity[response.data[key][0].product_id] = {
                            productId: response.data[key][0].product_id,
                            quantity:  response.data[key][0].quantity
                        }
                    }
                })
                .catch(err => console.log(err))
        },

        async getProducts() {
            const response = await axios.get('/get_user_products_from_shopping_cart')
                .then((response) => {
                    console.log(response)
                    this.products = response.data
                })
                .catch(err => console.log(err))
        },

        async checkout() {
            const response = await axios.get('/checkout')
                .then(response => console.log(response))
        },

       async del(event) {
            const response = await axios.post('/delete_from_shopping_cart', {
                    shoppingCartProductId: event.target.id
            })
                .catch(err => console.log(err))
        }


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

.cross {
    cursor: pointer;
    user-select: none;
    font-size: 20px;
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

.checkoutBtn input{
    border-radius: 10px;
    color: white;
    border: 1px solid #df4949;
    padding: 10px;
    background: #df4949;

}

.checkoutBtn input:hover {
    transition: 0.5s;
    background: #661515;
}

</style>
