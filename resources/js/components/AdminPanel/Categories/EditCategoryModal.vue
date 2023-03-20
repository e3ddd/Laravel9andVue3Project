<template>
    <div class="edit_form" v-if="show" @click="show = false">
        <div @click.stop class="edit_form_item">
                <label for="category"><h5>Edit category name:</h5></label>
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
            <div class="subcategory_attributes pt-2" >
                <h5>Attributes List</h5>
                <div v-for="attribute in attributes" v-if="this.newAttributes.length == 0">
                    <div class="row">
                        <div class="col mt-2 attribute">
                            {{attribute.name}}
                        </div>
                        <div class="col">
                            <admin-panel-but
                                :func="del"
                                :attr="attribute.id"
                            >
                                Delete
                            </admin-panel-but>
                        </div>
                    </div>
                </div>

                <div v-for="attribute in this.newAttributes" v-if="this.newAttributes.length !== 0">
                    <div class="row">
                        <div class="col mt-2 attribute">
                            {{attribute.name}}
                        </div>
                        <div class="col">
                            <admin-panel-but
                                :func="del"
                                :attr="attribute.id"
                            >
                                Delete
                            </admin-panel-but>
                        </div>
                    </div>
                </div>
            </div>
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
            newAttributes: []
        }
    },
    props: {
        id: Number,
        category: String,
        attributes: Array,
    },


    methods: {
        showDialog() {
            this.show = true
        },



       async edit() {
            const response = await axios.get('/admin/edit_category', {
                params: {
                    categoryId: this.id,
                    newCategoryName: this.newCategory,
                }

            })
                .then((response) => {
                    console.log(response)
                })

                .catch((err) => {
                    console.log(err)
                })
        },

        async del(id) {
            const response = await axios.post('/admin/delete_attribute', {
                attributeId: id
            })
                .then((response) => {

                    this.newAttributes = this.attributes.filter(item => item.id !== id)
                })
                .catch(err => console.log(err))
        }
    }
}
</script>

<style scoped>
label {
    margin-right: 10px;
}

.but {
    margin-right: 5px;
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

.attribute:first-letter {
    text-transform: uppercase;
}
</style>
