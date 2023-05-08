<template>
    <div class="container">
        <div class="row links">
            <div :class="category.name" class="col-4 link d-flex justify-content-center align-items-center" v-for="(category,key) in categories">
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <a :href="'products/' + category.name">
                                <span class="row category_name">
                                    <img :src="'/storage/categoriesImages/' + this.src[key]" alt="">

                                    <span class="col d-flex justify-content-center">
                                        {{category.name}}
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            src: [
                'materials.jpg',
                'fasteners.png',
                'paints.jpg',
                'wood.png',
                'dveri.png',
                'okna.png',
                'plitka.png'
            ]
        }
    },

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
    transition: 0.5s;
}

.sub__links a{
    color: #025a70;
    font-size: 12px;
}

.sub__links a:hover{
    text-decoration: underline;
    color: #003542;
    font-size: 14px;
    transition: 0.5s;
}


</style>
