
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./jquery.countdown-2.2.0/jquery.countdown');

/**
 * 1Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
import Vue from 'vue';
import Inventory from './components/Inventory.vue';

new Vue({
    el: '#app-vue',
    components: { Inventory },

});

/*
Vue.component('example', require('./components/Example.vue'));


const app = new Vue({
    el: '#test'
});
*/

