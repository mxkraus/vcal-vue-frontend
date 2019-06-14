import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import VueRouter from 'vue-router';
import VueResoure from 'vue-resource';
import App from './App.vue';
import Events from './components/Events';
import Home from './components/Home';

Vue.config.productionTip = true;

Vue.use(VueResoure);
Vue.use(VueRouter);
Vue.use(BootstrapVue);


import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


const routes = [
  { path: '/event-list', component: Events },
  { path: '/', component: Home },
]

const router = new VueRouter({
  routes // short for `routes: routes`
})

new Vue({
    el: '#app',
    router,
    render: h => h(App),
});
