<template>
    <div class="col star_item">
        <div class="row">
            <div class="col rate_star" v-if="rating >= grade">
                <img src="../../star2.png" width="30" height="30" @click="this.clearRate(grade)">
            </div>
            <div class="col rate_star" v-else>
                <img src="../../star(1).png" width="25" height="25" @click="this.rateProduct(grade)">
            </div>
        </div>
        <div class="row">
            <div class="col rate_text">
                {{rate_text}}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        grade: Number,
        rating: Number,
        rate_text: String
    },

    methods: {
        rateProduct(grade) {
            this.$emit('rateProduct', grade)
        },

        clearRate(grade) {
            let res = grade
            if(this.rating !== grade){
                res = this.rating - this.grade
            }
            this.$emit('clearRate', res)
        }
    }
}
</script>

<style scoped>
.star_item {
    text-align: center;
}

.rate_text {
    padding: 5px;
    font-size: 12px;
}
</style>
