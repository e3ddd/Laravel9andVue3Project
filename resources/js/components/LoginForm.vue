<template>
    <div class="form">
        <form  id="log_form" @submit.prevent>
            <div class="col">
                <h4>Login Form</h4>
            </div>
            <div class="row-justify-content-center email">
                <label for="inputEmail" class="p-1">Your Email</label>
                <input
                    v-model="this.email"
                    type="email"
                    name="email"
                    class="form-control input-sm"
                    id="regInputEmail"
                    placeholder="Enter email"
                >
            </div>
            <div class="row-justify-content-center password">
                <label for="inputPassword" class="p-1">Your Password</label>
                <input
                    v-model="this.password"
                    type="password"
                    name="password"
                    class="form-control input-sm"
                    id="regInputPassword"
                    placeholder="Enter password"
                >
                <error-message
                    :err="this.err"
                />
            </div>
            <div class="remember">
                <input type="checkbox" id="remember__checkbox" @change="this.remember = true" :value="this.remember">
                <label for="remember__checkbox" class="p-1">Remember Me</label>
            </div>
            <div class="regLink">
                <a href="/registration">Don't have an account ?</a>
            </div>
            <div class="row-justify-content-center p-3" id="submitButton">
                <button class="btn" @click="login">Login</button>
            </div>
        </form>
    </div>
</template>

<script>
import ErrorMessage from "./ErrorMessage.vue";
export default {
    components: {
        ErrorMessage
    },
    data() {
        return {
            err: '',
            email: '',
            password: '',
            remember: false
        }
    },

    methods: {
        async login() {
            const response = await axios.post('/login/log', {

                    email: this.email,
                    password: this.password,
                    remember: this.remember
            })
                .then((response) => {
                    if(response.data  !== ''){
                        window.location.href = '/home'
                    }else{
                        this.email = ''
                        this.password = ''
                        this.err = "Your user doesn't exist !"
                        setTimeout(() => {
                            this.err = ""
                        }, 3000)
                    }
                    const response2 = axios.get('/buy_product')
                })
                .catch((err) => {
                    this.err = err.response.data.message
                    setTimeout(() => {
                        this.err = ""
                    }, 3000)
                    console.log(err)
                })

        }
    }
}
</script>

<style scoped>

.regLink {
    margin-top: 10px;
}

.regLink a{
    color: #ff3838;
}

.form {
    border: 1px solid lightgray;
    box-shadow: 2px 2px 2px gray;
    border-radius: 7px;
    margin-top: 40%;
    padding: 30px;
}

.btn {
    background: #ff3838;
    color: white;
    box-shadow: 2px 2px 5px grey;
}

.btn:hover {
    background: #661515;
    transition: 0.4s;
}

.error {
    box-shadow: 2px 2px 2px grey;
    border: 2px solid red;
    background: #df4949;
    color: white;
}

</style>
