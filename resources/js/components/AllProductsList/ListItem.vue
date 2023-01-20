<template>
    <div class="item">
        <div class="imgs" v-if="images.length > 0">
                <div class="big_img">
                    <img :src="'storage/images/' + images[0].user_id + '_' + images[0].product_id + '_' + images[0].hash_id" alt="MAIN_IMG">
                </div>
                <div class="small_imgs" v-for="img in images">
                    <img :src="'storage/images/' + 'SMALL_' + img.user_id + '_' + img.product_id + '_' + img.hash_id" alt="SMALL_IMG">
                </div>
            </div>
            <div class="about">
                <p>User: <b>{{email}}</b></p>
                <p>Product Name: {{name}}</p>
                <p>Price: {{price}}</p>
                <p>Description: {{description}}</p>
            </div>
        <div class="row">
            <div class="button">
                <div
                    class="views"
                >
                    Views: {{this.views}}
                </div>
                <view-product
                    @click="show = false"
                    v-if="show"
                    :id="id"
                    :email="email"
                    :name="name"
                    :price="price"
                    :description="description"
                    :images="images"
                />
                <action-btn
                    :method="viewProduct"
                >
                    View
                </action-btn>
            </div>
        </div>
        </div>
</template>

<script>
import ViewProduct from "./ViewProduct.vue";
import ActionBtn from "../UserList/ActionBtn.vue";

export default {
    components: {
        ViewProduct,
        ActionBtn
    },

    data() {
        return {
            show: false,
            views: 0
        }
    },

   props: {
       id: Number,
       email: String,
       name: String,
       price: Number,
       description: String,
       images: Array
   },

    mounted() {
        this.getView()
    },

    methods: {
        async getView() {
            const response = await axios.get('users_products/' + this.id, {
                params: {
                    prodId: this.id,
                    get: true,
                }
            })
                .then((response) => {
                    this.views = response.data[0].views
                })
                .catch((err) => {
                })
        },

        async viewProduct() {
            this.show = true
            const response = await axios.get('users_products/' + this.id, {
                params: {
                    prodId: this.id,
                }
            })
                .then((response) => {
                    this.views = response.data[0].views
                })
                .catch((err) => {
                })
        },
    }
}
</script>

<style scoped>
 .item {
     height: 95%;
     border: 2px solid silver;
     box-shadow: 3px 3px 3px lightgray;
     padding: 20px;
     margin: 30px;
 }

 .button {
     display: flex;
     justify-content: space-between;
 }
</style>
