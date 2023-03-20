<template>
    <div class="container-fluid index__btns">
        <div class="row">
            <div class="col-4">
                <a href="/home"><img src="" alt="Logo"></a>
            </div>
            <div class="col-8 search">
                <div class="row">
                    <div class="col-2">
                        <div class="reg_log" v-if="this.userEmail === undefined">
                            <img src="../profile.png" alt="pic" width="20" height="20">
                            <a href="/registration">Register</a>
                            |
                            <a href="/login">Login</a>
                        </div>
                    </div>
                    <div class="col-10 w-25">
                        <form @submit.prevent>
                            <div class="col">
                                <div class="row">
                                    <input type="search" name="search" v-model="this.search" @keyup.delete="checkInput" @input="searchProduct" placeholder="Search product...">
                                </div>
                                <div class="row products" v-for="product in this.products" v-if="this.products !== []">
                                    <div class="col p-1">
                                        <div class="row">
                                            <div class="col-4">
                                                <img :src="'/storage/images/SMALL_' + product.image[0].product_id + '_' + product.image[0].hash_id"/>
                                            </div>
                                            <div class="col-8">
                                                <a :href="'/products/' + product.name + '/about'">{{product.name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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

    </div>
</template>

<script>
export default {
    data() {
        return {
            showSelectMenu: false,
            products: [],
            userEmail: '',
            search: ''
        }
    },
    created() {
        this.getUser()
    },


    methods: {
        checkInput()
        {
          if(this.search == ''){
              this.products = []
          }
        },

        async getUser(){
            const response = await axios.get('/get_user')
                .then((response) => {
                    this.userEmail = response.data.email
                })
        },

        showSelectMenuFunc() {
            this.showSelectMenu = !this.showSelectMenu;
        },

        searchProduct() {
            if(this.products !== []){
                this.products = []
            }
            const response = axios.get('/search_product', {
                params: {
                    search: this.search
                }
            })
                .then((response) => {
                    this.products = response.data
                })
        }
    }
}
</script>

<style scoped>

.index__btns {
    position: relative;
}

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
    color: black;
    text-decoration: none;
}

.index__btns {
    height: 100px;
    background: #f8f7f7;
}


.products {
    position: relative;
    background: white;
}

.search {
    margin-top: 30px;
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
