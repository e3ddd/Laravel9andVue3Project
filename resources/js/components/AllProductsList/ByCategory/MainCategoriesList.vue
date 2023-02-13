<template>
    <div class="row links">
        <div :class="category.name" class="link col-3" v-for="category in categories">
            <div class="col-sm-auto">
                <a :href="category.name">{{category.name}}</a>
                <div class="sub__links" v-for="subcategory in category.subcategory">
                    <a :href="category.name + '/' + subcategory.name">{{subcategory.name}}</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        categories: Array,
    },

    methods: {

    }
}
</script>

<style scoped>
.img {
    text-align: center;
}

.links {
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
