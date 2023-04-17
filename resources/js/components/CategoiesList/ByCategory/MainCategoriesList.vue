<template>
    <div class="container">
        <div class="row links">
            <div :class="category.name" class="col link" v-for="category in categories">
                <a :href="'products/' + category.name">{{category.name}}</a>
                <div class="sub__links" v-for="subcategory in subcategories">
                    <a :href="'products/' + category.name + '/' + subcategory.name" v-if="subcategory.parent_id === category.id">{{subcategory.name}}</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        categories: Array,
        subcategories: Array,
    },
}
</script>

<style scoped>
.links {
    padding-left: 30px;
    margin: 20px;
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
    transition: 0.5s;
}

.sub__links a{
    color: #661515;
    font-size: 12px;
}

.sub__links a:hover{
    text-decoration: underline;
    color: #df4949;
    font-size: 14px;
    transition: 0.5s;
}

</style>
