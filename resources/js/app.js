// app.js

require('./bootstrap');
require('metismenu');

window.Vue = require('vue');

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import {routes} from './router.js';

const router = new VueRouter({ mode: 'history', routes: routes});

const app = new Vue(Vue.util.extend({ router })).$mount('#app');