<template>
    <div class="all__link">
        <a href="/home">products</a>&#187;<a :href="'/products/' + category">{{category}}</a>
    </div>
</template>

<script>
export default {
    props: {
        category: String
    }
}
</script>

<style scoped>
.all__link {
    padding-bottom: 10px;
}

.all__link a {
    padding: 10px;
    text-decoration: none;
    text-transform: uppercase;
    color: black;
    font-size: 14px;
}

.all__link a:hover {
    text-decoration: underline;
    color: #df4949;
}
</style>
