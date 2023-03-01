<template>
    <button @click="up" :id="id">&#8593;</button>
    <button @click="down" :id="id">&#8595;</button>
</template>

<script>
export default {

    props: {
        id: Number,
        obj: Object
    },
    methods: {
        up(event) {
            const prevIndex = Number(event.target.id) - 1
            const prevObj = this.obj[prevIndex]
            const currObj = this.obj[event.target.id]
            if (prevIndex >= 0) {
                let tmp = prevObj.order
                prevObj.order = currObj.order
                currObj.order = tmp

                this.obj[prevIndex] = currObj
                this.obj[event.target.id] = prevObj
            }
        },

        down(event) {
            const nextIndex = Number(event.target.id) + 1
            const nextObj = this.obj[nextIndex]
            const currObj = this.obj[event.target.id]

            if (nextIndex <= 3) {
                let tmp = nextObj.order
                nextObj.order = currObj.order
                currObj.order = tmp

                this.obj[nextIndex] = currObj
                this.obj[event.target.id] = nextObj
            }
        },
    }
}
</script>

<style scoped>
button {
    margin-right: 3px;
    margin-top: 15px;
    background: #df4949;
    border: none;
    border-radius: 5px;
    color: white;
}
</style>
