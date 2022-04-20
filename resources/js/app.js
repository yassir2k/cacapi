import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './components/App.vue';
import routes from './components/router';
import VueSession from 'vue-session';
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
/* add icons to the library */
library.add(fas, far)

/* add font awesome icon component */
Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.use(VueRouter);
Vue.use(VueSession);



Vue.component('app', require('./components/App.vue').default);


 const app = new Vue({
    el: '#app',
    router: routes,
    render: h => h(App)
  })

