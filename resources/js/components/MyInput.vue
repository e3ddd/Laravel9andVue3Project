<template>
        <input :type="type" :value="modelValue" @input="updateInput" :name="name" class="" :placeholder="placeholder">
</template>

<script>
export default {
    props: {
        modelValue: [String, Number],
        type: String,
        name: String,
        placeholder: String,
    },

    methods: {
        updateInput(event) {
            this.$emit('update:modelValue', event.target.value)
        }
    }
}
</script>

<style scoped>
input {

}
</style>
