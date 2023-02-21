<template>
    <div class="create-product-form">
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
                    <select @change="getAttr" class="select" v-model="this.subcategoryName">
                        <option v-for="category in this.categories.filter(item => item.parent_id == this.categoryId)">{{category.name}}</option>
                    </select>
                </div>
            </div>

                <div class="inputs"
                     v-for="(attribute, key) in this.attributes"
                     :key="attribute.id"
                >

                    <div class="row" v-if="attribute.name == 'size'">
                        <ProductSize
                            :prod-size="this.prodSize"
                            :name="attribute.name"
                        />
                        <div class="col-md-2 btns">
                            <button @click="up" :id="key">&#8593;</button>
                            <button @click="down" :id="key">&#8595;</button>
                        </div>
                    </div>

                    <div class="row" v-if="attribute.name != 'size' && attribute.order != undefined">
                        <div class="col-sm-2 label">
                            <label>{{attribute.name}}:</label>
                        </div>
                        <div class="col-lg input">
                            <my-input
                                :type="'text'"
                                v-model="this.product[attribute.name]"
                            />
                        </div>
                        <div class="col-2 btns">
                            <button @click="up" :id="key">&#8593;</button>
                            <button @click="down" :id="key">&#8595;</button>
                        </div>
                    </div>
                </div>
        <button @click="submit">Submit</button>
        </form>
    </div>
</template>

<script>
import MyInput from "../../MyInput.vue";
import AdminPanelBut from "../AdminPanelBut.vue";
import ProductSize from "./ProductSize.vue";
export default {
    components: {
        MyInput,
        ProductSize,
        AdminPanelBut
    },

    data() {
        return {
            categoryId: '',
            order: {},
            product: {},
            prodSize: {
                dimension: '',
                long: '',
                width: '',
                height: '',
            },
            attributes: [],
            categories: [],
            categoryName: '',
            subcategoryName: ''
        }
    },

    created() {
        this.getCategories()
    },

    watch: {
        categoryName(newName, oldName){
            let categories = this.categories.filter(item => item.name == newName)
            this.categoryId = categories[0].id
        }
    },

    methods: {
        up(event) {
                const prevIndex = Number(event.target.id) - 1
                const prevObj = this.attributes[prevIndex]
                const currObj = this.attributes[event.target.id]
            if(prevIndex >= 0){
                let tmp = prevObj.order
                prevObj.order = currObj.order
                currObj.order = tmp

                this.attributes[prevIndex] = this.attributes[event.target.id]
                this.attributes[event.target.id] = prevObj

            }
        },

        down(event) {
            const nextIndex = Number(event.target.id) + 1
            const nextObj = this.attributes[nextIndex]
            const currObj = this.attributes[event.target.id]

            if(nextIndex <= this.attributes.length - 1){
                let tmp = nextObj.order
                nextObj.order = currObj.order
                currObj.order = tmp

                this.attributes[nextIndex] = this.attributes[event.target.id]
                this.attributes[event.target.id] = nextObj
            }
        },

        async getCategories() {
            const response = await axios.get('/get_all_categories')
                .then((response) => {
                    console.log(response.data)
                    this.categories = response.data
                })
        },

        async getAttr() {
            const response = await axios.get('/get_attributes', {
                params: {
                    subcategoryName: this.subcategoryName
                }
            })
                .then((response) => {
                    this.attributes = response.data
                    for (let key in response.data){
                        this.prodSize.dimension = this.attributes[key].alt_dimension
                        this.attributes[key].order = response.data[key].id
                        this.product[response.data[key].name] = ''
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
        },

       async submit() {
            for (let key in this.attributes){
                this.order[this.attributes[key].name] = this.attributes[key].order
            }

            const response = await axios.get('/test', {
                params: {
                    category: this.categoryName,
                    subcategory: this.subcategoryName,
                    product: this.product,
                    order: this.order,
                    size: this.prodSize,
                }
            })
                .then((response) => {
                    console.log(response)
                })
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
