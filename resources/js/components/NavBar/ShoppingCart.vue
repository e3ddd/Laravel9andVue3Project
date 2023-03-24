<template>
        <div class="row">
            <div class="col-3 shopping_cart">
                <img src="../../shopping-cart.png" alt="" width="28">
                <div class="circle" v-if="count">
                    <span>{{count}}</span>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    props: {
        count: Number
    }
}
</script>

<style scoped>
.shopping_cart {
    margin-left: 10px;
    cursor: pointer;
    display: flex;
    justify-content: center;
    padding: 5px;
    margin-top: 7px;
}

.circle {
    top: 20px;
    position: relative;
    background: #df4949;
    border: 5px solid #df4949;
    border-radius: 50%;
    height: 12px;
    width: 12px;
}

.circle span {
    color: white;
    font-size: 10px;
    position: relative;
    right: 1.5px;
    bottom: 12.5px;
}
</style>
