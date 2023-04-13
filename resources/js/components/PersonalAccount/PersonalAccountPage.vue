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
                <div class="row">
                    <div class="col">
                        <div class="row" v-for="order in this.orders">
                            <div class="row">
                                <div class="col">
                                  {{order.session_id}}
                                </div>
                                <div class="col">
                                    <div class="row" v-for="product in order.products">
                                        {{product}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</template>

<script>
import PersonalAccountItem from "./PersonalAccountItem.vue";
export default {
    components: {
        PersonalAccountItem
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
</style>
