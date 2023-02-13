<template>
        <div class="col-md-auto links">
            <div :class="category.name" class="link" v-for="category in categories">
                <div class="col-sm-auto">
                    <a :href="'/' + mainCategory + '/' + category.name">{{category.name}}</a>

                </div>
            </div>
        </div>
</template>

<script>
export default {
    props: {
        categories: Array,
        mainCategory: String,
    },

}
</script>

<style scoped>
.links {
    border: 2px solid silver;
    box-shadow: 3px 3px 3px lightgray;
}

.link a{
    margin: 20px;
    text-decoration: none;
    text-transform: uppercase;
    color: black;
    font-size: 14px;
}

.link a:hover {
    text-decoration: underline;
    color: #df4949;
    font-size: 14px;
    transition: 0.5s;
}


</style>
