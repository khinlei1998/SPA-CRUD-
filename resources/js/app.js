/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');



Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('product-compoent', require('./components/ProductComponent.vue').default);

Vue.component('pagination', require('laravel-vue-pagination'));

import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

window.Form=Form;

import Swal from 'sweetalert2'
window.Swal=Swal;

import VueProgressBar from 'vue-progressbar'
const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
      speed: '0.5s',
      opacity: '0.6s',
      termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
  }
  
  Vue.use(VueProgressBar, options)

window. Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })

     // Import component
    //  import Loading from 'vue-loading-overlay';
    //  window.Loading=Loading;
     // Import stylesheet
const app = new Vue({
    el: '#app',
});
