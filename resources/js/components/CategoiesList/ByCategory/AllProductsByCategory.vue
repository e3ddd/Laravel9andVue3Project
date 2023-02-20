<template>
    <div class="container page">
        <div class="row">
            <div class="col-3">
                <categories-list
                    :mainCategory="this.category_name"
                    :categories="this.subcategories"
                />
            </div>
            <div class="col-9 products">
                <div class="all__link">
                    <a href="/home">products</a>&#187;<a :href="'products/' + this.category_name">{{this.category_name}}</a>
                </div>
                <div class="row">
                    <div class="page_item" v-for="item in products">
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
import CategoriesList from "./CategoriesList.vue";
import Paginator from "../../UserList/Paginator.vue";
import ListItem from "../ListItem.vue";
import Math from "lodash";
export default {
    components: {
        Paginator,
        ListItem,
        CategoriesList
    },

    data() {
        return {
            limit: 9,
            total: 1,
            page: 1,
            products: [],
            adaptive: false,
            non_adaptive: true,
            category_name: window.location.href.substring(31),
            subcategories: []
        }
    },


    created() {
        this.getProducts(this.page)
        this.getSubcategories()
        this.rightLinks()
    },

    methods: {
        rightLinks() {
            for (const key in this.category_name.split('%20',)){
                if(this.category_name.includes('%20')) {
                    this.category_name = this.category_name.replace('%20', ' ')
                }
            }
        },

        async getSubcategories()
        {
            const response = await axios.get('/get_subcategories', {
                params: {
                    category: this.category_name.replace('%20', ' ')
                }
            })
                .then((response) => {
                    console.log(response)
                    this.subcategories = response.data
                })
                .catch((err) => {
                    console.log(err)
                })
        },

        onUpdate() {
            this.products = []
        },

        async getProducts(page) {

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
