import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './components/App.vue';
import routes from './components/router';
import VueSession from 'vue-session';

Vue.use(VueRouter);
Vue.use(VueSession);



Vue.component('app', require('./components/App.vue').default);


 const app = new Vue({
    el: '#app',
    router: routes,
    render: h => h(App)
  })

