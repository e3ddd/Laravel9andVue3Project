<template>
    <label for="size" class="d-flex justify-content-center"
           v-if="subcategory !== 'Choose subcategory'">
        <h4 style="margin-top: 10px;">Product dimensions</h4>
    </label>
    <div class="size">
        <div class="row dimensions"
             v-if="
                 subcategory === 'building blocks' ||
                 subcategory === 'bricks' ||
                 subcategory === 'boards' ||
                 subcategory === 'plywood'
                "
        >
            <dimensions
                :height="this.size.height"
                :long="this.size.long"
                :width="this.size.width"
                :weight="this.size.weight"
            />
        </div>

        <div class="row weight"
             v-if="
                    subcategory === 'cement' ||
                    subcategory === 'putty' ||
                    subcategory === 'plaster'
                ">
            <weight
                :weight="this.size.weight"
            />
        </div>

        <div class="row capacity">

        </div>
    </div>
</template>

<script>
import Weight from "./Weight.vue";
import Dimensions from "./Dimensions.vue";
export default {
    components: {
        Weight,
        Dimensions
    },
    props: {
        subcategory: String
    },

    data() {
        return {
            size: {
                long: '',
                width: '',
                height: '',
                capacity: '',
                weight: '',
            },
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
