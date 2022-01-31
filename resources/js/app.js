/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//window.Vue = require('vue');
import Vue from 'vue';
import {Form} from 'vform';
import VueRouter from 'vue-router';
import dashboard from './components/Dashboard.vue';
import profile from './components/Profile.vue';
import user from './components/User.vue';
import ticket from './components/Tickets.vue';
import stade from './components/Stade.vue';
import achatTicket from './components/AchatTicket.vue';
import moment from 'moment';

Vue.use(VueRouter);
window.form = Form;
window.Fire = new Vue();
Vue.filter('capitalise', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('newDate',function(dateCreate){
    return moment().format('MMMM Do YYYY');
});

//Vue.component(HasError.name, HasError);
//Vue.component(AlertError.name, AlertError);

let routes = [
    {
        path: '/dashboard', 
        component : dashboard,
    },
    {
        path : '/profile',
        component : profile,
    },
    {
        path : '/user',
        component : user,
    },
    {
        path : '/ticket',
        component : ticket,
    },
    {
        path : '/stade',
        component : stade,
    },
    {
        path : '/achatTicket',
        component : achatTicket,
    },
]

const router = new VueRouter({
    mode: 'history',
    routes : routes
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
