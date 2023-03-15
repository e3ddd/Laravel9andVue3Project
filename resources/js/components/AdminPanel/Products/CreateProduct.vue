<template>
    <div class="create-product-form">
        <label><h4>Create product</h4></label>
        <form @submit.prevent>
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
                @onUpdate="onUpdateSubcategory"
            />

                <div class="inputs"
                     v-for="(item, key) in product"
                >
                    <div class="row" v-if="item.name != 'description'">
                        <div class="col label">
                            <label>{{item.name}}:</label>
                        </div>
                        <div class="col input">
                            <my-input
                                :type="'text'"
                                v-model="item.value"
                            />
                        </div>
                        <div class="col-1"></div>
                        <div class="col">
                            <ChangeOrderButtons
                                :id="key"
                                :obj="this.product"
                            />
                        </div>
                    </div>

                    <div class="row" v-if="item.name == 'description'">
                        <div class="col label">
                            <label>{{item.name}}:</label>
                        </div>
                        <div class="col input">
                            <textarea cols="24" rows="3" v-model="item.value"/>
                        </div>
                        <div class="col-1"></div>
                        <div class="col">
                            <ChangeOrderButtons
                                :id="key"
                                :obj="this.product"
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
        <error-message
            class="w-25 mt-4 d-flex justify-content-center align-content-center"
            :err="this.err"
        />
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

    props: {
      product: Object,
    },

    data() {
        return {
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
        },

       async submit() {

            const response = await axios.post('/admin/create_product', {
                    subcategoryId: this.subcategoryId,
                    subcategoryName: this.subcategoryName,
                    product: this.product,

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
