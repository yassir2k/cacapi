<template>
    <div>
    <div class="row">
        <div class="col-sm-12">
            <NavBar />
        </div>
    </div>
    <br />
    <br />
    <!-- Beginning of Center -->
    <!-- Heading -->
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-8">
            <h2 style="border-bottom: 1px solid #DDDDDD">{{header_1}}</h2>
            <br />
                <div class="table-wrapper justify-content-center">
                <div style="padding-bottom: 15px; background: #666666; color: #f5f5f5; padding: 20px 30px; margin: -25px -5px 10px; border-radius: 4px 4px 0 0;">
                    <div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <div class="col-xs-6">
                            <center><h2 style="margin: 5px 0 0; font-size: 30px"><b>FIRS</b></h2></center>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-condensed">
                    <thead style="background-color: #5F8575; color: #FFFFFF; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <tr>
                            <th style="width:15%">Transaction ID</th>
                            <th style="width:45%">Details</th>
                            <th width="35%">Transaction Datetime</th> 
                            <th width="5%">View More</th>
                        </tr>  
                    </thead> 
                    <tbody v-if="(users) && (users.data.length > 0)">
                        <tr v-for="(user,index) in users.data" :key="index" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; color: #34495E">
                            <td>{{ user.transaction_id }}</td>
                            <td>{{ user.details }}</td>
                            <td>{{ user.datetime}}</td>
                            <td><a href="" v-on:click.prevent="getMoreDetails(user.transaction_id)" data-bs-toggle="tooltip" title="View"><i class="fas fa-eye text-secondary"></i></a></td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td align="center" colspan="5">No record found.</td>
                        </tr>
                    </tbody>
                </table>
                <pagination align="center" :data="users" @pagination-change-page="list"></pagination>
                <br />     
                <br />
                <div id="ll" v-html="LoadView"></div>
            </div>
        </div>
        <div class="col-sm-3">
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
                                <div class="col-sm-12 text-secondary">
                                    <h4><b>Current <i class="fas fa-wallet"></i> Balance</b></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
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
    <center>
        
        <br />
    </center>
    <!-- End of Center -->

</div>
</template>

<script>
import pagination from 'laravel-vue-pagination';
import NavBar from './navigations/APICallNav.vue';
import axios from 'axios';
export default {
    data() {
        return {
                users:{
                    type: Object,
                    default: null,
                },
                header_1: "API Call Log",
                units: 0,
                LoadView: ''
            }
    },
    props: {
        records: Number,
        perPage: Number,
        length: Number
    },
    components:{
         pagination,
         NavBar
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
        this.list()
    },
    methods:{
        list(page=0){
            var dat = {
                "username": "firs"
                };
            try{
                axios.post(`http://127.0.0.1:8000/api/api_call_log?page=${page}`, dat)
                .then(({data}) =>{
                    this.users = data;
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
        getMoreDetails(ind){
            this.LoadView = '<center><i class="fa fa-spinner fa-spin fa-5x fa-fw text-secondary"></i></center>';

            try{
                axios.get('http://127.0.0.1:8000/clients/load-more-details/' + ind)
                .then(response =>{
                        this.LoadView = response.data;
                        console.log(response.data);
                })
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
        }
    },
}
</script>
<style scoped>
    .pagination{
        margin-bottom: 0;
    }
</style>