<template>
    <div class="col-sm-auto list">
        <h2 style="text-align: center; padding: 10px">{{this.user}}'s product list</h2>
        <div class="list-item" v-for="item in list">
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
            @update="onUpdate"
        />
    </div>
</template>

<script>
import Paginator from "./UserList/Paginator.vue";
import UserProductsItem from "./ProductList/UserProductsItem.vue";
import Math from "lodash";
export default {
    components: {
        Paginator,
        UserProductsItem
    },

    data() {
        return {
            user: '',
            list: [],
            total: 1,
            limit: 5,
        }
    },

    mounted() {
        this.getProducts(this.page)
    },

    methods: {
        onUpdate() {
            this.users = []
        },

        async getProducts(page) {
            const id = window.location.search.split("=")[1]
                const response = await axios.get("/users/products/?page=" + page, {
                    params: {
                        id: id
                    }
                })
                    .then((response) => {
                        this.total = Math.ceil(response.data.total / this.limit)
                        this.list = response.data.data
                        this.user = response.data.data[0].user.email
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
.list {
    border: 2px solid silver;
    box-shadow: 3px 3px 3px lightgray;
    border-radius: 10px;
    margin: 50px;
}
</style>
