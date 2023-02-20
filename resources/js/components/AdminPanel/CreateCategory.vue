<template>
    <div class="container-fluid categories">
        <form @submit.prevent>
            <div class="col-9 justify-content-center ">
                <div class="categoryInput">
                    <label for="categoryName">Enter category name:</label>
                    <input type="text" v-model="this.categoryName">
                </div>
                      <div class="row">
                          <div class="col subcategoryCheck">
                              <label for="subCheck">Subcategory</label>
                              <input type="checkbox" v-model="this.subCheck">
                          </div>
                      </div>


                <div class="subcategoryInput" v-if="this.subCheck === true">
                    <label for="subCheck">Enter subcategory name:</label>
                    <input type="text" v-model="this.subcategoryName">
                </div>
            <admin-panel-but :func="createCategory">Create</admin-panel-but>
            </div>
        </form>
    </div>
</template>

<script>
import AdminPanelBut from "./AdminPanelBut.vue";
export default {
    components: {
        AdminPanelBut
    },

    data() {
        return {
            categoryName: '',
            subcategoryName: '',
            subCheck: ''
        }
    },

    methods: {
       async createCategory() {
            const response = await axios.get('/admin/createCategory', {
                params: {
                    categoryName: this.categoryName,
                    subcategoryName: this.subcategoryName,
                    subCheck: this.subCheck
                }
            })
                .then((response) => {
                    console.log(response)
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

}

.subcategoryCheck {
    display: flex;
    justify-content: left;
}

.subcategoryCheck input {
    margin-left: 10px;
}

</style>
