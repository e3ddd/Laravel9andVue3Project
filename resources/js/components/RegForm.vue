<template>
    <div class="form">
    <form id="reg_form" @submit.prevent>
        <div class="col">
            <h4>Registration Form</h4>
        </div>
        <div class="row-justify-content-center email">
            <label class="p-1">Your Email</label>
            <input
                v-model="this.email"
                type="email"
                name="email"
                class="form-control input-sm"
                placeholder="Enter email"
            >
        </div>
        <div class="row-justify-content-center email">
            <label class="p-1">Your Name</label>
            <input
                v-model="this.name"
                type="text"
                name="name"
                class="form-control input-sm"
                placeholder="Enter name"
            >
        </div>
        <div class="row-justify-content-center password">
            <label class="p-1">Your Password</label>
            <input
                v-model="this.password"
                type="password"
                name="password"
                class="form-control input-sm"
                placeholder="Enter password"
            >
            <label class="p-1">Confirm Password</label>
            <input
                v-model="this.confirmPassword"
                type="password"
                name="password"
                class="form-control input-sm"
                placeholder="Enter password again"
            >
            <error-message
                :err="this.err"
            />
        </div>
        <div class="logLink">
        <a href="/login">Do you have account ?</a>
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
        ErrorMessage,
    },
    data() {
        return {
            err: '',
            email: '',
            password: '',
            confirmPassword: '',
            name: '',
            regUrl: '/reg_form/registration'
        }
    },


    methods: {
       async registration() {
                const response = await axios.post(this.regUrl, {
                    email: this.email,
                    password: this.password,
                    name: this.name,
                    confirm: this.confirmPassword
                })
                    .then((response) => {
                        alert('Registration successful !')
                    })
                    .catch((error) => {
                        this.err = error.response.data.message
                    })
                    .finally(() => {
                        this.password = ''
                        this.confirmPassword = ''
                        setTimeout(() => {
                            this.err = ''
                        }, 3000)
                    })

        }
    }
}
</script>

<style scoped>

.logLink {
    margin-top: 10px;
}

.logLink a{
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
</style>
