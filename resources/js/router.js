// ADMIN
import DashBoardComponent from './components/backend/dashboard/DashBoardComponent.vue';
import LoginComponent from './components/backend/login/LoginComponent.vue';
// categories
import ListCategoriesComponent from './components/backend/categories/ListCategoriesComponent.vue';
// type product
import ListTypeProductComponent from './components/backend/type_product/ListTypeProductComponent.vue';


// USER
import HomeComponent from './components/frontend/home/HomeComponent.vue';
export const routes = [
    // ADMIN
    {
        name:'adminLogin',
        path:'/admin/login',
        component:LoginComponent
    },
    {
        name: 'dashboard',
        path: '/admin/dashboard',
        component: DashBoardComponent
    },
    // categories
    {
        name:'list_categories',
        path:'/admin/categories',
        component:ListCategoriesComponent
    },
    // type
    {
        name:'list_type',
        path:'/admin/type',
        component:ListTypeProductComponent
    },



    // USER
    {
        name:'home',
        path:'/',
        component:HomeComponent
    }
]