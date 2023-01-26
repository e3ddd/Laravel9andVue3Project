<template>
    <div class="container page">
        <div class="row">
            <div class="col-10 products">
                <div class="all__link">
                    <a href="/users_products">products</a>&#187;<a :href="this.category_name">{{this.category_name}}</a>
                </div>
                <div class="row">
                    <div class="page_item" :class="{'col-lg': adaptive, 'col-4': non_adaptive}" v-for="item in products">
                        <list-item
                            :id="item.id"
                            :email="item.user.email"
                            :name="item.name"
                            :price="item.price"
                            :description="item.description"
                            :images="item.image"
                        />
                    </div>
                    <paginator
                        v-model:total="total"
                        :get="getProducts"
                        @update="onUpdate"
                    />
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Paginator from "../../UserList/Paginator.vue";
import ListItem from "../ListItem.vue";
import Math from "lodash";
export default {
    components: {
        Paginator,
        ListItem
    },

    data() {
        return {
            limit: 9,
            total: 1,
            page: 1,
            products: [],
            adaptive: false,
            non_adaptive: true,
            category_name: window.location.href.substring(22)
        }
    },


    mounted() {
        this.getProducts(this.page)
    },

    methods: {


        onUpdate() {
            this.products = []
        },

        async getProducts(page) {
            const response = await axios.post('/get_by_category?page=' + page,
                 {
                    category: this.category_name
                }
            )
                .then((response) => {
                    console.log(response)
                    this.total = Math.ceil(response.data.total / this.limit)
                    this.products = response.data.data
                })
        },
    }
}
</script>

<style scoped>
.products {
    border: 2px solid silver;
    box-shadow: 3px 3px 3px lightgray;
}

.all__link a {
    padding: 10px;
    text-decoration: none;
    text-transform: uppercase;
    color: black;
    font-size: 14px;
}

.all__link a:hover {
    text-decoration: underline;
    color: #df4949;
}
</style>
