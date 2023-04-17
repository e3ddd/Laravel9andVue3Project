<template>
    <div class="container-fluid items">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                <PersonalAccountItem
                    :label="'Personal data'"
                />
                <PersonalAccountItem
                    :label="'Contacts'"
                />
                <Orders
                    :orders="this.orders"
                />
            </div>
            <div class="col"></div>
        </div>
    </div>
</template>

<script>
import PersonalAccountItem from "./PersonalAccountItem.vue";
import Orders from "./Orders.vue";
export default {
    components: {
        PersonalAccountItem,
        Orders
    },

    data() {
        return {
            orders: []
        }
    },

    mounted() {
        this.getUserOrders()
    },

    methods: {
        async getUserOrders() {
            const response = await axios.get('/get_user_orders')
                .then((response) => {
                    console.log(response)
                    this.orders = response.data
                })
        }
    }
}
</script>

<style scoped>
.items {
    margin-top: 50px;
}

.orders #item {
}

.orders label {
    font-size: 12px;
    color: grey;
}
</style>
