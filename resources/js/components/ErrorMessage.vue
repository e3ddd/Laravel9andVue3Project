<template>
    <div class="error" v-if="err.length > 0">
        {{err}}
    </div>
</template>

<script>
export default {
    props: {
        err: String
    }
}
</script>

<style  scoped>
.error {
    box-shadow: 2px 2px 2px grey;
    border: 2px solid red;
    background: #df4949;
    color: white;
}
</style>
