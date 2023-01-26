import './bootstrap';


import {createApp} from 'vue'

import Index from './Index.vue'
import NavBar from "./components/NavBar.vue";
import RegForm from "./components/RegForm.vue";
import LoginForm from "./components/LoginForm.vue";
import PersonalAccount from "./components/PersonalAccount.vue";
import UserList from "./components/UserList.vue";
import AddProducts from "./components/AddProducts.vue";
import ProductList from "./components/ProductList.vue";
import AllProducts from "./components/AllProducts.vue";
import ProductsViewStatistic from "./components/ProductsViewStatistic.vue";
import AllProductsByCategory from "./components/AllProductsList/ByCategory/AllProductsByCategory.vue";



createApp(Index).mount("#index")
createApp(NavBar).mount("#nav-bar")
createApp(RegForm).mount("#reg-form")
createApp(LoginForm).mount("#login-form")
createApp(PersonalAccount).mount("#personal-account")
createApp(UserList).mount("#user-list")
createApp(AddProducts).mount("#add-products")
createApp(ProductList).mount("#product-list")
createApp(AllProducts).mount("#all-products")
createApp(ProductsViewStatistic).mount("#product-view-statistic")
createApp(AllProductsByCategory).mount('#all-products-by-category');
