<template>
<div>
    <div class="row">
        <div class="col-sm-12">
            <NavBar /> 
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-8">   
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4" align="center"> <!-- Handles User Profile Details and current units -->
                    <h3 style="border-bottom: 1px solid #DDDDDD; color: #666666">Today's Statistics</h3>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
            <br>
            <div class="row"><!--Beginning of today's data -->
                <div class="col-sm-4" align="center">
                    <div class="card bg-white mb-4 shadow-sm" style="width: 17rem; height:100%; border-radius: 0.5em; border-bottom: 4px solid #50C878">
                        <a href="/admin/todays-records" style="text-decoration: none; color:inherit">
                            <div class="card-body"><br />
                                <h1 class="card-title"><span v-html="total_today"></span></h1>
                                <hr class="separator">
                                <p class="card-text"><b class="font-pref14">TOTAL API CALLS</b></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4" align="center">
                    <div class="card bg-white mb-4 shadow-sm" style="width: 17rem; height:100%; border-radius: 0.5em; border-bottom: 4px solid #E4D00A">
                        <a href="/admin/todays-records" style="text-decoration: none; color:inherit">
                            <div class="card-body"><br />
                                <h1 class="card-title" v-if="this.$session.get('clientType') == 'Government'"><b style="color: #E4D00A">&#8734;</b></h1>
                                <h1 class="card-title" v-else><span v-html="total_units_expended_today"></span></h1>
                                <hr class="separator">
                                <p class="card-text"><b class="font-pref14">TOTAL UNITS EXPENDED</b></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4" align="center">
                    <div class="card bg-white mb-4 shadow-sm" style="width: 17rem; height:100%; border-radius: 0.5em; border-bottom: 4px solid #DC143C">
                        <a href="/admin/todays-records" style="text-decoration: none; color:inherit">
                            <div class="card-body"><br />
                                <h1 class="card-title" v-if="this.$session.get('clientType') == 'Government'"><b style="color: #DC143C">&#8734;</b></h1>
                                <h1 class="card-title" v-else><span v-html="total_units_purchased"></span></h1>
                                <hr class="separator">
                                <p class="card-text"><b class="font-pref14">TOTAL UNITS PURCHASED</b></p>
                            </div>
                        </a>
                    </div>
                </div>
        	</div><!--End of today's data-->
            <br />
            <br />
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4" align="center"> <!-- Handles User Profile Details and current units -->
                    <h3 style="border-bottom: 1px solid #DDDDDD; color: #666666">Cummulative Statistics</h3>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
            <br>

            <div class="row"><!--Beginning of absolute data -->
                <div class="col-sm-4" align="center">
                    <div class="card bg-white mb-4 shadow-sm" style="width: 17rem; height:100%; border-radius: 0.5em; border-bottom: 4px solid #93C572">
                        <a href="/admin/todays-records" style="text-decoration: none; color:inherit">
                            <div class="card-body"><br />
                                <h1 class="card-title"><span v-html="total_cummulative_api_calls"></span></h1>
                                <hr class="separator">
                                <p class="card-text"><b class="font-pref14">TOTAL API CALLS</b></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4" align="center">
                    <div class="card bg-white mb-4 shadow-sm" style="width: 17rem; height:100%; border-radius: 0.5em; border-bottom: 4px solid #E39802">
                        <a href="/admin/absolute-records-accredited-users" style="text-decoration: none; color:inherit">
                            <div class="card-body"><br />
                                <h1 class="card-title" v-if="this.$session.get('clientType') == 'Government'"><b style="color: #E39802">&#8734;</b></h1>
                                <h1 class="card-title" v-else><span v-html="total_cummulative_units_expended"></span></h1>
                                <hr class="separator">
                                <p class="card-text"><b class="font-pref14">TOTAL AMOUNT EXPENDED</b></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4" align="center">
                    <div class="card bg-white mb-4 shadow-sm" style="width: 17rem; height:100%; border-radius: 0.5em; border-bottom: 4px solid #B60A1C">
                        <a href="/admin/absolute-records-accredited-users" style="text-decoration: none; color:inherit">
                            <div class="card-body"><br />
                                <h1 class="card-title" v-if="this.$session.get('clientType') == 'Government'"><b style="color: #B60A1C">&#8734;</b></h1>
                                <h1 class="card-title" v-else><span v-html="total_cummulative_units_purchased"></span></h1>
                                <hr class="separator">
                                <p class="card-text"><b class="font-pref14">TOTAL UNITS PURCHASED</b></p>
                            </div>
                        </a>
                    </div>
                </div>
        	</div><!--End of today's data-->

        </div>
        <div class="col-sm-3"> <!-- Handles User Profile Details and current units -->
            <div class="row align-bottom">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-3">
                            <br />
                            <i class="fas fa-user-circle fa-5x justify-content-center" style="color: #DDDDDD"></i>
                            <br />
                            <br />
                        </div>
                        <div align="left" class="col-sm-9" style="border-left: 1px ridge #EEEEEE">
                            <br />
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4><b>Organization</b></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 style="color: #778899"><b>{{this.$session.get('organization')}}</b></h5>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4><b>Current Unit Balance</b></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" v-if="this.$session.get('clientType') == 'Government'">
                                    <h3 class="text-danger"><b>&#8734;</b></h3>
                                </div>
                                <div class="col-sm-12" v-else>
                                    <h5 class="text-danger"><b>&#8358; &nbsp; {{ Number(this.units).toLocaleString() }}</b></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
