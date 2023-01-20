<template>
    <div class="view">
        <div @click.stop class="view_item">
            <div class="imgs">
                <div class="big_img">
                    <img :src="'storage/images/' + images[0].user_id + '_' + images[0].product_id + '_' + images[0].hash_id" alt="MAIN_IMG">
                </div>
                <div class="small_imgs" v-for="img in images">
                    <img :src="'storage/images/' + 'SMALL_' + img.user_id + '_' + img.product_id + '_' + img.hash_id" alt="SMALL_IMG">
                </div>
            </div>
            <div class="about">
                <p>User: <b>{{email}}</b></p>
                <p>Product Name: {{name}}</p>
                <p>Price: {{price}}</p>
                <p>Description: {{description}}</p>
            </div>
            <redirect-btn
                :action="'/view_statistic'"
                :value="'Statistic'"
                :id="id"
            />
        </div>
    </div>
</template>

<script>
import RedirectBtn from "../UserList/RedirectBtn.vue";
export default {
    components: {
        RedirectBtn
    },
    data() {
        return {
            show: false,
        }
    },

    props: {
        id: Number,
        email: String,
        name: String,
        price: Number,
        description: String,
        images: Array
    },

    methods: {
    }
}
</script>

<style scoped>
.view {
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
}

.view_item {
    width: 500px;
    padding: 15px;
    margin: auto;
    background: white;
    border-radius: 12px;
}

</style>
