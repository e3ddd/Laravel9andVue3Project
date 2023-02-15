<template>
    <button @click="func(attr)"><slot></slot></button>
</template>

<script>
export default {
    props: {
        attr: [Number, String],
        func: Function
    }
}
</script>

<style scoped>
button {
    margin-top: 10px;
    background: #df4949;
    border: none;
    border-radius: 5px;
    color: white;
}
</style>
