<template>
    <div class="container form">
      <h4>Create product</h4>
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
                        @onUpdate="onUpdateSubcategory"
                    />
                </div>
            </div>
        </div>
        <form @submit.prevent>
            <div class="row"  v-for="(item, key) in this.product">
                <div class="col-sm">
                    <div class="row label">
                        <label for="">{{item.name}}:</label>
                    </div>
                </div>
                <div class="col-sm input" v-if="item.name !== 'description'">
                        <my-input
                            :type="'text'"
                            v-model="item.value"
                        />
                </div>

                <div class="col-sm input" v-if="item.name == 'description'">
                    <textarea cols="24" rows="3" v-model="item.value"/>
                </div>
                <div class="col-sm">
                    <ChangeOrderButtons
                        :id="key"
                        :obj="this.product"
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
</template>

<script>
import MyInput from "../../MyInput.vue";
import AdminPanelBut from "../AdminPanelBut.vue";
import ChangeOrderButtons from "../ChangeOrderButtons.vue";
import ErrorMessage from "../../ErrorMessage.vue";
import CategoriesSelect from "./CategoriesSelect.vue";
export default {
    components: {
        CategoriesSelect,
        ErrorMessage,
        ChangeOrderButtons,
        MyInput,
        AdminPanelBut
    },


    data() {
        return {
            product: [
                {name: 'name', order: 0, value: '', type: 'string'},
                {name: 'price', order: 1, value: '', type: 'banknote'},
                {name: 'producer', order: 2, value: '', type: 'string'},
                {name: 'description', order: 3, value: '', type: 'string'},
            ],
            categoryId: '',
            subcategoryId: '',
            categories: [],
            err: ''
        }
    },

    created() {
        this.getCategories()
    },

    methods: {

        onUpdate(value){

        },

        onUpdateCategory(categoryId) {
            this.categoryId = categoryId
        },

        onUpdateSubcategory(subcategoryId) {
            this.subcategoryId = subcategoryId
        },

        async getCategories() {
            const response = await axios.get('/get_all_categories')
                .then((response) => {
                    this.categories = response.data
                })
                .catch(err => console.log(err))
        },

       async submit() {
            const response = await axios.get('/admin/create_product', {
                params: {
                    subcategoryId: this.subcategoryId,
                    subcategoryName: this.subcategoryName,
                    product: this.product,
                }

            })
                .then((response) => {
                    console.log(response)
                    // alert('Product created !')
                })
                .catch((err) => {
                    console.log(err)
                    this.err = err.response.data.message
                })
                .finally(() => {
                    setTimeout(() => {
                        this.err = ''
                    }, 3000)
                    this.product.map(item => item.value = '')
                })
        }
    }
}
</script>

<style scoped>
.form {
    padding: 20px;
    border: 2px solid silver;
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
</style>
