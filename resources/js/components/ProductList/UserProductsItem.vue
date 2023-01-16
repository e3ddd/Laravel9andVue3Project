<template>
    <div class="row product">
        <div class="col-sm-auto item">ID: <b>{{id}}</b></div>
        <div class="col-sm-auto item">Name:  <b>{{name}}</b></div>
        <div class="col-sm-auto item">Price:  <b>{{price}}</b></div>
        <div class="col-md-auto description">Description:  <b>{{description}}</b></div>
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
}
</script>

<style scoped>
.product {
    display: flex;
    justify-content: center;
    padding: 10px;
}

.description {
    margin-top: 17px;
}

.item {
    padding: 20px;
}

.buttons {
    justify-content: flex-end;

    height: 50px;
}
</style>

