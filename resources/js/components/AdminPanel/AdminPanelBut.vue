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
    margin-bottom: 10px;

    background: none;
    color: #025a70;
    border: 1px solid #025a70;
    border-radius: 5px;
}

button:hover {
    transition: 0.5s;
    background: #025a70;
    border: none;
    color: #fff;
}
</style>
