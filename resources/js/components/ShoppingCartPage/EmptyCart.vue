<template>
    <div class="row" v-if="length === 0">
        <div class="col d-flex justify-content-center align-content-center">
            <h1>Shopping cart is empty !</h1>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        length: Number
    }
}
</script>

<style scoped>

</style>
