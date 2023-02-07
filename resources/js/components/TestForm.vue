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
        <select name="width" id="" v-model="this.dimensionType">
            <option>millimeters</option>
            <option>centimeters</option>
            <option>meters</option>
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
