<template>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-4">
                        <h1>{{product.price}}</h1>
                    </div>
                    <div class="col-2 mt-3"><h5>UAH</h5></div>
                    <div class="col-6 mt-3"><h5>/ a peace</h5></div>
                </div>
                <div class="row">
                    <a :href="'/' + 'shopping_cart'" class="buyBtn" @click="buyProduct">Buy</a>
                </div>
            </div>
        </div>

        <label class="attributesLabel" for="attributes">
            <h5>Product attributes:</h5>
        </label>

        <div id="attributes" class="row" v-for="(attribute,key) in attributes">
            <div class="col-4 name">
                {{key}}:
            </div>
            <div class="col value">
                {{attribute.value}}
                <span v-if="attribute.type !== 'string' && attribute.type !== 'number'">
                    {{attribute.type}}
                </span>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        product: Array,
        attributes: Array,
    },

    data() {
        return {
            user: '',
        }
    },

    created() {
        this.getUser()
    },

    methods: {
        async getUser() {
            const response = await axios.get('/get_user')
                .then((response) => {
                    this.user = response.data.name
                })
        },

        async buyProduct() {
            const response = await axios.get('/buy_product', {
                params: {
                    productId: this.product.id,
                }
            })
                .then((response) => {
                    console.log(response)
                })
                .catch(err => console.log(err))
        }
    }
}
</script>

<style scoped>
.buyBtn {
    text-decoration: none;
    cursor: pointer;
    padding-top: 7px;
    text-align: center;
    font-size: 24px;
    height: 50px;
    border-radius: 5px;
    border: none;
    background: #ff3838;
    color: white;
    box-shadow: 2px 2px 5px grey;
    margin: 5px;
}

.buyBtn:hover {
    background: #661515;
    transition: 0.4s;
    color: white;
}

.attributesLabel {
    margin-top: 50px;
}

.name:first-letter {
    text-transform: uppercase;
}
</style>
