<template>
   <div class="container">
       <form @submit.prevent>
           <div class="row">
                <div class="col-5">
                    <div class="row">
                        <label for="">Select category:</label>
                    </div>
                    <div class="row" v-if="this.categoryId !== ''">
                        <label for="">Select subcategory:</label>
                    </div>
                </div>
               <div class="col-6">
                   <div class="row">
                       <CategoriesSelect
                           :categories="categories"
                           :category-id="null"
                           @onUpdate="onUpdateCategory"
                       />
                   </div>
                   <div class="row" v-if="this.categoryId !== ''">
                       <CategoriesSelect
                           :categories="this.categories"
                           :category-id="this.categoryId"
                           @onUpdate="onUpdateSubcategory"
                       />
                   </div>
               </div>
            </div>

            <div class="row mt-2">
                <div class="col-6">
                    <label for="attributeName">Enter characteristic name:</label>
                </div>
                <div class="col-6">
                    <my-input
                        class="w-100"
                        :type="'text'"
                        v-model="this.attributeName"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col checkbox">
                    <label>Magnitude</label>
                    <input type="checkbox" v-model="this.dimensionCheck">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="select">Select characteristic value:</label>
                </div>
            </div>
           <div class="row">
                <div class="col-8">
                    <select style="width: 100%" class="select" v-model="this.magnitudeValue">
                        <option v-for="attributeValue in this.attributeValues">{{attributeValue.name}}</option>
                    </select>
                </div>
                <div class="col-4">
                    <select class="small_select" @change="getMagnitudeValues" v-model="this.magnitudeName" v-if="this.dimensionCheck == true">
                        <option v-for="magnitude in this.magnitudes">{{magnitude.name}}</option>
                    </select>
                </div>
           </div>

           <div class="error d-flex justify-content-left">
           <error-message
               :err="this.err"
               />
           </div>
           <admin-panel-but :func="createAttr">Create</admin-panel-but>
       </form>
   </div>
</template>

<script>
import AdminPanelBut from "../AdminPanelBut.vue";
import ErrorMessage from "../../ErrorMessage.vue";
import CategoriesSelect from "../Products/CategoriesSelect.vue";
import MyInput from "../../MyInput.vue";
export default {
    components: {
        CategoriesSelect,
        AdminPanelBut,
        ErrorMessage,
        MyInput
    },

    data() {
        return {
            categoryName: '',
            subcategoryName: '',
            categoryId: '',
            subcategoryId: '',
            attributeName: '',
            attributeValues: [
                {name:'string'},
                {name:'number'},
            ],
            magnitudeValue: '',
            magnitudeName: '',
            magnitudes: [
                {name:'dimension'},
                {name:'weight'},
                {name:'capacity'},
            ],
            dimensionCheck: '',
            err: '',
        }
    },

    props: {
        categories: Array,
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

        dimensionCheck(newCheck, oldCheck){
            if(!newCheck){
                this.attributeValues = [
                    {name:'string'},
                    {name:'number'},
                ]
            }
        }

    },

    methods: {
        onUpdateCategory(categoryId) {
            this.categoryId = categoryId
        },

        onUpdateSubcategory(subcategoryId) {
            this.subcategoryId = subcategoryId
        },

        async getMagnitudeValues() {
            this.attributeValues = []
            const response = await axios.get('/admin/get_magnitude_values', {
                params: {
                    magnitudeName: this.magnitudeName
                }
            })
                .then((response) => {
                    response.data.map((item,key) => {
                        this.attributeValues.push({name: item})
                    })
                })
                .catch(err => console.log(err))
        },

        async createAttr() {
            let attribute = [{name: this.attributeName, type: this.magnitudeValue}]

            const response = await axios.get('/admin/create_attribute', {
                params: {
                    subcategoryId: this.subcategoryId,
                    attribute: attribute,
                    default: 0
                }
            })
                .then((response) => {
                    console.log(response)
                })
                .catch((err) => {
                    this.err = err.response.data.message
                    setTimeout(() => {
                        this.err = ''
                    }, 4000)
                })
        }
    }
}
</script>

<style scoped>
.select {
    width: 300px;
}

.checkbox label {
    padding-right: 5px;
}

label span{
    font-size: 12px;
    color: grey;
    opacity: 0.75;
}

.small_select {
    margin-left: 10px;
}

</style>
