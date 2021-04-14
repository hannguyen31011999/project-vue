// app.js

require('./bootstrap');
require('metismenu');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import NavbarComponent from './components/backend/NavbarComponent.vue';
import MenuComponent from './components/backend/MenuComponent.vue';

import {routes} from './router.js';

Vue.component('navbarComponent',NavbarComponent);
Vue.component('menuComponent', MenuComponent);

Vue.use(VueRouter);

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router })).$mount('#app');
