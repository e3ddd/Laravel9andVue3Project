<template>
    <form :action="action">
        <input type="submit" :value="value" class="btn">
        <input type="hidden" name="user" :value="id">
    </form>
</template>

<script>
export default {
    props: {
        action: String,
        value: String,
        id: Number
    }
}
</script>

<style scoped>
.btn {
    border: none;
    background: #ff3838;
    color: white;
    box-shadow: 2px 2px 5px grey;
    margin: 5px;
}

.btn:hover {
    background: #661515;
    transition: 0.4s;
}
</style>
