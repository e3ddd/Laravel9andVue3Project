<template>
    <div class="form">
    <form action="/reg_form/registration" id="reg_form" method="POST" @submit.prevent>
        <div class="col">
            <h4>Registration Form</h4>
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
        <div class="row-justify-content-center p-3" id="submitButton">
           <button class="btn" @click="registration">Register</button>
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
            regUrl: '/reg_form/registration'
        }
    },

    methods: {
        registration() {
                axios.post(this.regUrl, {
                    email: this.email,
                    password: this.password,
                })
                    .then(function (response) {
                        alert('Registration successful !')
                        console.log(response)
                    })
                    .catch((error) => {
                        this.err = error.response.data.message
                        console.log(error)
                    })
                    .finally(() => {
                        this.email = ''
                        this.password = ''
                        setTimeout(() => {
                            this.err = ''
                        }, 3000)
                    })

        }
    }
}
</script>

<style scoped>
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
