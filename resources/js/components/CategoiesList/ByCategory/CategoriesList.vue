<template>
        <div class="col-md-auto links">
            <div :class="subcategory.name" class="link" v-for="subcategory in subcategories">
                <div class="col-sm-auto">
                    <a :href="'/products' + '/' + mainCategory + '/' + subcategory.name">{{subcategory.name}}</a>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    props: {
        subcategories: Array,
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
