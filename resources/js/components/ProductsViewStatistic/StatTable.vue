<template>
        <div class="row hours">
        <div class="col" v-for="hour in 24">
            {{hour}}
        </div>
    </div>
    <div class="row" v-for="(item, key) in dates">
     {{key}}
        <div class="col"></div>
        <div class="col-sm cols" v-for="value in item">
            {{value}}
        </div>
    </div>
</template>

<script>
export default {
    props: {
       dates: Array
    }
}
</script>

<style scoped>
.hours {
    margin-left: 138px;
}

.cols {
    border: 1px solid lightgray;
}
</style>
