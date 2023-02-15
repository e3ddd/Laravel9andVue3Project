<template>
    <div class="row item">
        <div class="col-1">
            <h6>Long:</h6>
        </div>
        <div class="col-10">
            <my-input
                :type="'text'"
                :model-value="long"
                :name="'productLong'"
                :placeholder="'Long...'"
            />
        </div>
        <div class="col-1 selectType">
            <select v-model="this.longType">
                <option>mm</option>
                <option>cm</option>
                <option>m</option>
            </select>
        </div>
    </div>
    <div class="row item">
        <div class="col-1">
            <h6>Width:</h6>
        </div>
        <div class="col-10">
            <my-input
                :type="'text'"
                :model-value="width"
                :name="'productWidth'"
                :placeholder="'Width...'"
            />
        </div>
        <div class="col-1 selectType">
            <select v-model="this.widthType">
                <option>mm</option>
                <option>cm</option>
                <option>m</option>
            </select>
        </div>
    </div>
        <div class="row item">
                <div class="col-1">
                    <h6>Height:</h6>
                 </div>
                <div class="col-10">
                  <my-input
                    :type="'text'"
                    :model-value="height"
                    :name="'productHeight'"
                    :placeholder="'Height...'"
                  />
                </div>
                <div class="col-1 selectType">
                    <select v-model="this.heightType">
                        <option>mm</option>
                        <option>cm</option>
                        <option>m</option>
                    </select>
                </div>
            </div>
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

    data(){
        return {
            weightType: '',
            longType: '',
            widthType: '',
            heightType: '',
        }
    },

    props: {
        long: String,
        width: String,
        height: String,
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
