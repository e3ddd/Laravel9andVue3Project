<template>
    <img :src="'/storage/images/' + image.product_id + '_' + image.hash_id" @click="showDialog" v-if="!small"/>
    <img :src="'/storage/images/SMALL_' + image.product_id + '_' + image.hash_id" @click="showDialog" v-if="small"/>
    <div class="show_image" v-if="show" @click="show = false">
            <div @click.stop class="image">
                <img :src="'/storage/images/' + image.product_id + '_' + image.hash_id" />
            </div>
        </div>
</template>

<script>

export default {

    data() {
        return {
            show: ''
        }
    },

    props: {
        image: Array,
        small: Boolean
    },

    methods: {
        showDialog() {
            this.show = true
        },
    }
}
</script>

<style scoped>
.show_image {
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
    justify-content: center;
}

.image {
    padding: 15px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    width: 278px;
}
</style>
