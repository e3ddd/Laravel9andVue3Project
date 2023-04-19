<template>
    <div class="status_indicator_paid" v-if="order_status=== 'completed'"></div>
    <div class="status_indicator_unpaid" v-else></div>
</template>

<script>
export default {
    props: {
        order_status: String
    }
}
</script>

<style scoped>
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
</style>
