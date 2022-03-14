import Vue from 'vue';
import VueRouter from 'vue-router'
import App from './components/App.vue'
import routes from './components/router';

Vue.use(VueRouter);



Vue.component('App', require('./components/App.vue').default);
Vue.component('Login', require('./components/Login.vue').default);
Vue.component('Dashboard', require('./components/clients/Dashboard.vue').default);
//Vue.component('Buycredit', require('./components/clients/Buycredit.vue').default);

 const app = new Vue({
    el: '#app',
    router: routes,
    render: h => h(App)
  })

