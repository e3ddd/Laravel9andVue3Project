import './bootstrap';


import {createApp} from 'vue'

import AdminPanel from "./components/AdminPanel/AdminPanel.vue";
import AdminNavbar from "./components/AdminPanel/AdminNavbar.vue";
import ProductsPage from "./components/AdminPanel/Products/ProductsPage.vue";
import TestForm from "./components/TestForm.vue";
import Index from './Index.vue'
import NavBar from "./components/NavBar.vue";
import RegForm from "./components/RegForm.vue";
import LoginForm from "./components/LoginForm.vue";
import PersonalAccount from "./components/PersonalAccount.vue";
import UserList from "./components/UserList.vue";
import ProductsViewStatistic from "./components/ProductsViewStatistic.vue";
import AllProductsByCategory from "./components/CategoiesList/ByCategory/AllProductsByCategory.vue";
import AllProductsBySubcategory
    from "./components/CategoiesList/ByCategory/BySubcategory/AllProductsBySubcategory.vue";


createApp(AdminPanel).mount('#admin-panel')
createApp(AdminNavbar).mount('#admin-navbar')
createApp(ProductsPage).mount('#product-page')
createApp(TestForm).mount('#test-form')
createApp(Index).mount("#index")
createApp(NavBar).mount("#nav-bar")
createApp(RegForm).mount("#reg-form")
createApp(LoginForm).mount("#login-form")
createApp(PersonalAccount).mount("#personal-account")
createApp(UserList).mount("#user-list")
createApp(ProductsViewStatistic).mount("#product-view-statistic")
createApp(AllProductsByCategory).mount('#all-products-by-category')
createApp(AllProductsBySubcategory).mount('#all-products-by-subcategory')

