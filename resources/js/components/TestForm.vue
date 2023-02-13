<template>

    <form action="" @submit.prevent>
        <div class="row">
        <input type="text" v-model="this.value">
        </div>
        <select v-model="this.dimensionType">
            <option>mg</option>
            <option>g</option>
            <option>kg</option>
            <option>t</option>
        </select>

        <button @click="this.sendRequest">Submit</button>
    </form>

</template>

<script>
export default {
    data() {
        return {
                dimensionType: '',
                value: ''
        }
    },

    methods: {
        sendRequest() {
            const response = axios.get('/test', {
                params: {
                    dimensionType: this.dimensionType,
                    dimensionValue: this.value
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
