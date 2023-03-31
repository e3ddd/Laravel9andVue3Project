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
                                    <span class="minus" :id="key" @click="decrementCount">-</span>
                                    <input type="text" @input="countProductTotalPrice" :id="key" v-model="product.quantity">
                                    <span class="plus" :id="key" @click="incrementCount">+</span>
                                </div>
                            </div>
                        </div>
                    <div class="col-3 price mt-2">
                        <div class="row">
                            <div class="col-8">
                                {{product.total_price}} UAH
                            </div>
                            <div class="col-4 cross" :id="product.id" @click="del">
                                &times;
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-5"></div>
                <div class="col-2 mt-2">Total price:</div>
                <div class="col-3 mt-2">
                     {{this.products.sum}} UAH
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
            products: {},
        }
    },

    computed: {
        products() {}
    },

    created() {
        this.getProducts()
        this.getUserShoppingCart()
    },


    methods: {
        countTotalPrice() {
            let tmpSum = 0
            this.products.map((item) => {
                tmpSum += Number(item.total_price)
            })
            this.products.sum = (tmpSum).toFixed(2)
        },


        countProductTotalPrice(event) {
            this.products[event.target.id].total_price = (this.products[event.target.id].price * this.products[event.target.id].quantity).toFixed(2)
            if(!Number.isInteger(this.products[event.target.id].quantity)){
                this.products[event.target.id].quantity = Number(this.products[event.target.id].quantity)
            }

            if(this.products[event.target.id].quantity <= 0){
                this.products[event.target.id].total_price = this.products[event.target.id].price
                this.products[event.target.id].quantity = 1
            }

            this.countTotalPrice()
        },

        decrementCount(event) {
                if(this.products[event.target.id].quantity != 1){
                    --this.products[event.target.id].quantity
                    this.products[event.target.id].total_price = (this.products[event.target.id].total_price - this.products[event.target.id].price).toFixed(2)
                }else{
                    this.products[event.target.id].quantity = 1
                }
            this.updateQuantity(this.products[event.target.id].id, this.products[event.target.id].quantity)
            this.countTotalPrice()
        },

        incrementCount(event) {
            ++this.products[event.target.id].quantity
            this.updateQuantity(this.products[event.target.id].id, this.products[event.target.id].quantity)

            this.products[event.target.id].total_price = (this.products[event.target.id].price * this.products[event.target.id].quantity).toFixed(2)

            this.countTotalPrice()
        },

        async updateQuantity(productId, quantity) {
            const response = await axios.post('/update_product_quantity', {
                productId: productId,
                quantity: quantity,
            })
        },

        async getUserShoppingCart() {
            const response = axios.get('/get_user_shopping_cart', {})
                .then((response) => {
                    this.products.map((item, key) => {
                        if(response.data[item.id]){
                            this.products[key].quantity = response.data[item.id].quantity
                            this.products[key].total_price = (this.products[key].price * response.data[item.id].quantity).toFixed(2)
                        }
                    })
                    this.products.sum = 0.00
                    this.countTotalPrice()
                })
                .catch(err => console.log(err))
        },

        async getProducts() {
            const response = await axios.get('/get_user_products_from_shopping_cart')
                .then((response) => {
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
