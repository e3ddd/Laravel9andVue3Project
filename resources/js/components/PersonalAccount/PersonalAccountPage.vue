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
                <Orders/>
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

}
</script>

<style scoped>
.items {
    margin-top: 50px;
}

.orders label {
    font-size: 12px;
    color: grey;
}
</style>
