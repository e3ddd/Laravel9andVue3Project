<template>
    <div class="row list" v-if="list.length !== 0">
        <div class="col-sm list-item" v-for="item in list" >
            <user-products-item
                :id="item.id"
                :name="item.name"
                :price="item.price"
                :description="item.description"
                :del="this.delete"
                :images="item.image"
            />

        </div>

        <paginator
            v-model:total="total"
            :get="getProducts"
        />
    </div>
    <div class="row no__products" v-else>
        <h1>You don't have any product</h1>
    </div>
</template>

<script>
import Paginator from "../UserList/Paginator.vue";
import UserProductsItem from "../ProductList/UserProductsItem.vue";
import Math from "lodash";
export default {
    components: {
        Paginator,
        UserProductsItem
    },


    data() {
        return {
            list: [],
            total: 1,
            limit: 10,
        }
    },
    mounted() {
        this.getProducts(this.page)
    },

    methods: {

        async getProducts(page) {
            const response = await axios.get("/users/products?page=" + page)
                .then((response) => {
                    this.total = Math.ceil(response.data.total / this.limit)
                    this.list = response.data.data
                    console.log(response)
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        async delete(id) {
            const response = await axios.get('/users/products/' + id + '/delete', {
                params: {
                    id: id
                }
            })
                .then(() => {
                    this.list = this.list.filter((item) => item.id !== id)
                })
                .catch(() => {
                    alert("You cannot delete a product witch has images !");
                });
        },
    }
}
</script>

<style scoped>

.no__products {
    display: flex;
    justify-content: center;
    text-align: center;
    margin-top: 100px;
}

.list {
    border: 2px solid silver;
    box-shadow: 3px 3px 3px lightgray;
    border-radius: 10px;
    margin: 50px;
}
</style>
