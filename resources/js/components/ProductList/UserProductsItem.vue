<template>
    <div class="row product">
        <div class="col-1 item">ID: <b>{{id}}</b></div>
        <div class="col-2 item">Name:  <b>{{name}}</b></div>
        <div class="col-2 item">Price:  <b>{{price}}</b></div>
        <div class="col-3 description">Description:  <b>{{description}}</b></div>
        <div class="col-2 buttons btn-group">
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

    mounted() {

    },

    methods: {

    }
}
</script>

<style scoped>
.product {
    display: flex;
    justify-content: center;
    padding: 10px;
}

.description {

    margin-left: 100px;
}

.item {
    padding: 20px;
}

.buttons {
    margin-left: 50px;
    height: 50px;
}
</style>

