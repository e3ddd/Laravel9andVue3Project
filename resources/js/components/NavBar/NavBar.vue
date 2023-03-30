<template>
    <div class="container-fluid index__btns">
        <div class="row">
            <div class="col-4">
                <logo/>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-6 reg_log">
                        <reg-and-log-links
                            :user-name="this.userName"
                        />
                    </div>
                    <div class="col-6 search">
                        <search-input/>
                    </div>
                </div>
            </div>

            <div class="col-1 shopping_cart">
                <a :href="'/shopping_cart'">
                    <shopping-cart
                        :count="this.count"
                    />
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import Logo from "./Logo.vue";
import RegAndLogLinks from "./RegAndLogLinks.vue";
import SearchInput from "./SearchInput.vue";
import ShoppingCart from "./ShoppingCart.vue";
export default {
    components: {
        Logo,
        RegAndLogLinks,
        SearchInput,
        ShoppingCart
    },

    data() {
        return {
            showSelectMenu: false,
            userName: '',
            search: '',
            count: 0
        }
    },
    created() {
        this.getNumberOfProductsInShoppingCart()
        this.getUser()
    },


    methods: {
        async getUser(){
            const response = await axios.get('/get_user')
                .then((response) => {
                    this.userName = response.data.name
                })
        },

        getNumberOfProductsInShoppingCart() {
            const response = axios.get('/get_number_of_products_in_shopping_cart')
                .then((response) => {
                    this.count = response.data
                })
                .catch(err => console.log(err))
        }
    }
}
</script>

<style scoped>

.index__btns {
    height: 50px;
    background: #f8f7f7;
}


.search {
    margin-top: 10px;
}


.reg_log {
    margin-top: 5px;
}

.shopping_cart a {
   text-decoration: none;
}
</style>
