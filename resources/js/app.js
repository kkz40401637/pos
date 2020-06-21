/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('vue-multiselect/dist/vue-multiselect.min.css');
import { Form, HasError, AlertError } from  'vform';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

window.Vue = require('vue');
window.Form = Form;

window.Fire = new Vue();

import VueSweetalert2 from 'vue-sweetalert2';
import Vue from 'vue';

Vue.use(VueSweetalert2);

import Multiselect from 'vue-multiselect';
Vue.component('multiselect', Multiselect);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('customer', require('./components/Customer.vue').default);

Vue.component('food_category', require('./components/food/Category.vue').default);
Vue.component('food_product', require('./components/food/Product.vue').default);

Vue.component('home_pos', require('./components/Home.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
