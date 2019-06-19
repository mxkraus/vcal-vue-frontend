import Vue from 'vue';
import Framework7 from 'framework7/framework7.esm.bundle';
import Framework7Vue from 'framework7-vue';
import BootstrapVue from 'bootstrap-vue';
import VueResoure from 'vue-resource';
import App from './App.vue';


Vue.config.productionTip = true;

Vue.use(VueResoure);
Vue.use(BootstrapVue);
Framework7.use(Framework7Vue);

import 'bootstrap/dist/css/bootstrap.css';
import 'framework7/css/framework7.bundle.min.css'; // Überschreibt Bootstrap Styles

new Vue({
    el: '#app',
    render: h => h(App),
});
