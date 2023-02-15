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
                    <label for="subcategoryInput">Enter subcategory name:</label>
                    <input id="subcategoryInput" type="text" v-model="this.subcategoryName">
<!--                    <div class="subcategoryInput" v-if="this.subcategoryNames.length > 0" v-for="item in this.subcategoryNames" >-->
<!--                        <label for="moreSubcategoryInput">Enter subcategory name:</label>-->
<!--                        <input id="moreSubcategoryInput" type="text" v-model="this.moreSub">-->
<!--                    </div>-->
<!--                    <admin-panel-but :func="addMoreSubcategoryInput">More +</admin-panel-but>-->
                </div>
            <admin-panel-but :func="createCategory">Create</admin-panel-but>
            </div>
        </form>
    </div>
</template>

<script>
import AdminPanelBut from "../AdminPanelBut.vue";
export default {
    components: {
        AdminPanelBut
    },

    data() {
        return {
            categoryName: '',

            subcategoryName: '',
            subCheck: '',
        }
    },

    methods: {
        createCategory() {
                const response = axios.get('/admin/createCategory', {
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
.subcategoryCheck {
    display: flex;
    justify-content: left;
}

.subcategoryCheck input {
    margin-left: 10px;
}

</style>
