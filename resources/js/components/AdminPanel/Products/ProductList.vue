<template>
    <div class="container list">
        <h4>Product List</h4>
        <div class="row">
            <div class="col-4">
                <div class="row"><label for="">Select category:</label></div>
                <div class="row" v-if="this.categoryId !== ''"><label for="">Select subcategory:</label></div>
            </div>
            <div class="col-6">
                <div class="row">
                    <CategoriesSelect
                        :categories="this.categories"
                        :category-id="null"
                        @onUpdate="onUpdateCategory"
                    />
                </div>
                <div class="row">
                    <CategoriesSelect
                        v-if="this.categoryId !== ''"
                        :categories="this.categories"
                        :category-id="this.categoryId"
                        @change="getProductsList"
                        @onUpdate="onUpdateSubcategory"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <form @submit.prevent>
                <input type="search" name="search" @input="searchProduct" v-model="this.search" placeholder="Search product...">
            </form>
        </div>
        <div class="row product" v-for="product in this.productsList">
            <div class="col-sm-1 item">
                ID: {{product.id}}
            </div>

            <div class="col-sm-3 item">
                Name: {{product.name}}
            </div>

            <div class="col-sm-2 item">
                Price: {{product.price / 100}} UAH
            </div>

            <div class="col-sm-3 item">
                Producer: {{product.producer}}
            </div>
            <div class="col-sm-1">

                <product-info-modal
                    :product-id="product.id"
                    :subcategory-id="Number(this.subcategoryId)"
                    :images="product.image"
                />
            </div>
            <div class="col-sm-1">
                <admin-panel-but
                    :func="del"
                    :attr="product.id"
                >
                    Delete
                </admin-panel-but>
            </div>
        </div>
        <div class="row">
            <paginator
                v-model:total="this.total"
                :get="getProductsList"
                @update="onUpdate"
            />
        </div>
    </div>
</template>

<script>
import CategoriesSelect from "./CategoriesSelect.vue";
import AdminPanelBut from "../AdminPanelBut.vue";
import MyInput from "../../MyInput.vue";
import Paginator from "../../UserList/Paginator.vue";
import ProductInfoModal from "./ProductInfoModal.vue";
import Math from "lodash";
export default {
    components: {
        ProductInfoModal,
        CategoriesSelect,
        AdminPanelBut,
        MyInput,
        Paginator
    },

    data() {
        return {
            page: 1,
            total: 1,
            productsList: [],
            categories: [],
            categoryId: '',
            subcategoryId: '',
            search: '',
        }
    },

    created() {
        this.getCategories()
    },


    methods: {
        onUpdateCategory(categoryId) {
            this.categoryId = categoryId
        },

        onUpdateSubcategory(subcategoryId) {
            this.subcategoryId = subcategoryId
        },

        onUpdate() {
            this.productsList = []
        },

        async searchProduct() {
            const response = await axios.get('/admin/search_product_by_subcategory', {
                params: {
                    subcategoryId: this.subcategoryId,
                    search: this.search
                }
            })
                .then((response) => {
                    this.productsList = response.data.data
                    this.total = Math.ceil(response.data.total / this.limit)
                })
        },

        async getProductsList() {
            const response = await axios.get('/get_all_products_by_subcategory_id', {
                params: {
                    subcategoryId: this.subcategoryId
                }
            })
                .then((response) => {
                    this.productsList = response.data.data
                    this.total = Math.ceil(response.data.total / this.limit)
                })
                .catch(err => console.log(err))


        },

        async getCategories() {
            const response = await axios.get('/get_all_categories')
                .then((response) => {
                    this.categories = response.data
                })
                .catch(err => console.log(err))
        },

        async del(id) {
            const response = await axios.post('/admin/delete_product', {
                productId: id
            })
                .then(response => this.productsList = this.productsList.filter(item => item.id !== id))
                .catch(err => console.log(err))
        }
    }
}
</script>

<style scoped>
.list {
    border: 2px solid silver;
    margin-left: 5px;
    margin-right: 5px;
    padding: 20px;
}

.product {
    margin-top: 10px;
}

.item {
    margin-top: 10px;
}
</style>
