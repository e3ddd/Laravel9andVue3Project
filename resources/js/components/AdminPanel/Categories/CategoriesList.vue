<template>
    <div class="container categoriesList">
        <div class="row">
            <div class="col">
                <h4>Categories List</h4>
            </div>
        </div>
            <div class="row search">
                <form @submit.prevent>
                    <div class="col-sm-auto">
                        <input type="search" class="w-25" name="search" @input="searchCategory" v-model="this.search" placeholder="Search category...">
                    </div>
                </form>
            </div>
            <div class="loading" v-if="this.showLoading">
                Loading...
            </div>
            <div class="row">
                <div class="col-sm">
                    ID
                </div>
                <div class="col-sm">
                    Name
                </div>
                <div class="col-sm">
                    Parent ID
                </div>
                <div class="col-sm">

                </div>
            </div>
            <div class="row" v-for="item in this.categoriesList">
                <div class="col-sm-3">
                    {{item.id}}
                </div>
                <div class="col-sm-3 name">
                    {{item.name}}
                </div>
                <div class="col-3" v-if="item.parent_id !== null">
                    {{item.parent_id}}
                </div>
                <div class="col-3" v-else>
                    It's parent !
                </div>
                <div class="col-sm">
                    <edit-category-modal
                        :id="item.id"
                        :category="item.name"
                        :attributes="item.attributes"
                    />
                </div>
                <div class="col-sm">
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
import AdminPanelBut from "../AdminPanelBut.vue";
import EditCategoryModal from "./EditCategoryModal.vue";
import Paginator from "../../UserList/Paginator.vue";
import Math from "lodash";
export default {
    components: {
        EditCategoryModal,
        AdminPanelBut,
        Paginator
    },

    data() {
        return {
            showLoading: false,
            categoriesList: [],
            page: 1,
            total: '',
            search: '',
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
            this.showLoading = true
            const response = await axios.get('/get_all_categories_with_pagination?page=' + page)
                .then((response) => {
                    this.categoriesList = response.data.data
                    this.total = Math.ceil(response.data.total / response.data.per_page)
                    this.showLoading = false
                })
                .catch((err) => {
                    console.log(err)
                })
        },

      async  searchCategory() {
            this.showLoading = true
            const response = await axios.get('/admin/search_category', {
                params: {
                    search: this.search
                }
            })
                .then((response) => {
                    this.categoriesList = response.data.data
                    this.total = Math.ceil(response.data.total / this.limit)
                    this.showLoading = false
                })
                .catch((err) => {
                    console.log(err)
                })
        },

        async del(id) {
            const response = await axios.post('/admin/delete_category',
                {
                        categoryId: id
                }
            )
                .then((response) => {
                    this.categoriesList = this.categoriesList.filter(item => item.id !== id)
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
    padding: 20px;
    border: 1px solid silver;
    box-shadow: 2px 2px 2px silver;
}

.name:first-letter {
    text-transform: uppercase;
}

.search {
    padding-bottom: 10px;
}

.search form button{
    margin-left: 10px;
}
</style>
