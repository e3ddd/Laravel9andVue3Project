<template>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col">
                        <h1>{{product.price}}</h1>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-3 mt-4"><h6>UAH</h6></div>
                            <div class="col-9 mt-4"><h6>/ a peace</h6></div>
                        </div>
                    </div>
                    <div class="col">
                        <FavoriteMark
                        :product_id="product.id"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <a :href="'/' + 'shopping_cart'" class="buyBtn" @click="buyProduct">Buy</a>
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
        <div class="description">
            <div class="row">
                <div class="col">
                    <h5>Description:</h5>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {{product.description}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FavoriteMark from "./FavoriteMark.vue";

export default {
    components: {
        FavoriteMark
    },

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
    width: 20%;
    text-decoration: none;
    cursor: pointer;
    padding: 7px;
    text-align: center;
    font-size: 24px;
    height: 50px;
    border-radius: 5px;
    border: none;
    background: #ff3838;
    color: white;
    box-shadow: 2px 2px 5px grey;
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

.description {
    margin-top: 20px;
}
</style>
