<template>
    <div class="container categories">
        <form @submit.prevent>
            <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <label for="categoryName">Enter category name:</label>
                </div>
                <div class="row check" v-if="this.subCheck === true">
                    <label for="subcategoryInput">Enter subcategory name:</label>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <my-input
                        id="categoryName"
                        :type="'text'"
                        v-model="this.categoryName"
                        @update="this.onUpdateCategory"
                    />
                </div>
                <div class="row check" v-if="this.subCheck === true">
                    <input id="subcategoryInput" type="text" v-model="this.subcategoryName">
                </div>
            </div>

                <div class="row">
                    <div class="col-3">
                        <label for="subCheck">Subcategory</label>
                    </div>
                    <div class="col-9">
                        <input type="checkbox" class="checkbox" v-model="this.subCheck">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <admin-panel-but :func="createCategory">Create</admin-panel-but>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import AdminPanelBut from "../AdminPanelBut.vue";
import MyInput from "../../MyInput.vue";

export default {
    components: {
        AdminPanelBut,
        MyInput,

    },

    data() {
        return {
            categoryName: '',
            subcategoryName: '',
            subCheck: '',
            images: []
        }
    },


    methods: {
        onImages(imgs){
            this.images = imgs
        },

        updateImages(id){
            this.images = this.images.filter(item => item.id != id)
        },

       onUpdateCategory(target){
           this.categoryName = target
       },

       async createCategory() {
                axios.get('/admin/create_category', {
                params: {
                    categoryName: this.categoryName,
                    subcategoryName: this.subcategoryName,
                    subCheck: this.subCheck
                }
            })
                .then((response) => {
                    this.subcategoryName = ''
                })
                .catch((err) => {
                    console.log(err)
                })
        }
    }
}
</script>

<style scoped>
.categories {
    display: flex;
    justify-content: center;
}

.check {
    margin-top: 10px;
}

.check label {
    margin-top: 7px;
}

.checkbox {
    margin-top: 7px;
}
</style>
