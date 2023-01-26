<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <personal-data/>
            </div>
            <div class="col-8">
                <personal-products/>
            </div>
        </div>
    </div>
</template>

<script>
import PersonalData from "./PersonalAccount/PersonalData.vue";
import PersonalProducts from "./PersonalAccount/PersonalProducts.vue";
export default {
    components: {
        PersonalProducts,
        PersonalData
    }

}
</script>

<style scoped>

</style>
