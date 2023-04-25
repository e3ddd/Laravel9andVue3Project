<template>
    <div class="attention_modal" v-if="show" @click="show = false">
        <div @click.stop class="attention_item">
            <div class="row">
                <h5>
                    Are you sure you want to cancel your order ?
                </h5>
            </div>
            <div class="row btns">
                <div class="col-3"></div>
                <div class="col-4 agree">
                    <a href="/personal_account" @click="deleteOrder(order_id)">Yes</a>
                </div>
                <div class="col-4 disagree">
                    <a @click="this.showDialog">No</a>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
    <div class="cancel" @click="this.showDialog">
        <span>Cancel</span>
    </div>
</template>

<script>
export default {
   props: {
       deleteOrder: Function,
       order_id: Number
   },

    data() {
       return {
           show: false,
       }
    },

    methods: {
        showDialog() {
            this.show = !this.show
        },
    }
}
</script>

<style scoped>
.attention_modal {
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
}

.attention_item {
    padding: 15px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    min-width: 300px;
}

.cancel {
    cursor: pointer;
    color: red;
    border: 2px solid red;
    border-radius: 100px;
    width: 75px;
}

.cancel span {
    margin-left: 10px;
}

.btns {
    margin-top: 10px;
}

.btns .disagree a {
    background: none;
    border: 2px solid black;
    border-radius: 10px;
    padding: 7px;
}

.btns .disagree a:hover {
    background: red;
    cursor: pointer;
    transition: 0.5s;
    color: white;
}

.btns .agree a {
    text-decoration: none;
    border: 2px solid green;
    border-radius: 10px;
    padding: 7px;
    color: green;
}

.btns .agree a:hover {
    transition: 0.5s;
    background: limegreen;
    color: white;
}

</style>



