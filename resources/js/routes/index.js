import Vue from "vue";
import VueRouter from "vue-router";
import Home from '../pages/Home.vue';
import Login from '../pages/login.vue';
import CategoryList from '../pages/category/index.vue';
import CategoryCreate from "../pages/category/create.vue";
import CategoryEdit from "../pages/category/edit.vue";
//Product
import ProductList from '../pages/product/index.vue';
import ProductCreate from "../pages/product/create.vue";
import ProductEdit from "../pages/product/edit.vue";
import Dashboard from "../pages/dashboard/index.vue";

Vue.use(VueRouter);

const routes = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            component: Home,
            name: 'home'
        },
        {
            path: '/category', 
            component: CategoryList,
            name: 'category-list'
        },
        {
            path: '/category/create', 
            component: CategoryCreate,
            name: 'category-create'
        },
        {
            path: '/category/edit/:id', 
            component: CategoryEdit,
            name: 'category-edit'
        },
        {
            path: '/product', 
            component: ProductList,
            name: 'product-list'
        },
        {
            path: '/product/create', 
            component: ProductCreate,
            name: 'product-create'
        },
        {
            path: '/product/edit/:id', 
            component: ProductEdit,
            name: 'product-edit'
        },
        {
            path: '/login', 
            component: Login,
            name: 'login'
        },
        {
            path: '/dashboard', 
            component: Dashboard,
            name: 'dashboard'
        }
    ]
})
export default routes;