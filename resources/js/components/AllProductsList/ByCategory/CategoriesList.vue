<template>
        <div class="col-1 links">
            <div :class="category.name" class="link" v-for="category in categories"><a :href="category.name">{{category.name}} &#187;</a></div>
        </div>
</template>

<script>
export default {
    props: {
        categories: Array
    }
}
</script>

<style scoped>
.links {
    text-align: center;
    width: 180px;
    height: 300px;
    border: 2px solid lightgray;
    margin-right: 20px;
}

.link a{
    text-decoration: none;
    text-transform: uppercase;
    color: black;
    font-size: 14px;
}

.link a:hover {
    text-decoration: underline;
    color: #df4949;
    font-size: 16px;
    transition: 0.5s;
}


</style>
