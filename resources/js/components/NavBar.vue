<template>
    <div class="container-fluid d-flex align-items-center p-0 index__btns" >
        <div class="col">
            <a href="/"><img src="../logo.png" alt="Logo"></a>
        </div>
        <div class="p-2 index__btn" v-for="button in buttons">
            <form :action="button.action" method="GET">
                <input class="btn" type="submit" name="action" :value="button.value">
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            buttons: [
                {action: '/reg_form', value: 'Registration Form'},
                {action: '/users', value: 'Admin Panel'},
                {action: '/add_product', value: 'Add Product'},
                {action: '/users_products', value: 'User Product'},
            ],

        }
    },

    created() {

    },

    methods: {

    }
}
</script>

<style scoped>
.index__btns {
    justify-content: flex-end;
    height: 100px;
    background: #f8f7f7;
}

.btn {
    background: #ff3838;
    color: white;
    box-shadow: 2px 2px 5px grey;
}

.btn:hover {
    background: #661515;
    transition: 0.4s;
}
</style>
