<template>
    <div class="container success">
        <div class="row">
            <div class="col window">
                <div class="row item">
                    <div class="done_icon">
                        <img src="../../multiply.png" alt="DONE">
                    </div>
                </div>
                <div class="row item">
                    <h3>Something went wrong :(</h3>
                </div>
                <div class="row back_link">
                    <a href="/home">Back to homepage</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.deleteOrder()
    },

    methods: {
        async deleteOrder() {
            const response = await axios.post('/delete_order')
        }
    }

}
</script>

<style scoped>
.success {
    position: fixed;
    width: 500px;
    height: 300px;
    top: 30%;
    left: 35%;
    border: 1px solid silver;
    background: #f5f0f0;
    border-radius: 5px;
}

.success .window {
    text-align: center;
    margin-top: 80px;
}

.done_icon {
    margin-bottom: 10px;
}

.done_icon img {
    width: 50px;
    height: 50px;
}

.back_link {
    margin-top: 10px;
}

.back_link a {
    font-size: 14px;
    color: #df4949;
}

.back_link a:hover {
    color: #661515;
    font-size: 16px;
    transition: 0.5s;
}
</style>
