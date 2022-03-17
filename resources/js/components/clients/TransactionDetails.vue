<template>
<div>
    <div class="row">
        <div class="col-sm-12"> 
        </div>
    </div>
    <br />
    <br />
    <input type="hidden" name="_token" :value="csrf"> 

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
            <!-- Heading -->
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="border-bottom: 1px solid #DDDDDD">{{header_1}}</h2>

                    <div class="card bg-white mb-12 shadow-sm" style="border-radius: 0.5em; border-bottom: 1px solid #BBBBBB">
                        <div class="card-body" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
                            <br /><br />
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-4">
                                    <b>Remita Payment Reference (RRR)</b>
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
                                    <b>Transaction Datetime</b>
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
                                    <b>Remita Payment Reference (RRR)</b>
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
                                    <b>Remita Payment Reference (RRR)</b>
                                </div>
                                <div class="col-sm-4">
                                    <b>{{details.rrr}}</b>
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
        <div class="col-sm-1">
        </div>
    </div> <!-- End of Row -->
</div>
</template>
<script>
import axios from 'axios';
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
            }
        }
    },
    beforeCreate(){
        const rrr = this.$route.params;
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
                })
            }
        catch(err){    
                console.log(err)
            }
    }
}
</script>
