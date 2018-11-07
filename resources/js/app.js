
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('AppHome', require('./components/AppHome.vue'));
import Vue from 'vue'
import Vuetify from 'vuetify'
import router from './Router/router.js'
import User from './Helpers/User.js';
import Exception from './Helpers/Exception.js';
import AppStorage from './Helpers/AppStorage.js';
import VueSimplemde from 'vue-simplemde'
import 'simplemde/dist/simplemde.min.css'
import md from 'marked'
Vue.use(Vuetify);
Vue.use(VueSimplemde);
window.md = md;
window.User = User;
window.Exception = Exception;
window.EventBus = new Vue();

window.AppStorage = AppStorage;
const app = new Vue({
    el: '#app',
    router
});
