<template>
    <div class="create-product-form">
        <label><h4>Add value to product attribute</h4></label>
        <form @submit.prevent enctype="multipart/form-data">
            <CategoriesSelect
                :categories="this.categories"
                :category-id="null"
                :label="'Select category:'"
                @onUpdate="onUpdateCategory"
            />

            <CategoriesSelect
                v-if="this.categoryId !== ''"
                :categories="this.categories"
                :category-id="this.categoryId"
                :label="'Select subcategory:'"
                @change="getProducts"
                @onUpdate="onUpdateSubcategory"
            />

            <div class="row" v-if="this.subcategoryId != ''">
                <div class="col">
                    <label for="select">Select product:</label>
                </div>
                <div class="col">
                    <select class="select" @change="getAttr" v-model="this.productName">
                        <option v-for="product in this.products">{{product.name}}</option>
                    </select>
                </div>
            </div>
            <div class="images" v-if="this.products.length !== 0">
                <upload-product-image
                    :product-id="this.productId"
                    :files="this.images"
                    @getImages="onImages"
                    @deleteImage="updateImages"
                />
            </div>
            <div class="inputs"
                 v-for="(attribute, key) in this.attributesValues"
            >
                <div class="row">
                    <div class="col label">
                        <label>{{attribute.name}}:</label>
                    </div>
                    <div class="col input">
                        <my-input
                            :type="'text'"
                            v-model="this.attributesValues[key].value"
                        />
                    </div>
                    <div class="col d-flex justify-content-center mt-3">
                        {{attribute.type}}
                    </div>
                    <div class="col btns">
                        <ChangeOrderButtons
                        :id="key"
                        :obj="this.attributesValues"
                        />
                    </div>
                </div>
            </div>
            <error-message
                class="w-25 mt-4 d-flex justify-content-center align-content-center"
                :err="this.err"
            />
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
import UploadProductImage from "./UploadProductImage.vue";
import ErrorMessage from "../../ErrorMessage.vue";
import CategoriesSelect from "./CategoriesSelect.vue";
export default {
    components: {
        CategoriesSelect,
        ErrorMessage,
        UploadProductImage,
        MyInput,
        AdminPanelBut,
        ChangeOrderButtons
    },
    data() {
        return {
            categoryId: '',
            subcategoryId: '',
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
            const response = await axios.get('/get_all_categories')
                .then((response) => {
                    this.categories = response.data
                })
                .catch((err) => {
                    console.log(err)
                })
        },

        async getAttr() {
            this.attributesValues = []
            const response = await axios.post('/admin/get_attributes_by_subcategory', {
                    subcategoryId: this.subcategoryId,
                    default: 0
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

        async getProducts() {
            const response = await axios.get('/admin/get_products_by_subcategory', {
                params: {
                    subcategoryId: this.subcategoryId
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
            let response = await axios.post('/admin/store_product_attrs_values', {
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
                let response = await axios.post('/admin/store_product_images', fd,
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
