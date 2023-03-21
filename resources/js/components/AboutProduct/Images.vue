<template>
    <div class="container images">
        <div class="row">
            <div class="col">
                <show-image-modal
                    :image="images[0]"
                    :small="false"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-auto" v-for="image in images">
                <show-image-modal
                    :image="image"
                    :small="true"
                />
            </div>
        </div>
    </div>
</template>

<script>
import ShowImageModal from "./ShowImageModal.vue";
export default {
    components: {
        ShowImageModal
    },

    props: {
        images: Array
    }
}
</script>

<style scoped>
.images {

}
</style>
