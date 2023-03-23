<template>
    <div class="row reg_log" v-if="userEmail === undefined">
        <div class="col-1">
            <img src="../../profile.png" alt="pic" width="20" height="20">
        </div>
        <div class="col-3">
            <a href="/registration">Register</a>|<a href="/login">Login</a>
        </div>
    </div>
    <div class="row reg_log" v-else>
        <div class="col-1">
            <img src="../../profile.png" alt="pic" width="20" height="20">
        </div>
        <div class="col-10">
            <div class="row" @click="this.showNavMenu">
                <div class="col-9">
                    {{userEmail}}
                </div>
                <div class="col-3 arrow"> &#9660;</div>
                <div class="row selectMenu" v-if="this.show == true" @click="this.showNavMenu">
                    <a href="/personal_account">Personal Account</a>
                    <a :href="'/' + this.userEmail + '/shopping_cart'">Shopping Cart</a>
                    <a href="/logout">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        userEmail: String
    },

    data() {
        return {
            show: false
        }
    },

    methods: {
        showNavMenu() {
            this.show = !this.show
        }
    }
}
</script>

<style scoped>
.reg_log a {
    margin: 10px;
    text-decoration: none;
    color: black;
    font-size: 14px;
}

.reg_log a:hover {
    color: #df4949;
    font-size: 16px;
    transition: 0.5s;
}

.arrow {
    cursor: pointer;
}

.selectMenu {
    position: relative;
    background: #f8f7f7;
    border-radius: 10px;
}

.selectMenu a{
    color: black;
    display: flex;
}

.selectMenu a:hover {
    color: #df4949;
    transition: 0.5s;
}

</style>
