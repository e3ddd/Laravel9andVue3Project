<template>
    <div class="col-sm-2 label">
        <label class="label">{{name}}:</label>
    </div>
    <div class="col-lg-8">
        <div class="row">
            <label for="">Long:</label>
            <div class="col-lg-auto">
                <my-input
                    :type="'text'"
                    v-model="prodSize.long"
                    />
            </div>
            <div class="col">{{prodSize.dimension}}</div>
        </div>
        <div class="row">
            <label for="">Width:</label>
            <div class="col">
                <my-input
                    :type="'text'"
                    v-model="prodSize.width"
                />
            </div>
            <div class="col">{{prodSize.dimension}}</div>
        </div>
        <div class="row">
            <label for="">Height:</label>
            <div class="col">
                <my-input
                    :type="'text'"
                    v-model="prodSize.height"
                />
            </div>
            <div class="col">{{prodSize.dimension}}</div>
        </div>

    </div>
</template>

<script>
import MyInput from "../../MyInput.vue";
export default {
    components: {
      MyInput
    },
    props: {
        name: String,
        prodSize: Object,
    },

    methods: {
        onUpdate(event) {
            this.$emit('update:prodSize', event.target.value)
        }
    }
}
</script>

<style scoped>
.label :first-letter {
    text-transform: uppercase;
}
</style>
