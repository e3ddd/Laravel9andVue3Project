<template>
    <div class="container page">
        <div class="row">
        <div class="col-4 page_item" v-for="item in products">
            <list-item
                :id="item.id"
                :email="item.email"
                :name="item.name"
                :price="item.price"
                :description="item.description"
                :images="item.image"
            />
        </div>
        </div>
        <paginator
            v-model:total="total"
            :get="getProducts"
            @update="onUpdate"
        />
    </div>
</template>

<script>
import ListItem from "./AllProductsList/ListItem.vue";
import Paginator from "./UserList/Paginator.vue";
import Math from "lodash";
export default {
    components: {
        ListItem,
        Paginator
    },

    data() {
        return {
            limit: 9,
            total: 0,
            page: 1,
            products: [],
        }
    },

    mounted() {
        this.getProducts()
        },

    methods: {
        onUpdate() {
            this.products = []
        },

        async getProducts() {
            const response = await axios.get('/products_list?page=' + this.page)
                .then((response) => {
                    this.total = Math.ceil(response.data.total / this.limit)
                    this.products = response.data.data
            })
        },
    }
}
</script>

<style scoped>
.page_item {

}
</style>
