// app.js

require('./bootstrap');
require('metismenu');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import NavbarComponent from './components/backend/NavbarComponent.vue';
import MenuComponent from './components/backend/MenuComponent.vue';
import NavbarFeComponent from './components/frontend/NavbarFeComponent.vue';
import FooterComponent from './components/frontend/FooterComponent.vue';
import ModalRegisterComponent from './components/frontend/modal/ModalRegisterComponent.vue';
import ModalLoginComponent from './components/frontend/modal/ModalLoginComponent.vue';
import {routes} from './router.js';
import VueCookies from 'vue-cookies';

Vue.component('navbarComponent',NavbarComponent);
Vue.component('menuComponent', MenuComponent);
Vue.component('navbarHome',NavbarFeComponent);
Vue.component('footerHome', FooterComponent);
Vue.component('registerComponent', ModalRegisterComponent);
Vue.component('loginComponent', ModalLoginComponent);

Vue.use(VueRouter);

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router })).$mount('#app');
