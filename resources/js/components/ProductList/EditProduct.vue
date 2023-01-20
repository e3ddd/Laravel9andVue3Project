<template>
    <div class="edit_form" v-if="show" @click="show = false">
        <div @click.stop class="edit_form_item">
            <div class="delete_img" v-if="images.length > 0">
                <div class="img" v-for="img in images">
                    <img :src="'/storage/images/' + 'SMALL_' + img.user_id + '_' + img.product_id + '_' + img.hash_id" alt="img">
                    <action-btn
                        :id="img.id"
                        :method="this.del"
                    >
                        Delete
                    </action-btn>
                </div>
            </div>
            <label>Edit name:</label>
            <my-input
                v-model="this.requestName"
                :name="'name'"
                :type="'text'"
            />
            <label>Edit price:</label>
            <my-input
                v-model="this.requestPrice"
                :name="'price'"
                :type="'text'"
            />
            <div class="description">
            <p style="margin-top: 10px; margin-bottom: -1px;">Edit description:</p>
            <textarea
            v-model="this.requestDescription"
            />
            </div>


            <action-btn
                :method="editProduct"
            >
                Edit
            </action-btn>
        </div>
    </div>
    <action-btn
        :method="showDialog"
    >
        Edit
    </action-btn>
</template>

<script>
import ActionBtn from "../UserList/ActionBtn.vue";
import MyInput from "../MyInput.vue";
export default {

    components: {
        MyInput,
        ActionBtn
    },

    data() {
        return {
            show: false,
            requestName: this.name,
            requestPrice: this.price,
            requestDescription: this.description,
        }
    },
    props: {
        id: Number,
        name: String,
        price: Number,
        description: String,
        images: Array
    },

    mounted() {

    },

    methods: {
        showDialog() {
            this.show = true
        },

        async editProduct() {
                const response = await axios.get('/users/products/edit', {
                    params: {
                        id: this.id,
                        name: this.requestName,
                        price: this.requestPrice,
                        description: this.requestDescription,
                    }
                })
                    .then((response) => {
                        alert('Your product edited !')

                    })
                    .catch((error) => {
                        console.log(error);
                    })
                    .finally(() => {
                        this.show = false
                    })
        },

        async del(id) {
            const response = await axios.post('/users/products/delete_img', {
                    id: id,
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

textarea {
    width: 500px;
    height: 200px;
}

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
