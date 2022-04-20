<template>
<div>
    <div class="row">
        <div class="col-sm-12">
            <NavBar /> 
        </div>
    </div>
    <br />
    <!-- *********************************************************************************************************** 
                                                        First Row
    *************************************************************************************************************-->
    <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-1"> 
        </div>
        <div class="col-sm-2" align="center"> <!-- Handles User Profile Details and current units -->
            <h3 style="border-bottom: 1px solid #DDDDDD; color: #666666">Today's Statistics</h3>
        </div>
        <div class="col-sm-1">
        </div>
        <div class="col-sm-4">
        </div>
    </div>
    <br />
    <!-- *********************************************************************************************************** 
                                                        Second Row
    *************************************************************************************************************-->
    <div class="row">
        <div class="col-xl-1">
        </div>
         <div class="col-xl-5"> 
            <div class="card border border-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between" >
                        <div class="align-self-center">
                            <i class="fas fa-money-bill-alt fa-3x" style="color: #97D5B5"></i>
                        </div>
                        <div align="right">
                            <h3 style="color: #97D5B5"><span v-html="today_income"></span></h3>
                            <span>Income (&#8358;)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5"> 
            <div class="card border border-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between" >
                        <div class="align-self-center">
                            <i class="fas fa-file-code fa-3x" style="color: #87AAD0"></i>
                        </div>
                        <div align="right">
                            <h3 style="color: #87AAD0"><span v-html="today_api_calls_made"></span></h3>
                            <span>API Calls Made</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-1">
        </div>
    </div>
    <br /><br />
    <!-- *********************************************************************************************************** 
                                                        Third Row
    *************************************************************************************************************-->
    <div class="row">
        <div class="col-xl-1">
        </div>
        <div class="col-xl-5 col-sm-6 col-12"> 
            <div class="card border border-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between" >
                        <div class="align-self-center">
                            <i class="fas fa-users fa-3x" style="color: #ECE3A1"></i>
                        </div>
                        <div align="right">
                            <h3 style="color: #ECE3A1"><span v-html="today_registered_users"></span></h3>
                            <span>Registered Users (Business)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-sm-6 col-12"> 
            <div class="card border border-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between" >
                        <div class="align-self-center">
                            <font-awesome-icon icon="fa-solid fa-people-group" size="3x" style="color: #FF7F7F" />
                        </div>
                        <div align="right">
                            <h3 style="color: #FF7F7F"><span v-html="today_registered_users_govt"></span></h3>
                            <span>Registered Users (Government)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-1">
        </div>
    </div>
    <br /><br /><br />
    <!-- *********************************************************************************************************** 
                                                        Fourth Row
    *************************************************************************************************************-->
    <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-1"> 
        </div>
        <div class="col-sm-2" align="center"> <!-- Handles User Profile Details and current units -->
        <h3 style="border-bottom: 1px solid #DDDDDD; color: #666666">Cummulative Statistics</h3>
        </div>
        <div class="col-sm-1">
        </div>
        <div class="col-sm-4">
        </div>
    </div>
    <br />
    <!-- *********************************************************************************************************** 
                                                        Fifth Row
    *************************************************************************************************************-->
    <div class="row">
        <div class="col-xl-1">
        </div>
         <div class="col-xl-5 col-sm-6 col-12"> 
            <div class="card border border-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between" >
                        <div class="align-self-center">
                            <i class="fas fa-money-bill-alt fa-3x" style="color: #79C27B"></i>
                        </div>
                        <div align="right">
                            <h3 style="color: #79C27B"><span v-html="cummulative_income"></span></h3>
                            <span>Income (&#8358;)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-sm-6 col-12"> 
            <div class="card border border-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between" >
                        <div class="align-self-center">
                            <i class="fas fa-file-code fa-3x" style="color: #5D7DA3"></i>
                        </div>
                        <div align="right">
                            <h3 style="color: #5D7DA3"><span v-html="cummulative_api_calls_made"></span></h3>
                            <span>API Calls Made</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-1">
        </div>
    </div><br /><br />
    <!-- *********************************************************************************************************** 
                                                        Sixth Row
    *************************************************************************************************************-->
    <div class="row">
        <div class="col-xl-1">
        </div>
        <div class="col-xl-5 col-sm-6 col-12"> 
            <div class="card border border-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between" >
                        <div class="align-self-center">
                            <i class="fas fa-users fa-3x" style="color: #F5E051"></i>
                        </div>
                        <div align="right">
                            <h3 style="color: #F5E051"><span v-html="cummulative_registered_users"></span></h3>
                            <span>Registered Users (Business)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-sm-6 col-12"> 
            <div class="card border border-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="align-self-center">
                            <font-awesome-icon icon="fa-solid fa-people-group" size="3x" style="color: #FF0000" />
                        </div>
                        <div align="right">
                            <h3 style="color: #FF0000"><span v-html="cummulative_registered_users_govt"></span></h3>
                            <span>Registered Users (Government)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-1">
        </div>
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br />
</div>
</template>
<script>

import axios from 'axios';
import NavBar from './navigations/DashboardNav.vue';
export default {
    setup() {
        
    },
    components:{
        NavBar
    },
    data(){
        return{
            today_income: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            today_api_calls_made: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            today_registered_users: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            today_registered_users_govt: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            cummulative_income: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            cummulative_api_calls_made: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            cummulative_registered_users: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            cummulative_registered_users_govt: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            units: null
        }
    },
    beforeCreate: function () {
        if (!this.$session.exists()) {
            this.$router.push('/');
        }
        else{
            if(this.$session.get("role") != "Admin"){
                alert("You do not have privilege to visit this page.");
                this.$session.destroy();
                this.$router.push('/');
            }
        }
    },
    created(){
        
        var postData = {
            "username": this.$session.get("username"),
        }
        var d = new Date();
            var sessionId = d.getTime();
            var apiHash = CryptoJS.SHA512(sessionId + this.$session.get("username") + this.$session.get("token") );

        //Get today's income
        try{
            axios({
            method: 'post',
            url: 'http://127.0.0.1:8000/api/get_todays_income',
            data: postData,
            headers: { 
                'Content-type': 'application/json; charset=utf-8', 
                'Authorization': 'Key=' + sessionId + ',Hash=' + apiHash + ',Token=' + this.$session.get("token"),
            },
            responseType: 'json'
            })
            .then(response=>{
                this.today_income = '<b style="color: #97D5B5">'+ Number(response.data).toLocaleString() +'</b>';
            });
        }
        catch(err){    
            if (err.response) {
            // client received an error response (5xx, 4xx)
            console.log("Server Error:", err)
            } else if (err.request) {
            // client never received a response, or request never left
            console.log("Network Error:", err)
            } else {
            console.log("Client Error:", err)
            }
        }

        //Get today's total API calls made
        try{
            axios({
            method: 'post',
            url: 'http://127.0.0.1:8000/api/get_todays_api_calls_made',
            data: postData,
            headers: { 
                'Content-type': 'application/json; charset=utf-8', 
                'Authorization': 'Key=' + sessionId + ',Hash=' + apiHash + ',Token=' + this.$session.get("token"),
            },
            responseType: 'json'
            })
            .then(response=>{
                this.today_api_calls_made = '<b style="color: #87AAD0">'+ Number(response.data).toLocaleString() +'</b>';
            });
        }
        catch(err){    
            if (err.response) {
            // client received an error response (5xx, 4xx)
            console.log("Server Error:", err)
            } else if (err.request) {
            // client never received a response, or request never left
            console.log("Network Error:", err)
            } else {
            console.log("Client Error:", err)
            }
        }

        //Gets today's registered users business
        try{
            axios({
            method: 'post',
            url: 'http://127.0.0.1:8000/api/get_todays_registered_users_business',
            data: postData,
            headers: { 
                'Content-type': 'application/json; charset=utf-8', 
                'Authorization': 'Key=' + sessionId + ',Hash=' + apiHash + ',Token=' + this.$session.get("token"),
            },
            responseType: 'json'
            })
            .then(response=>{
                this.today_registered_users = '<b style="color: #ECE3A1">'+ Number(response.data).toLocaleString() +'</b>';
            });
        }
        catch(err){    
            if (err.response) {
            // client received an error response (5xx, 4xx)
            console.log("Server Error:", err)
            } else if (err.request) {
            // client never received a response, or request never left
            console.log("Network Error:", err)
            } else {
            console.log("Client Error:", err)
            }
        }

        //Gets today's registered users government
        try{
            axios({
            method: 'post',
            url: 'http://127.0.0.1:8000/api/get_todays_registered_users_government',
            data: postData,
            headers: { 
                'Content-type': 'application/json; charset=utf-8', 
                'Authorization': 'Key=' + sessionId + ',Hash=' + apiHash + ',Token=' + this.$session.get("token"),
            },
            responseType: 'json'
            })
            .then(response=>{
                this.today_registered_users_govt = '<b style="color: #FF7F7F">'+ Number(response.data).toLocaleString() +'</b>';
            });
        }
        catch(err){    
            if (err.response) {
            // client received an error response (5xx, 4xx)
            console.log("Server Error:", err)
            } else if (err.request) {
            // client never received a response, or request never left
            console.log("Network Error:", err)
            } else {
            console.log("Client Error:", err)
            }
        }


        /*-------------------------------------------------- Fetching Cummulative Stats-------------------------------------------------------------------- */
        //Get cummulative income
        try{
            axios({
            method: 'post',
            url: 'http://127.0.0.1:8000/api/get_cummulative_income',
            data: postData,
            headers: { 
                'Content-type': 'application/json; charset=utf-8', 
                'Authorization': 'Key=' + sessionId + ',Hash=' + apiHash + ',Token=' + this.$session.get("token"),
            },
            responseType: 'json'
            })
            .then(response=>{
                this.cummulative_income = '<b style="color: #79C27B">'+ Number(response.data).toLocaleString() +'</b>';
            });
        }
        catch(err){    
            if (err.response) {
            // client received an error response (5xx, 4xx)
            console.log("Server Error:", err)
            } else if (err.request) {
            // client never received a response, or request never left
            console.log("Network Error:", err)
            } else {
            console.log("Client Error:", err)
            }
        }

        //Get today's total API calls made
        try{
            axios({
            method: 'post',
            url: 'http://127.0.0.1:8000/api/get_cummulative_api_calls_made',
            data: postData,
            headers: { 
                'Content-type': 'application/json; charset=utf-8', 
                'Authorization': 'Key=' + sessionId + ',Hash=' + apiHash + ',Token=' + this.$session.get("token"),
            },
            responseType: 'json'
            })
            .then(response=>{
                this.cummulative_api_calls_made = '<b style="color: #5D7DA3">'+ Number(response.data).toLocaleString() +'</b>';
            });
        }
        catch(err){    
            if (err.response) {
            // client received an error response (5xx, 4xx)
            console.log("Server Error:", err)
            } else if (err.request) {
            // client never received a response, or request never left
            console.log("Network Error:", err)
            } else {
            console.log("Client Error:", err)
            }
        }

        //Gets today's registered users business
        try{
            axios({
            method: 'post',
            url: 'http://127.0.0.1:8000/api/get_cummulative_registered_users_business',
            data: postData,
            headers: { 
                'Content-type': 'application/json; charset=utf-8', 
                'Authorization': 'Key=' + sessionId + ',Hash=' + apiHash + ',Token=' + this.$session.get("token"),
            },
            responseType: 'json'
            })
            .then(response=>{
                this.cummulative_registered_users = '<b style="color: #F5E051">'+ Number(response.data).toLocaleString() +'</b>';
            });
        }
        catch(err){    
            if (err.response) {
            // client received an error response (5xx, 4xx)
            console.log("Server Error:", err)
            } else if (err.request) {
            // client never received a response, or request never left
            console.log("Network Error:", err)
            } else {
            console.log("Client Error:", err)
            }
        }

        //Gets today's registered users government
        try{
            axios({
            method: 'post',
            url: 'http://127.0.0.1:8000/api/get_cummulative_registered_users_government',
            data: postData,
            headers: { 
                'Content-type': 'application/json; charset=utf-8', 
                'Authorization': 'Key=' + sessionId + ',Hash=' + apiHash + ',Token=' + this.$session.get("token"),
            },
            responseType: 'json'
            })
            .then(response=>{
                this.cummulative_registered_users_govt = '<b style="color: #FF0000">'+ Number(response.data).toLocaleString() +'</b>';
            });
        }
        catch(err){    
            if (err.response) {
            // client received an error response (5xx, 4xx)
            console.log("Server Error:", err)
            } else if (err.request) {
            // client never received a response, or request never left
            console.log("Network Error:", err)
            } else {
            console.log("Client Error:", err)
            }
        }
        
  },
  methods: {
    logout: function () {
      this.$session.destroy();
      this.$router.push('/');
    },

  }
}
</script>
