<template>
    <div class="create-product-form">
        <label><h4>Add value to product attribute</h4></label>
        <form @submit.prevent>
            <div class="row">
                <div class="col-5">
                    <label for="select">Select category:</label>
                </div>
                <div class="col-7">
                    <select class="select" v-model="this.categoryName">
                        <option v-for="category in this.categories.filter(item => item.parent_id == null)">{{category.name}}</option>
                    </select>
                </div>
            </div>

            <div class="row" v-if="this.categoryName !== ''">
                <div class="col-5">
                    <label for="select">Select subcategory: </label>
                </div>
                <div class="col-7">
                    <select class="select" @change="getProducts" v-model="this.subcategoryName">
                        <option v-for="category in this.categories.filter(item => item.parent_id == this.categoryId)">{{category.name}}</option>
                    </select>
                </div>
            </div>

            <div class="row" v-if="this.subcategoryName != ''">
                <div class="col-5">
                    <label for="select">Select product:</label>
                </div>
                <div class="col-7">
                    <select class="select" @change="getAttr" v-model="this.productName">
                        <option v-for="product in this.products">{{product.name}}</option>
                    </select>
                </div>
            </div>
            <div class="inputs"
                 v-for="(attribute, key) in this.attributesValue"
            >
                <div class="row">
                    <div class="col-sm-2 label">
                        <label>{{attribute.name}}:</label>
                    </div>
                    <div class="col-lg input">
                        <my-input
                            :type="'text'"
                            v-model="this.attributesValue[key].value"
                        />
                    </div>
                    <div class="col-2 btns">
                        <change-order-buttons
                        :id="key"
                        :obj="this.attributesValue"
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
            attributesValue: [],
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

        async getAttr() {
            this.attributesValue = []
            const response = await axios.get('/get_attributes', {
                params: {
                    subcategoryName: this.subcategoryName
                }
            })
                .then((response) => {
                    for (let key in response.data) {
                        if (response.data[key]['default'] == 0) {
                           this.attributesValue.push({name: response.data[key]['name'], value: '', order: '', type: response.data[key]['value']})
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
                    attributesValue: this.attributesValue
            })
                .then((response) => {
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
