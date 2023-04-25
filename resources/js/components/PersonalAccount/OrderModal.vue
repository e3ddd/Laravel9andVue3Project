<template>
    <div class="order_modal" v-if="show" @click="show = false">
        <div @click.stop class="order_modal_item">
            <h4>About ORDER № {{order.id}}</h4>
            <div class="row" v-for="item in order.products">
                <div class="col name">
                    Name: <a :href="'/about_product/' + item.product_name">{{item.product_name}}</a>
                </div>
                <div class="col">
                    Quantity: {{item.quantity}} pcs
                </div>
                <div class="col">
                    Price: {{(item.product_price * item.quantity) / 100}} UAH
                </div>
            </div>
            <div class="row total_price">
                <div class="col"></div>
                <div class="col">Status: {{order.status}}</div>
                <div class="col">
                    Total price: {{(order.amount).toFixed(2)}} UAH
                </div>
            </div>
        </div>
    </div>
    <small class="button"  @click="this.showDialog">
            ABOUT ORDER
    </small>
</template>

<script>

export default {
    data() {
        return {
            show: false,
        }
    },
    props: {
        order: Array
    },

    methods: {
        showDialog() {
            this.show = true
        },
    }
}
</script>

<style scoped>

.order_modal {
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
}

.order_modal_item {
    padding: 15px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    min-width: 300px;
}

.button {

}
</style>
