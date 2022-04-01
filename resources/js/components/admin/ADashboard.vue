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
        <div class="col-sm-3">
            <h2 style="border-bottom: 1px solid #DDDDDD">Today's Statistics</h2>
        </div>
        <div class="col-sm-3"> 
        </div>
        <div class="col-sm-3"> <!-- Handles User Profile Details and current units -->
        </div>
        <div class="col-sm-3">
        </div>
    </div>

    <!-- *********************************************************************************************************** 
                                                        Second Row
    *************************************************************************************************************-->
    <div class="row">
         <div class="col-xl-3 col-sm-6 col-12"> 
            <div class="card border border-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between" style="font-family: Montserrat">
                        <div class="align-self-center">
                            <i class="fas fa-money-bill-alt fa-3x" style="color: #00B5B8"></i>
                        </div>
                        <div align="right">
                            <h3 style="color: #00B5B8">278,230</h3>
                            <span>Income (&#8358;)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12"> 
            <div class="card border border-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between" style="font-family: Montserrat">
                        <div class="align-self-center">
                            <i class="fas fa-file-code fa-3x" style="color: #00B5B8"></i>
                        </div>
                        <div align="right">
                            <h3 style="color: #00B5B8">278,230</h3>
                            <span>Income (&#8358;)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12"> 
            <div class="card border border-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between" style="font-family: Montserrat">
                        <div class="align-self-center">
                            <i class="fas fa-users fa-3x" style="color: #00B5B8"></i>
                        </div>
                        <div align="right">
                            <h3 style="color: #00B5B8">278,230</h3>
                            <span>Income (&#8358;)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12"> 
            <div class="card border border-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between" style="font-family: Montserrat">
                        <div class="align-self-center">
                            <i class="fas fa-building fa-3x" style="color: #00B5B8"></i>
                        </div>
                        <div align="right">
                            <h3 style="color: #00B5B8">278,230</h3>
                            <span>Income (&#8358;)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- *********************************************************************************************************** 
                                                        Third Row
    *************************************************************************************************************-->
    <div class="row">
        <div class="col-sm-3">
            
        </div>
        <div class="col-sm-3"> 
        </div>
        <div class="col-sm-3"> <!-- Handles User Profile Details and current units -->
        </div>
        <div class="col-sm-3">
        </div>
    </div>

    <br />
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
        //Get total API calls today
        try{
            axios.post("http://127.0.0.1:8000/api/get_total_api_calls_today", postData) 
            .then(response =>{
                this.total_today = '<b style="color: #50c878">'+ Number(response.data).toLocaleString() +'</b>';
            })
        }
        catch{

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
