<template>
    <div class="row product">
        <div class="col-sm">
            <div class="row">
                <div class="item" v-if="images.length !== 0">
                    <img :src="'storage/images/' + 'SMALL_' + images[0].user_id + '_' + images[0].product_id + '_' + images[0].hash_id" alt="IMG">
                </div>
                <div class="row no__image" v-else>
                    <img alt="No Image">
                </div>
            </div>

        <div class="row">
        <div class="item">ID: <b>{{id}}</b></div>
        </div>
        <div class="row">
        <div class="item">Name:  <b>{{name}}</b></div>
        </div>
        <div class="row">
        <div class="col-sm-auto item">Price:  <b>{{price}}</b></div>
        </div>
            <div>
            <action-btn
                class="descBtn"
            :method="showDesc"
            >
                Description
            </action-btn>
            </div>

            <div class="col-md-auto description" v-if="this.descShow === true">Description: <b>{{description}}</b></div>

            <div class="buttons btn-group">
           <edit-product
               :id="id"
               :name="name"
               :price="price"
               :description="description"
               :images="images"
           />
            <action-btn
                :id="id"
                :method="del"
            >
                Delete
            </action-btn>
        </div>
        </div>
    </div>
</template>

<script>
import ActionBtn from "../UserList/ActionBtn.vue";
import EditProduct from "./EditProduct.vue";
export default {
    components: {
        ActionBtn,
        EditProduct
    },

    data() {
        return {
            show: false,
            descShow: false
        }
    },
    props: {
        id: Number,
        name: String,
        price: Number,
        description: String,
        del: Function,
        images: Array
    },

    methods: {
        showDesc()
        {
            this.descShow = !this.descShow
        }
    }
}
</script>

<style scoped>
.descBtn {
    height: 40px;
}

.no__image {
    padding-top: 38px;
    padding-bottom: 38px;
}

.product {
    padding: 10px;
}

.description {

}

.item {
    padding: 5px;
}

.buttons {
    height: 50px;
}
</style>

