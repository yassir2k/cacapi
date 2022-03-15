import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from "../clients/Dashboard.vue";
import Buycredit from "../clients/Buycredit.vue";
import Transactions from "../clients/Transactions.vue";
import Login from "../Login";
Vue.use(VueRouter);
    const routes = [
        {
          path: "/client-dashboard",
          name: "Dashboard",
          component: Dashboard,
        },
        {
          path: "/",
          name: "Login",
          component: Login,
        },
        {
          path: "/buy-credit",
          name: "Buycredit",
          component: Buycredit, 
        },
        {
          path: "/transaction-history",
          name: "Transactions",
          component: Transactions, 
        }
    ];
    
    export default new VueRouter({
      routes,
      mode: 'history'
  })
  