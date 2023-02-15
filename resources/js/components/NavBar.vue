<template>
    <div class="container-fluid d-flex p-0 index__btns">
        <div class="col-2">
            <a href="/home"><img src="" alt="Logo"></a>
        </div>
        <div class="col-8 d-flex justify-content-center search">
            <div class="reg_log" v-if="this.userEmail === undefined">
                <img src="../profile.png" alt="pic" width="20" height="20">
                <a href="/registration">Register</a>
                |
                <a href="/login">Login</a>
            </div>
            <form @submit.prevent>
                <input type="search" name="search" v-model="this.search" placeholder="Search product...">
                <button class="searchBtn" @click="searchProduct">Search</button>
            </form>
        </div>
        <div class="col-2 authUser" v-if="this.userEmail !== undefined">
            <div>
                <span>{{this.userEmail}}</span>
                   <span @click="this.showSelectMenuFunc">&#9660;</span>
                <ul class="selectMenu" v-if="this.showSelectMenu === true">
                    <li><a href="/personal_account">Personal Account</a></li>
                    <li><a href="/add_product">Add Product</a></li>
                    <li><a href="/logout">Log Out</a></li>
                </ul>

            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            showSelectMenu: false,
            userEmail: '',
            search: ''
        }
    },
    created() {
        this.getUser()
    },

    methods: {
        async getUser(){
            const response = await axios.post('/get_user')
                .then((response) => {
                    this.userEmail = response.data.email
                })
        },

        showSelectMenuFunc() {
            this.showSelectMenu = !this.showSelectMenu;
        },

        searchProduct() {

        }
    }
}
</script>

<style scoped>

.selectMenu {
    width: 107%;
    text-align: right;
    list-style: none;
    background: #f8f7f7;
    border-radius: 10px;
    margin-top: 35px;
    position: relative;
}

.selectMenu a{
    color: #df4949;
    display: flex;
    justify-content: center;
    text-align: center;
}

.selectMenu a:hover {
    color: #661515;
    transition: 0.5s;
}

.authUser span:hover {
    cursor: pointer;
}

.authUser {
    margin-right: 20px;
    text-align: right;
    margin-top: 30px;
    font-size: 20px;
    color: #df4949;

}

a {
    text-decoration: none;
}

.index__btns {
    height: 100px;
    background: #f8f7f7;
}

.searchBtn {
    margin-left: 10px;
    border-radius: 5px;
    border: none;
    background: #ff3838;
    color: white;
    box-shadow: 2px 2px 5px grey;
}

.search {
    margin-top: 30px;
}

.search input {
    height: 30px;
}

.reg_log {
    margin-right: 10px;
}


.reg_log a {
    text-decoration: none;
    color: black;
    font-size: 14px;
}

.reg_log a:hover {
    color: #df4949;
    font-size: 16px;
    transition: 0.5s;
}
</style>
