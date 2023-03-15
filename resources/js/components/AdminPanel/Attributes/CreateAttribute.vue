<template>
   <div class="container-fluid attributes">
       <form action="" @submit.prevent>
       <div class="col">
           <label for="select">Select category:</label>
           <select name="" id="" class="select" v-model="this.categoryName">
               <option v-for="category in categories.filter(item => item.parent_id == null)">{{category.name}}</option>
           </select>
       </div>

       <div class="col" v-if="this.categoryName !== ''">
           <label for="select">Select subcategory: </label>
           <select name="" id="" class="select" v-model="this.subcategoryName">
               <option v-for="category in categories.filter(item => item.parent_id == this.categoryId)">{{category.name}}</option>
           </select>
       </div>

       <div class="col attribute">
           <label for="attributeName">Enter characteristic name:</label>
           <input id="attributeName" type="text" v-model="this.attributeName">
       </div>
           <div class="col checkbox_magnitude">
               <label style="padding-right: 10px;" for="">Magnitude</label>
               <input type="checkbox" v-model="this.dimensionCheck">
               <select class="small_select" @change="getMagnitudeValues" v-model="this.magnitudeName" v-if="this.dimensionCheck == true">
                   <option v-for="magnitude in this.magnitudes">{{magnitude.name}}</option>
               </select>
           </div>

           <div class="col">
               <label for="select">Select characteristic value:</label>
               <select name="" id="" class="select" v-model="this.magnitudeValue">
                   <option v-for="attributeValue in this.attributeValues">{{attributeValue.name}}</option>
               </select>
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
export default {
    components: {
        AdminPanelBut,
        ErrorMessage
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

    },

    methods: {
        async getMagnitudeValues() {
            this.attributeValues = []
            const response = await axios.post('/admin/get_magnitude_values', {
                magnitudeName: this.magnitudeName
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

label {
    margin-top: 10px;
    line-height: 16px;
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