</div>
</template>
<script>

import NavBar from './navigations/DashboardNav.vue';
import axios from 'axios';
export default {
    setup() {
        
    },
    components:{
        NavBar
    },
    data(){
        return{
            total_today: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            total_units_expended_today: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            total_units_purchased: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            total_cummulative_api_calls: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            total_cummulative_units_expended: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            total_cummulative_units_purchased: '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>',
            units: null
        }
    },
    beforeCreate: function () {
        if (!this.$session.exists()) {
        this.$router.push('/');
        }
        else{
            if(this.$session.get("role") != "Accessor"){
                alert("You do not have privilege to visit this page.");
                this.$session.destroy();
                this.$router.push('/');
            }
            else{
                //Get Realtime Units
                var postData = {
                    "username": this.$session.get("username"),
                }
                try{
                    axios.post("http://127.0.0.1:8000/api/get_realtime_units", postData) 
                    .then(response =>{
                        this.units = response.data["units"];
                    })
                }
                catch{

                }
            }
        }
    },
    created(){
        
        var postData = {
            "username": this.$session.get("username"),
        }
        console.log(this.$session.get("token"));
        var d = new Date();
        var sessionId = d.getTime();
        var apiHash = CryptoJS.SHA512(sessionId + this.$session.get("username") + this.$session.get("token") );
        //Get total API calls today
        try{
            axios({
            method: 'post',
            url: 'http://127.0.0.1:8000/api/get_total_api_calls_today',
            data: postData,
            headers: { 
                'Content-type': 'application/json; charset=utf-8', 
                'Authorization': 'Key=' + sessionId + ',Hash=' + apiHash + ',Token=' + this.$session.get("token"),
            },
            responseType: 'json'
            })
            .then(response=>{
                this.total_today = '<b style="color: #50c878">'+ Number(response.data).toLocaleString() +'</b>';
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

        //Gets total amount spent today
        try{
            axios.post("http://127.0.0.1:8000/api/get_total_units_expended_today", postData) 
            .then(response =>{
                this.total_units_expended_today = '<b style="color: #E4D00A">'+ Number(response.data).toLocaleString() +'</b>';
            })
        }
        catch{

        }

        //Gets total units purchased today
        try{
            axios.post("http://127.0.0.1:8000/api/get_total_units_purchased_today", postData) 
            .then(response =>{
                this.total_units_purchased = '<b style="color: #DC143C">'+ Number(response.data).toLocaleString() +'</b>';
            })
        }
        catch{

        }

        //Gets total cummulative API call
        try{
            axios.post("http://127.0.0.1:8000/api/get_total_cummulative_api_calls", postData) 
            .then(response =>{
                this.total_cummulative_api_calls = '<b style="color: #93C572">'+ Number(response.data).toLocaleString() +'</b>';
            })
        }
        catch{

        }

        //Gets total cummulative units expended
        try{
            axios.post("http://127.0.0.1:8000/api/get_total_cummulative_units_expended", postData) 
            .then(response =>{
                this.total_cummulative_units_expended = '<b style="color: #E39802">'+ Number(response.data).toLocaleString() +'</b>';
            })
        }
        catch{

        }


        //Gets total cummulative units purchased
        try{
            axios.post("http://127.0.0.1:8000/api/get_total_cummulative_units_purchased", postData) 
            .then(response =>{
                this.total_cummulative_units_purchased = '<b style="color: #B60A1C">'+ Number(response.data).toLocaleString() +'</b>';
            })
        }
        catch{

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
