import DashBoardComponent from './components/backend/dashboard/DashBoardComponent.vue';
import LoginComponent from './components/backend/login/LoginComponent.vue';
export const routes = [
    // BACKEND
    {
        name: 'admin_login',
        path: '/admin/login',
        component: LoginComponent
    },
    {
        name: 'dashboard',
        path: '/admin/dashboard',
        component: DashBoardComponent
    }
]