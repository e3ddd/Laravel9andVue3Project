import './bootstrap';


import {createApp} from 'vue'

import AdminPanel               from "./components/AdminPanel/AdminPanel.vue";
import AdminNavbar              from "./components/AdminPanel/AdminNavbar.vue";
import ProductsPage             from "./components/AdminPanel/Products/ProductsPage.vue";
import TestForm                 from "./components/TestForm.vue";
import Index                    from './Index.vue'
import NavBar                   from "./components/NavBar/NavBar.vue";
import RegForm                  from "./components/RegForm.vue";
import LoginForm                from "./components/LoginForm.vue";
import PersonalAccountPage      from "./components/PersonalAccount/PersonalAccountPage.vue";
import UserList                 from "./components/UserList.vue";
import AllProductsByCategory    from "./components/CategoiesList/ByCategory/AllProductsByCategory.vue";
import AllProductsBySubcategory from "./components/CategoiesList/ByCategory/BySubcategory/AllProductsBySubcategory.vue";
import AboutProduct             from "./components/AboutProduct/AboutProduct.vue";
import ShoppingCartPage         from "./components/ShoppingCartPage/ShoppingCartPage.vue";
import Cancel                   from './components/Checkout/Cancel.vue';
import Success                  from "./components/Checkout/Success.vue";

createApp(AdminPanel).mount('#admin-panel')
createApp(AdminNavbar).mount('#admin-navbar')
createApp(ProductsPage).mount('#product-page')
createApp(TestForm).mount('#test-form')
createApp(Index).mount("#index")
createApp(NavBar).mount("#nav-bar")
createApp(RegForm).mount("#reg-form")
createApp(LoginForm).mount("#login-form")
createApp(PersonalAccountPage).mount('#personal-account-page')
createApp(UserList).mount("#user-list")
createApp(AllProductsByCategory).mount('#all-products-by-category')
createApp(AllProductsBySubcategory).mount('#all-products-by-subcategory')
createApp(AboutProduct).mount('#about-product')
createApp(ShoppingCartPage).mount('#shopping-cart')
createApp(Cancel).mount('#cancel')
createApp(Success).mount('#success');
