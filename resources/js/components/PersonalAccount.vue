<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <personal-data/>
            </div>
            <div class="col-lg">
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
