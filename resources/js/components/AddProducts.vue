<template>
    <div class="container page">
        <div class="row">
    <add-product-form/>
    <add-image-form/>
        </div>
    </div>
</template>

<script>
import AddProductForm from "./AddProducts/AddProductForm.vue";
import AddImageForm from "./AddProducts/AddImageForm.vue";
export default {
    components: {
        AddProductForm,
        AddImageForm
    }

}
</script>

<style scoped>
.page {
    display: flex;
    justify-content: center;
}
</style>
