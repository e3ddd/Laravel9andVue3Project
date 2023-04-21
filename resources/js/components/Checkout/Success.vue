<template>
    <div class="container success">
        <div class="row">
            <div class="col window">
                <div class="row item">
                    <div class="loader" v-if="this.loading === true"></div>
                    <div class="done_icon" v-if="this.loading === false">
                        <img src="../../free-icon-check-390973.png" alt="DONE">
                    </div>
                </div>
                <div class="col" v-if="this.loading === false">
                    <div class="row item">
                        <h3>Thanks for your order !</h3>
                    </div>
                    <div class="row back_link">
                        <a href="/home">Back to homepage</a>
                    </div>
                </div>
                <div class="col" v-else>
                    <div class="row loading">
                        <h3>Checking order status...</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: true,
            count: 0,
        }
    },

    mounted() {
        setInterval(() => {
            axios.post('/check_order_status')
                .then((response) => {
                    if (this.count === 7) {
                        window.location.replace('/cancel')
                    }
                    ++this.count
                    if (response.data === 1) {
                        this.loading = false
                    }
                })
        }, 5000)
    }
}
</script>

<style scoped>
.loader {
    margin-left: 195px;
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #df4949; /* Blue */
    border-radius: 50%;
    width: 80px;
    height: 80px;
    animation: spin 2s linear infinite;
}

.loading {
    margin-top: 50px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

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

.done_icon img{
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
