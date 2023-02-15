<template>
    <div class="edit_form" v-if="show" @click="show = false">
        <div @click.stop class="edit_form_item">
                <label for="category">Edit category:</label>
                <my-input
                    :placeholder="category"
                    :type="'text'"
                    :name="'category'"
                    v-model="this.newCategory"
                />
            <admin-panel-but
                :func="edit"
            >
                Edit
            </admin-panel-but>
        </div>
    </div>
    <admin-panel-but
        :func="showDialog"
    >
        Edit
    </admin-panel-but>
</template>

<script>
import AdminPanelBut from "../AdminPanelBut.vue";
import MyInput from "../../MyInput.vue";
export default {

    components: {
        AdminPanelBut,
        MyInput
    },

    data() {
        return {
            show: false,
            newCategory: this.category,
        }
    },
    props: {
        id: Number,
        category: String,
    },

    mounted() {
    },

    methods: {
        showDialog() {
            this.show = true
            console.log(this.id)

        },

        edit() {
            const response = axios.get('/admin/editCategory', {
                params: {
                    categoryId: this.id,
                    newCategoryName: this.newCategory,
                }

            })
                .then((response) => {
                    console.log(this.newCategory)
                })

                .catch((err) => {
                    console.log(err)
                    console.log(this.newCategory)

                })
        }
    }
}
</script>

<style scoped>
label {
    margin-right: 10px;
}

.edit_form {
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
}

.edit_form_item {
    padding: 15px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    min-width: 300px;
}
</style>
