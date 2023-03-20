<template>
    <links
        :category="category"
    />

    <div class="container">
        <div class="row">
            <div class="col-3 d-flex justify-content-center" v-for="product in products">
                 <list-item :product="product"/>
            </div>
        </div>
    </div>

</template>

<script>
import ListItem from "../ListItem.vue";
import Links from "./Links.vue";
export default {
    components: {
        Links,
        ListItem
    },

    props: {
        category: String,
        products: Array,
    }
}
</script>

<style scoped>

</style>
