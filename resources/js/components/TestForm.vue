<template>

    <form action="" @submit.prevent>
        <div class="row">
        <input type="text" v-model="this.values.width">
        </div>
        <div class="row">
        <input type="text" v-model="this.values.height">
        </div>
        <div class="row">
        <input type="text" v-model="this.values.long">
        </div>
        <select v-model="this.dimensionType">
            <option>ml</option>
            <option>cm</option>
            <option>m</option>
        </select>

        <button @click="this.sendRequest">Submit</button>
    </form>

</template>

<script>
export default {
    data() {
        return {
                dimensionType: '',
                values: {
                    width: '',
                    height: '',
                    long: '',
                }
        }
    },

    methods: {
        sendRequest() {
            const response = axios.get('/test', {
                params: {
                    dimensionType: this.dimensionType,
                    dimensionValues: this.values
                }
            })
                .then(response => console.log(response))
                .catch(err => console.log(err))
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
