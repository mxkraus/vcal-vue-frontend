import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';

import VueResoure from 'vue-resource';

import Framework7 from 'framework7/framework7.esm.bundle';
import Framework7Vue from 'framework7-vue';

import App from './App.vue';

Vue.use(VueResoure);
Vue.use(BootstrapVue);
Framework7.use(Framework7Vue);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'framework7/css/framework7.bundle.min.css'; // Überschreibt Bootstrap Styles

new Vue({
    el: '#app',
    render: h => h(App),
});
