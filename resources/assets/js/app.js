
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('products-index', require('./components/products-vue/index.vue'));
Vue.component('inventory', require('./components/products-vue/inventory.vue'));
Vue.component('production', require('./components/products-vue/production.vue'));

Vue.component('clients-index', require('./components/client-vue/index.vue'));



// import VueGoodTablePlugin from 'vue-good-table';

// // import the styles 
// import 'vue-good-table/dist/vue-good-table.css';

// Vue.use(VueGoodTablePlugin); 


// import VueFormWizard from 'vue-form-wizard'
// import 'vue-form-wizard/dist/vue-form-wizard.min.css'
// Vue.use(VueFormWizard)

const app = new Vue({
    el: '#app-content'
});
