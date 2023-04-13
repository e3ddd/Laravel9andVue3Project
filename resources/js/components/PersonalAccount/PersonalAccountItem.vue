<template>
    <div class="row item">
        <div class="col image">
            <img alt="icon" :src="src"/>
        </div>
        <div class="col label">
            <span>{{label}}</span>
        </div>
        <div class="col-1 arrow" @click="showContent">
            <span>&#9660;</span>
        </div>
        <div class="row" v-if="this.show == true">
            TEST
        </div>
    </div>

</template>

<script>
export default {
    props: {
        src: String,
        label: String
    },

    data() {
      return {
          show: false
      }
    },

    methods: {
        showContent() {
            this.show = !this.show
        }
    }
}
</script>

<style scoped>
.item {
    border: 3px solid #f8f7f7;
    padding: 10px;
    margin-top: 30px;
}

.item .label {
    font-size: 18px;
}

.arrow span {
    cursor: pointer;
}

</style>
