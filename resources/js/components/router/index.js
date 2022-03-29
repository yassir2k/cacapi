import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from "../clients/Dashboard.vue";
import Buycredit from "../clients/Buycredit.vue";
import Transactions from "../clients/Transactions.vue";
import TransactionDetails from "../clients/TransactionDetails.vue";
import Documentation from "../clients/Documentation.vue";
import APIHistory from "../clients/APICallLog.vue";
import EditUserProfile from "../clients/EditUserProfile.vue";
import ChangeUserPassword from "../clients/ChangeUserPassword.vue";
import VerifyRegistration from "../clients/VerifyRegistration.vue";
import Login from "../Login.vue";
import Signup from "../Signup.vue";
import PasswordRecovery from "../clients/PasswordRecovery.vue"
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
        },
        {
          path: "/transaction-history/transaction-details/:rrr",
          name: "TransactionDetails",
          component: TransactionDetails, 
        },
        {
          path: "/api-documentation",
          name: "Documentation",
          component: Documentation, 
        }
        ,
        {
          path: "/api-call-log",
          name: "APIHistory",
          component: APIHistory, 
        },
        {
          path: "/edit-user-profile",
          name: "EditUserProfile",
          component: EditUserProfile, 
        },
        {
          path: "/change-user-password",
          name: "ChangeUserPassword",
          component: ChangeUserPassword, 
        },
        {
          path: "/signup",
          name: "Signup",
          component: Signup, 
        },
        {
          path: "/registration/verify-registration/:token",
          name: "VerifyRegistration",
          component: VerifyRegistration, 
        },
        {
          path: "/password-recovery/",
          name: "PasswordRecovery",
          component: PasswordRecovery, 
        }
    ];
    
export default new VueRouter({
  routes,
  mode: 'history'
})
  