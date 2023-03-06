<template>
    <div class="create-product-form">
        <label><h4>Add value to product attribute</h4></label>
        <form @submit.prevent>
            <div class="row">
                <div class="col-3">
                    <label for="select">Select category:</label>
                </div>
                <div class="col-3">
                    <select class="select" v-model="this.categoryName">
                        <option v-for="category in this.categories.filter(item => item.parent_id == null)">{{category.name}}</option>
                    </select>
                </div>
            </div>

            <div class="row" v-if="this.categoryName !== ''">
                <div class="col-3">
                    <label for="select">Select subcategory: </label>
                </div>
                <div class="col-3">
                    <select class="select" @change="getProducts" v-model="this.subcategoryName">
                        <option v-for="category in this.categories.filter(item => item.parent_id == this.categoryId)">{{category.name}}</option>
                    </select>
                </div>
            </div>

            <div class="row" v-if="this.subcategoryName != ''">
                <div class="col-3">
                    <label for="select">Select product:</label>
                </div>
                <div class="col-3">
                    <select class="select" @change="getAttr" v-model="this.productName">
                        <option v-for="product in this.products">{{product.name}}</option>
                    </select>
                </div>
            </div>
            <div class="inputs"
                 v-for="(attribute, key) in this.attributesValues"
            >
                <div class="row">
                    <div class="col-2 label">
                        <label>{{attribute.name}}:</label>
                    </div>
                    <div class="col-2 input">
                        <my-input
                            :type="'text'"
                            v-model="this.attributesValues[key].value"
                        />
                    </div>
                    <div class="col-1 d-flex justify-content-center mt-3">
                        {{attribute.type}}
                    </div>
                    <div class="col-3 btns">
                        <ChangeOrderButtons
                        :id="key"
                        :obj="this.attributesValues"
                        />
                    </div>
                </div>
            </div>
            <admin-panel-but
                :func="submit"
            >
                Create
            </admin-panel-but>
        </form>
    </div>
</template>

<script>
import MyInput from "../../MyInput.vue";
import AdminPanelBut from "../AdminPanelBut.vue";
import ChangeOrderButtons from "../ChangeOrderButtons.vue";
export default {
    components: {
        MyInput,
        AdminPanelBut,
        ChangeOrderButtons
    },
    data() {
        return {
            categoryId: '',
            subcategoryId: '',
            productId: '',
            categories: [],
            attributesValues: [],
            products: [],
            categoryName: '',
            subcategoryName: '',
            productName: ''
        }
    },

    created() {
        this.getCategories()
    },

    watch: {
        categoryName(newName, oldName){
            let categories = this.categories.filter(item => item.name == newName)
            this.categoryId = categories[0].id
        },

        subcategoryName(newName, oldName){
            let subcategories = this.categories.filter(item => item.name == newName)
            this.subcategoryId = subcategories[0].id
        },

        productName(newName, oldName){
            let products = this.products.filter(item => item.name == newName)
            this.productId = products[0].id
        }

    },

    methods: {
        async getCategories() {
            const response = await axios.get('/get_all_categories')
                .then((response) => {
                    this.categories = response.data
                })
        },

        checkFraction(event) {

        },

        async getAttr() {
            this.attributesValues = []
            const response = await axios.get('/get_attributes', {
                params: {
                    subcategoryName: this.subcategoryName
                }
            })
                .then((response) => {
                    for (let key in response.data) {
                        if (response.data[key]['default'] == 0) {
                                this.attributesValues.push({name: response.data[key]['name'], value: '', order: Number(key), type: response.data[key]['value']})
                        }
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
        },

        async getProducts() {
            const response = await axios.get('/get_products_by_subcategory', {
                params: {
                    subcategoryId: this.subcategoryId
                }
            })
                .then((response) => {
                    this.products = response.data
                })
        },

        async submit() {

            const response = await axios.post('/store_product_attrs_values', {
                    productId: this.productId,
                    subcategoryId: this.subcategoryId,
                    attributesValues: this.attributesValues
            })
                .then((response) => {
                    console.log(response)
                    alert('Attributes values added !')
                })
                .catch(err => alert(err.response.data.message))
        }
    }
}
</script>

<style scoped>
.select {
    width: 75%;
    margin-left: 30px;
}

.create-product-form {
    border: 2px solid silver;
    padding: 10px;
}


.input {
    display: flex;
    justify-content: center;
    margin-top: 15px;
    margin-bottom: 15px;
    margin-left: 25px;
}

.label {
    margin-top: 15px;
}

.label :first-letter {
    text-transform: uppercase;
}

.btns button {
    margin-right: 3px;
    margin-top: 15px;
    background: #df4949;
    border: none;
    border-radius: 5px;
    color: white;
}
</style>
