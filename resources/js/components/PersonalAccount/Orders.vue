<template>
    <div class="row main">
        <div class="col">
            <div class="row orders" v-for="order in this.orders">
                <div class="col-6">
                    <div class="row">
                        <div class="col-2 order_status">
                            <StatusIndicator
                                :order_status="order.status"
                            />
                        </div>
                        <div class="col-10 about_status">
                            <div class="row title">№ {{order.id}}, {{order.created_at}}</div>
                            <div class="row status_value">{{order.status}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row title">
                        ORDER AMOUNT
                    </div>
                    <div class="row">
                        {{(order.amount.toFixed(2))}} UAH
                    </div>
                </div>
                <div class="col-2 about_order">
                    <div class="row">
                            <OrderModal
                                :order="order"
                            />
                    </div>
                    <div class="row unpaid_order_btns" v-if="order.status === 'unpaid'">
                                <div class="col-6 item pay" @click="this.payByOrder(order.id)">
                                    Pay
                                </div>
                                <div class="col-6">
                                    <AttentionModal
                                        :delete-order="this.deleteOrder"
                                        :order_id="order.id"
                                    />
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <paginator
            v-if="this.total"
            v-model:total="this.total"
            :get="getUserOrders"
            @update="onUpdate"
        />
    </div>
</template>

<script>
import AttentionModal from "./AttentionModal.vue";
import OrderModal from "./OrderModal.vue";
import StatusIndicator from "./StatusIndicator.vue";
import Paginator from "../UserList/Paginator.vue";
import Math from "lodash";
export default {
    components: {
        Paginator,
        OrderModal,
        StatusIndicator,
        AttentionModal
    },

    data() {
        return {
            total: 0,
            page: 1,
            orders: []
        }
    },

    mounted() {
        this.getUserOrders(this.page)
    },

    methods: {
        onUpdate() {
            this.orders = []
        },

        async payByOrder(order_id) {
            const response = await axios.post('/checkout_exists_order', {
                order_id: order_id
            })
                .then((response) => {
                    window.location.replace(response.data)
                })
        },

        async deleteOrder(order_id) {
            const response = await axios.post('/delete_order', {
                order_id: order_id
            })
                .then((response) => {
                    console.log(response)
                })
                .catch(err => alert('You can\'t cancel order which is in the process of payment !'))
        },

        async getUserOrders(page) {
            const response = await axios.get('/get_user_orders?page=' + page)
                .then((response) => {
                    this.orders = response.data.data
                    this.total = Math.ceil(response.data.total / response.data.per_page)
                })
        },


    }
}
</script>

<style scoped>
.main {
    border: 3px solid #f8f7f7;
    margin-top: 20px;
}

.orders {
    margin-top: 20px;
}

.about_order {
    cursor: pointer;
}

.title {
    font-size: 12px;
}

.about_status .status_value {
    font-size: small;
    text-transform: uppercase;
}

.unpaid_order_btns {
    margin-bottom: 10px;
}

.pay {
    color: green;
    margin-right: 10px;
    border: 2px solid green;
    border-radius: 100px;
    width: 53px;
}

.item {
    cursor: pointer;
}

</style>
