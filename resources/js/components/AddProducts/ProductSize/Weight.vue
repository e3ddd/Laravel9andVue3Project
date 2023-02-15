<template>
    <div class="row item">
        <div class="col-1">
            <h6>Weight:</h6>
        </div>
        <div class="col-10">
            <my-input
                :type="'text'"
                :model-value="weight"
                :name="'productWeight'"
                :placeholder="'Weight...'"
            />
        </div>
        <div class="col-1 selectType">
            <select v-model="this.weightType">
                <option>mg</option>
                <option>g</option>
                <option>kg</option>
                <option>t</option>
            </select>
        </div>
    </div>
</template>

<script>
import MyInput from "../../MyInput.vue";
export default {
    components: {
      MyInput
    },
    data() {
        return {
            weightType: '',
        }
    },

    props: {
        weight: String
    }
}
</script>

<style scoped>
.selectType {
    text-align: center;
    margin-top: 5px;
}

.selectType select{
    width: 50px;
    height: 20px;
}

.item {
    margin-top: 10px;
}

h6 {
    margin-top: 10px;
}
</style>
