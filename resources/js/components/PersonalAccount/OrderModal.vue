<template>
    <div class="order_modal" v-if="show" @click="show = false">
        <div @click.stop class="order_modal_item">


        </div>
    </div>
    <small class="button"  @click="this.showDialog">
            ABOUT ORDER
    </small>
</template>

<script>

export default {
    components: {

    },

    data() {
        return {
            show: false,
        }
    },
    props: {
        order: Array
    },


    methods: {
        showDialog() {
            this.show = true
        },

    }
}
</script>

<style scoped>

.order_modal {
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
}

.order_modal_item {
    padding: 15px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    min-width: 300px;
}

.button {

}
</style>
