<template>
    <div class="item">
        <div class="imgs">
                <div class="big_img">
                    <img src="" alt="IMG">
                </div>
                <div class="small_imgs" v-for="img in images">
                    <img src="" alt="SMALL_IMG">
                </div>
            </div>
            <div class="about">
                <p>User: <b>{{email}}</b></p>
                <p>Product Name: {{name}}</p>
                <p>Price: {{price}}</p>
                <p>Description: {{description}}</p>
            </div>
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
                    :images="this.images"
                />
                <action-btn
                    :method="viewProduct"
                >
                    View
                </action-btn>
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
            images: [],
            views: 0
        }
    },

   props: {
       id: Number,
       email: String,
       name: String,
       price: Number,
       description: String,
   },

    mounted() {
        this.getImages()
        this.getView()
    },

    methods: {
        async getImages() {
            const response = await axios.get('/users/products/all_images', {
                params: {
                    id: this.id
                }
            })
                .then((response) => {
                    this.images = response.data
                })
                .catch((err) => {

                })
        },

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
     border: 2px solid silver;
     box-shadow: 3px 3px 3px lightgray;
     padding: 20px;
     margin: 30px;
 }

 .imgs {
     display: flex;
     justify-content: center;
 }

 .button {
     display: flex;
     justify-content: space-between;
 }
</style>
