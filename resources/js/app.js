// app.js

require('./bootstrap');
require('metismenu');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import NavbarComponent from './components/backend/NavbarComponent.vue';
import MenuComponent from './components/backend/MenuComponent.vue';

// categories
import Add from './components/backend/categories/Add.vue';
import {routes} from './router.js';

Vue.component('navbarComponent',NavbarComponent);
Vue.component('menuComponent', MenuComponent);

// modal categories
Vue.component('createCategories',Add);


Vue.use(VueRouter);

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router })).$mount('#app');