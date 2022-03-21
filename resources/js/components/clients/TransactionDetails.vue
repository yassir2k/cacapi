<template>
<div>
    <div class="row">
        <div class="col-sm-12"> 
            <NavBar />
        </div>
    </div>
    <br />
    <br />
    <input type="hidden" name="_token" :value="csrf"> 

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-8">
            <!-- Heading -->
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="border-bottom: 1px solid #DDDDDD">{{header_1}}</h2>
                    <br />
                    <div class="card bg-white mb-12 shadow-sm" style="border-radius: 0.5em; border-bottom: 1px solid #BBBBBB">
                        <div class="card-body" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
                            <br /><br />
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-4">
                                    <b>Remita Payment Reference (RRR):</b>
                                </div>
                                <div class="col-sm-4">
                                    <b>{{details.rrr}}</b>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-4">
                                    <b>Amount:</b>
                                </div>
                                <div class="col-sm-4">
                                    <b class="text-warning">{{Number(details.amount).toLocaleString()}}</b>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-4">
                                    <b>Transaction Datetime:</b>
                                </div>
                                <div class="col-sm-4">
                                    <b>{{details.datetime}}</b>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-4">
                                    <b>Description:</b>
                                </div>
                                <div class="col-sm-4">
                                    <b>{{details.description}}</b>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-4">
                                    <b>Transaction Status:</b>
                                </div>
                                <div class="col-sm-4">
                                    <b v-if="success" class="text-success">{{details.r_message}}</b>
                                    <b v-else class="text-danger">{{details.r_message}}</b>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
                            <br />
                            <br />
                            
                        </div>
                    </div>

                </div>
            </div>
            <br />
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
    </div> <!-- End of Row -->
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
</div>
</template>
<script>
import axios from 'axios';
import NavBar from './navigations/TransactionNav.vue';
export default {
    setup() {
        
    },
    data() {
        return{
            header_1: "Transaction Details",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            details:{
                type: Object,
                default: null,
            },
            success: false
        }
    },
    beforeCreate(){
        const rrr = this.$route.params;
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
                catch(err){    
                        console.log("Get realtime Units Error: " + err);
                }

                ///
                try{
                    axios({
                    method: 'post',
                    data: rrr,
                    url: 'http://127.0.0.1:8000/api/get_transaction_details',
                    headers: { 
                        'Content-type': 'application/json; charset=utf-8', 
                    },
                    responseType: 'json'
                    })
                    .then(response =>{
                        this.details = response.data[0];
                        if(this.details.r_message == "Approved")
                            this.success = true;
                    })
                }
                catch(err){    
                        console.log("Get Transaction Details Error: " + err);
                }
            }   
        }
    },
    components:{
         NavBar
    }
}
</script>
