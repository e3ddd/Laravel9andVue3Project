<template>
    <div class="row main">
        <div class="col">
            <div class="row orders" v-for="order in this.orders">
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 order_status">
                            <div class="status_indicator_paid" v-if="order.status === 'paid'"></div>
                            <div class="status_indicator_unpaid" v-else></div>
                        </div>
                        <div class="col-10 about_status">
                            <div class="row title">№ {{order.id}}, {{order.created_at}}</div>
                            <div class="row status_value">{{order.status}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row title">
                        ORDER AMOUNT
                    </div>
                    <div class="row">
                        {{(order.amount.toFixed(2))}} UAH
                    </div>
                </div>
                <div class="col-4">
                    PRODIMG
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        orders: Array
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

.status_indicator_paid {
    position: relative;
    width: 2px;
    height: 35px;
    border-radius: 5px;
    border: 3px solid green;
}

.status_indicator_unpaid {
    position: relative;
    width: 2px;
    height: 35px;
    border-radius: 5px;
    border: 3px solid red;
}

.title {
    font-size: 12px;
}

.about_status .status_value {
    font-size: small;
    text-transform: uppercase;
}
</style>
