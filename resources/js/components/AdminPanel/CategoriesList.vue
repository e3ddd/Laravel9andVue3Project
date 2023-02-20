<template>
    <div class="row title">
        <h4 class="d-flex justify-content-center">Categories List</h4>
    </div>
    <div class="container categoriesList">
        <div class="row">
            <div class="col-3">
                ID
            </div>
            <div class="col-3">
                Name
            </div>
            <div class="col-3">
                Parent ID
            </div>
        </div>
        <div class="row item" v-for="item in this.categoriesList">
            <div class="col-3">
                {{item.id}}
            </div>
            <div class="col-3">
                {{item.name}}
            </div>
            <div class="col-3" v-if="item.parent_id !== null">
                {{item.parent_id}}
            </div>
            <div class="col-3" v-else>
                It's parent !
            </div>
            <div class="col-sm-auto">
                <edit-category-modal
                    :id="item.id"
                    :category="item.name"
                />
            </div>
            <div class="col-sm-auto">
                <admin-panel-but
                    :attr="item.id"
                    :func="del">Delete</admin-panel-but>
            </div>
        </div>
        <paginator
            v-model:total="this.total"
            :get="getCategoriesList"
            @update="onUpdate"
        />
    </div>
</template>

<script>
import AdminPanelBut from "./AdminPanelBut.vue";
import EditCategoryModal from "./EditCategoryModal.vue";
import Paginator from "../UserList/Paginator.vue";
import Math from "lodash";
export default {
    components: {
        EditCategoryModal,
        AdminPanelBut,
        Paginator
    },
    data() {
        return {
            categoriesList: [],
            page: 1,
            limit: 10,
            total: '',
        }
    },

    mounted() {
            this.getCategoriesList(this.page)
        },

    methods: {
        onUpdate() {
            this.categoriesList = []
        },

       async getCategoriesList(page) {
            const response = await axios.get('/get_categories?page=' + page)
                .then((response) => {
                    this.categoriesList = response.data.data
                    this.total = Math.ceil(response.data.total / this.limit)

                })
                .catch((err) => {
                    console.log(err)
                })
        },

        async del(id) {
            const response = await axios.get('/admin/deleteCategory',
                {
                    params: {
                        categoryId: id
                    }
                }
            )
                .then((response) => {
                    this.categoriesList = this.categoriesList.filter(item => item.id !== id)
                    console.log(response)
                })
                .catch((err) => {
                    console.log(err)
                    alert(err.response.data.message)
                })
        }
    }
}
</script>

<style scoped>
.categoriesList{
    width: 1000px;
    padding: 20px;
    border: 1px solid silver;
    box-shadow: 2px 2px 2px silver;
}


</style>
