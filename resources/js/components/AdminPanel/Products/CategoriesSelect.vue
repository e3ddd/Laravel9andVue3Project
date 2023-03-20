<template>
    <select class="select" @change="updateCategory" v-model="categoryName">
        <option v-for="category in categories.filter(item => item.parent_id == categoryId)">{{category.name}}</option>
    </select>
</template>

<script>
export default {
    props: {
        categories: Array,
        categoryId: [Number,null]
    },

    data() {
        return {
            newCategoryId: '',
            categoryName: ''
        }
    },

    watch: {
        categoryName(newName, oldName){
            let categories = this.categories.filter(item => item.name == newName)
            this.newCategoryId = categories[0].id
        },
    },

    methods: {
        updateCategory() {
            this.$emit('onUpdate', this.newCategoryId)
        }

    }
}
</script>

<style scoped>
.select {
    width: 100%;
    margin-left: 30px;
}


</style>
