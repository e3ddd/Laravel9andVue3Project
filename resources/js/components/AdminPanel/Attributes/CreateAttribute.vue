<template>
   <div class="container-fluid attributes">
       <form action="" @submit.prevent>
       <div class="col">
           <label for="select">Select category:</label>
           <select name="" id="" class="select" v-model="this.categoryName">
               <option v-for="category in categories.filter(item => item.parent_id == null)">{{category.id}}, {{category.name}}</option>
           </select>
       </div>

       <div class="col" v-if="this.categoryName !== ''">
           <label for="select">Select subcategory: </label>
           <select name="" id="" class="select" v-model="this.subcategoryName">
               <option v-for="category in categories.filter(item => item.parent_id == this.categoryName.match('^\\d+')[0])">{{category.name}}</option>
           </select>
       </div>
       <div class="col">
           <label for="attributeName">Enter characteristic name:</label>
           <input id="attributeName" type="text" v-model="this.attributeName">
       </div>
       <div class="col">
           <label for="attributeDimension">Enter characteristic dimension: <br><span>(number,string,centimeters ...)</span></label>
           <input id="attributeDimension" type="text" v-model="this.attributeValue">
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
            attributeName: '',
            attributeValue: '',
            err: '',
        }
    },

    props: {
        categories: Array,
    },

    methods: {
        createAttr()
        {
            const response = axios.get('/admin/createAttr', {
                params: {
                    subcategoryName: this.subcategoryName,
                    attrName: this.attributeName,
                    attrValue: this.attributeValue,
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


</style>
