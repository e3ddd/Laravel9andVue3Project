<template>
    <div class="container-fluid p-0 index__btns">
        <div class="col">
            <a href="/home"><img src="../logo.png" alt="Logo"></a>
        </div>
        <div class="burgerMenu" v-if="showMenu">
            <div class="burger__link" v-for="link in buttons">
                <a :href="link.action">{{link.value}}</a>
            </div>
        </div>
        <div class="burger" v-if="show" @click="showBurgerMenu">
            <div class="burger__btn">
                <span class="row burger__item"></span>
                <span class="row burger__item"></span>
                <span class="row burger__item"></span>
            </div>
        </div>
        <div class="col-2 userEmail">
            <div>
                {{this.userEmail}}
                   <span @click="this.showSelectMenuFunc">&#9660;</span>
                <ul class="selectMenu" v-if="this.showSelectMenu == true">
                    <li><a href="/personal_account">Personal Account</a></li>
                    <li><a href="/users_products">All Products List</a></li>
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
            show: false,
            showMenu: false,
            showSelectMenu: false,
            userEmail: '',
        }
    },
    created() {
        this.getUser()
        this.showBurger()
        window.addEventListener("resize", this.showBurger);
    },

    methods: {
        async getUser(){
            const response = axios.post('/get_user')
                .then((response) => {
                    this.userEmail = response.data.email
                })
        },

        showSelectMenuFunc() {
            this.showSelectMenu = !this.showSelectMenu;
        },

        showBurger() {
            this.show = window.innerWidth < 920
            this.showMenu = false
        },

        showBurgerMenu() {
            this.showMenu = !this.showMenu;
        }
    }
}
</script>

<style scoped>

.selectMenu {
    text-align: right;
    list-style: none;
    background: #f8f7f7;
    border-radius: 10px;
    margin-top: 35px;
    position: relative;
}

.selectMenu a{
    color: #df4949;
}

.selectMenu a:hover {
    color: #661515;
    transition: 0.5s;
}

.userEmail span:hover {
    cursor: pointer;
}

.userEmail {
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
    display: flex;
    justify-content: flex-end;
    height: 100px;
    background: #f8f7f7;
}

.btn {
    margin-top: 20px;
    background: #ff3838;
    color: white;
    box-shadow: 2px 2px 5px grey;
}

.btn:hover {
    background: #661515;
    transition: 0.4s;
}

.burger {
    margin-right: 20px;
    margin-top: 20px;
}

.burger__btn {
    padding: 10px 25px 15px 25px;
    border: 1px solid #ff3838;
    box-shadow: 4px 4px 4px lightgray;
    border-radius: 5px;
}

.burger__item {
    width: 25px;
    height: 2px;
    margin-top: 5px;
    border: 1px solid #ff3838;
    background: black;
}

.burgerMenu {
    overflow: hidden;
    margin-top: 98px;
    margin-right: -75px;
    height: 140px;
    z-index: 2;
    float: right;
    background: #f8f7f7;
    padding: 20px;
    border-radius: 0 0 0 20%
}

.burger__link a{
    color: #ff3838;
}
</style>
