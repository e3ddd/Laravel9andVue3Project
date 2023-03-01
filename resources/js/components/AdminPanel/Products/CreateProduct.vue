<template>
    <div class="create-product-form">
        <label><h4>Create product</h4></label>
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
                    <select class="select" v-model="this.subcategoryName">
                        <option v-for="category in this.categories.filter(item => item.parent_id == this.categoryId)">{{category.name}}</option>
                    </select>
                </div>
            </div>

                <div class="inputs"
                     v-for="(item, key) in product"
                >
                    <div class="row">
                        <div class="col-sm-2 label">
                            <label>{{item.name}}:</label>
                        </div>
                        <div class="col-lg input">
                            <my-input
                                :type="'text'"
                                v-model="item.value"
                            />
                        </div>
                        <div class="col-2">
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
    </div>
</template>

<script>
import MyInput from "../../MyInput.vue";
import AdminPanelBut from "../AdminPanelBut.vue";
import ChangeOrderButtons from "../ChangeOrderButtons.vue";
export default {
    components: {
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
        },

        subcategoryName(newName, oldName){
            let subcategories = this.categories.filter(item => item.name == newName)
            this.subcategoryId = subcategories[0].id
        }
    },

    methods: {


        async getCategories() {
            const response = await axios.get('/get_all_categories')
                .then((response) => {
                    this.categories = response.data
                })
        },

       async submit() {
           for (const key in this.product) {
               if(this.product[key].name == 'price'){
                   this.product[key].value = Number(this.product[key].value)
               }
           }
            const response = await axios.post('/store_product', {
                    subcategoryId: this.subcategoryId,
                    subcategoryName: this.subcategoryName,
                    product: this.product,

            })
                .then((response) => {
                    console.log(response)
                    // alert('Product created !')
                })
                // .catch(err => alert(err))
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


</style>
