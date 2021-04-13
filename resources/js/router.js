import DashBoardComponent from './components/backend/dashboard/DashBoardComponent.vue';
import LoginComponent from './components/backend/login/LoginComponent.vue';
// categories
import ListCategoreisComponent from './components/backend/categories/ListCategoreisComponent.vue';
import EditCategoreisComponent from './components/backend/categories/EditCategoreisComponent.vue';
export const routes = [
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
        component:ListCategoreisComponent
    },
    {
        name:'edit_categories',
        path:'/admin/categories/edit/:id',
        component:EditCategoreisComponent
    }
]