// ADMIN
// dashboard
import DashBoardComponent from './components/backend/dashboard/DashBoardComponent.vue';
// login
import LoginComponent from './components/backend/login/LoginComponent.vue';
// categories
import ListCategoriesComponent from './components/backend/categories/ListCategoriesComponent.vue';
// type product
import ListTypeProductComponent from './components/backend/type_product/ListTypeProductComponent.vue';
// user
import ListUserComponent from './components/backend/user/ListUserComponent.vue';
// province
import ListProvinceComponent from './components/backend/province/ListProvinceComponent.vue';
// district
import ListDistrictComponent from './components/backend/district/ListDistrictComponent.vue'
// ward
import ListWardComponent from './components/backend/ward/ListWardComponent.vue';
// post
import ListPostComponent from './components/backend/post/ListPostComponent.vue';

// USER
import HomeComponent from './components/frontend/home/HomeComponent.vue';
import DetailPostComponent from './components/frontend/post/DetailPostComponent.vue';
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
    // user
    {
        name:'list_user',
        path:'/admin/user',
        component:ListUserComponent
    },
    // province
    {
        name:'list_province',
        path:'/admin/province',
        component:ListProvinceComponent
    },
    // district
    {
        name:'list_district',
        path:'/admin/district',
        component:ListDistrictComponent
    },
    // ward
    {
        name:'list_ward',
        path:'/admin/ward',
        component:ListWardComponent
    },
    // post
    {
        name:'list_post',
        path:'/admin/post',
        component:ListPostComponent
    },

    // USER
    // home
    {
        name:'home',
        path:'/',
        component:HomeComponent
    },
    // post
    {
        name:'detailPost',
        path:'/bai-viet/:url',
        component:DetailPostComponent
    }
]