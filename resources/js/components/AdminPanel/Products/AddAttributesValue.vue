<template>
    <div class="container form">
        <h4>Add value to product attribute</h4>
        <div class="row">
            <div class="col-4">
                <div class="row"><label for="">Select category:</label></div>
                <div class="row" v-if="this.categoryId !== 0"><label for="">Select subcategory:</label></div>
                <div class="row" v-if="this.subcategoryId !== 0"><label for="select">Select product:</label></div>
            </div>
            <div class="col-6">
                <div class="row">
                    <CategoriesSelect
                        :categories="this.categories"
                        :category-id="null"
                        @onUpdate="onUpdateCategory"
                    />
                </div>
                <div class="row" v-if="this.categoryId !== 0">
                    <CategoriesSelect
                        :categories="this.categories"
                        :category-id="this.categoryId"
                        @onUpdate="onUpdateSubcategory"
                    />
                </div>
                <div class="row" v-if="this.subcategoryId !== 0">
                    <select class="select" @change="getAttr" v-model="this.productName">
                        <option v-for="product in this.products">{{product.name}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="images" v-if="this.products.length !== 0">
                <UploadImage
                    :product-id="this.productId"
                    :files="this.images"
                    @getImages="onImages"
                    @deleteImage="updateImages"
                />
            </div>
        </div>
        <div class="row">
            <form @submit.prevent enctype="multipart/form-data">
                <div class="row inputs"
                     v-for="(attribute, key) in this.attributesValues"
                >
                    <div class="col label">
                        <label>{{attribute.name}}:</label>
                    </div>
                    <div class="col input">
                        <my-input
                            :type="'text'"
                            v-model="this.attributesValues[key].value"
                        />
                    </div>

                    <div class="col mt-3">
                        {{attribute.type}}
                    </div>

                    <div class="col">
                        <ChangeOrderButtons
                            :id="key"
                            :obj="this.attributesValues"
                        />
                    </div>
                </div>
                <error-message
                    class="w-25 mt-4 d-flex justify-content-center align-content-center"
                    :err="this.err"
                />
                <admin-panel-but
                    class="m-2"
                    :func="submit"
                >
                    Create
                </admin-panel-but>
            </form>
        </div>
    </div>

</template>

<script>
import MyInput from "../../MyInput.vue";
import AdminPanelBut from "../AdminPanelBut.vue";
import ChangeOrderButtons from "../ChangeOrderButtons.vue";
import UploadImage from "./UploadImage.vue";
import ErrorMessage from "../../ErrorMessage.vue";
import CategoriesSelect from "./CategoriesSelect.vue";
export default {
    components: {
        CategoriesSelect,
        ErrorMessage,
        UploadImage,
        MyInput,
        AdminPanelBut,
        ChangeOrderButtons
    },
    data() {
        return {
            categoryId: 0,
            subcategoryId: 0,
            productId: 0,
            categories: [],
            attributesValues: [],
            products: [],
            images: [],
            productName: '',
            err: '',
        }
    },

    created() {
        this.getCategories()
    },

    watch: {
        productName(newName, oldName){
            let products = this.products.filter(item => item.name == newName)
            this.productId = products[0].id
        },

        subcategoryId(newValue, oldValue){
            this.getProducts(newValue)
        }

    },

    methods: {

        onUpdateCategory(categoryId) {
            this.categoryId = categoryId
        },

        onUpdateSubcategory(subcategoryId) {
            this.subcategoryId = subcategoryId
        },

        onImages(imgs){
            this.images = imgs
        },

        updateImages(id){
            this.images = this.images.filter(item => item.id != id)
        },

        async getCategories() {
            axios.get('/get_all_categories')
                .then((response) => {
                    this.categories = response.data
                })
                .catch((err) => {
                    console.log(err)
                })
        },

        async getAttr() {
            this.attributesValues = []
            axios.get('/admin/get_attributes_by_subcategory', {
                params:{
                    subcategoryId: this.subcategoryId,
                    default: 0
                }
            })
                .then((response) => {
                    for (let key in response.data) {
                        this.attributesValues.push({name: response.data[key]['name'], value: '', order: Number(key), type: response.data[key]['value']})
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
        },

        async getProducts(subcategoryId) {
            axios.get('/get_all_products_by_subcategory_id', {
                params: {
                    subcategoryId: subcategoryId
                }
            })
                .then((response) => {
                    this.products = response.data.data
                })
                .catch((err) => {
                    console.log(err)
                })
        },

        async submit() {
            axios.post('/admin/store_product_attrs_values', {
                productId: this.productId,
                subcategoryId: this.subcategoryId,
                attributesValues: this.attributesValues,
            })
                .then((response) => {
                    console.log(response)
                })
                .catch((err) => {
                    console.log(err)
                    this.err = err.response.data.message
                })
                .finally(() => {
                    setTimeout(() => {
                        this.err = ''
                    }, 3000)
                })



            if(this.err == ''){
                const fd = new FormData();
                this.images.map(item => fd.append('images[]', item.file, item.file.name))
                fd.append('productId', this.productId)
                axios.post('/admin/store_product_images', fd,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((response) => {
                        console.log(response)
                    })
                    .catch((err) => {
                        console.log(err)
                        this.err = err.response.data.message
                    })
                    .finally(() => {
                        setTimeout(() => {
                            this.err = ''
                        }, 3000)
                    })
            }

        }
    }
}
</script>

<style scoped>
.form {
    margin-top: 50px;
    padding: 20px;
    border: 2px solid silver;
}

.select {
    width: 75%;
    margin-left: 30px;
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
