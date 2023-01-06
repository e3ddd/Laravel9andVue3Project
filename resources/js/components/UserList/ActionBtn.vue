<template>
    <button @click="method(id)"><slot></slot></button>
</template>

<script>
export default {
    props: {
        id: [Number, String],
        method: [Function, Boolean]
    },
}
</script>

<style scoped>

button {
    border-radius: 5px;
    border: none;
    background: #ff3838;
    color: white;
    box-shadow: 2px 2px 5px grey;
    margin: 5px;
}

button:hover {
    background: #661515;
    transition: 0.4s;
    color: white;
}
</style>
