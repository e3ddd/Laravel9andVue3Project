<template>
<div class="col comment">
    <div class="row w-25">
        <CommentModal
            :product_id="product_id"
        />
    </div>
    <div class="row">
        <CommentsList
            :product_id="product_id"
        />
    </div>
</div>
</template>

<script>
import CommentModal from "./CommentModal.vue";
import CommentsList from "./CommentsList.vue";
export default {
    components: {
        CommentModal,
        CommentsList,
    },

    props: {
        product_id: Number
    }

}
</script>

<style scoped>

</style>
