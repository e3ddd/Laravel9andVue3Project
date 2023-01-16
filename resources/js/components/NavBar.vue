<template>
    <div class="container-fluid p-0 index__btns">
        <div class="col">
            <a href="/"><img src="../logo.png" alt="Logo"></a>
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
        <div class="col-sm-auto p-2 index__btn" v-for="button in buttons" v-if="show == false">
            <form :action="button.action" method="GET">
                <input class="btn" type="submit" name="action" :value="button.value">
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            buttons: [
                {action: '/reg_form', value: 'Registration Form'},
                {action: '/users', value: 'Admin Panel'},
                {action: '/add_product', value: 'Add Product'},
                {action: '/users_products', value: 'User Product'},
            ],
            show: false,
            showMenu: false,
        }
    },
    created() {
        this.showBurger()
        window.addEventListener("resize", this.showBurger);
    },

    methods: {
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
