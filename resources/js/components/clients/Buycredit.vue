<template>
<div>
    <div class="row">
        <div class="col-sm-12"> 
            <NavBar /> 
        </div>
    </div>
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
                </div>
            </div>
            <br />

            <!-- Radio Buttons -->
            <div class="row">
                <div class="col-sm-4">
                    <div class="chiller_cb form-check-inline align-items-center"><br />
                        <input id="five" type="radio" required v-model="amount" name="amount" value="5000" :disabled="disableradio">
                        <label for="five">Five Thousand Naira (&#8358; 5,000)</label>
                        <span></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="chiller_cb form-check-inline align-items-center"><br />
                        <input id="ten" type="radio" required v-model="amount" name="amount"  value="10000" :disabled="disableradio">
                        <label for="ten">Ten Thousand Naira (&#8358; 10,000)</label>
                        <span></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="chiller_cb form-check-inline align-items-center"><br />
                        <input id="fifteen" type="radio" required v-model="amount" name="amount"  value="15000" :disabled="disableradio">
                        <label for="fifteen">Fifteen Thousand Naira (&#8358; 15,000)</label>
                        <span></span>
                    </div>
                </div>
            </div>

            <br /><br />

            <!-- Radio Buttons -->
            <div class="row">
                <div class="col-sm-4">
                    <div class="chiller_cb form-check-inline align-items-center"><br />
                        <input id="twenty" type="radio" required v-model="amount" name="amount"  value="20000" :disabled="disableradio">
                        <label for="twenty">Twenty Thousand Naira (&#8358; 20,000)</label>
                        <span></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="chiller_cb form-check-inline align-items-center"><br />
                        <input id="fifty" type="radio" required v-model="amount" name="amount"  value="50000" :disabled="disableradio">
                        <label for="fifty">Fifty Thousand Naira (&#8358; 50,000)</label>
                        <span></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="chiller_cb form-check-inline align-items-center"><br />
                        <input id="hundred" type="radio" required v-model="amount"  name="amount" value="100000" :disabled="disableradio">
                        <label for="hundred">Hundred Thousand Naira (&#8358; 100,000)</label>
                        <span></span>
                    </div>
                </div>
            </div>

            <br /><br />

            <!-- Radio Button -->
            <div class="row">
                <div class="col-sm-4">
                    <div class="chiller_cb form-check-inline align-items-center"><br />
                        <input id="one_fifty" type="radio" required v-model="amount" name="amount" value="150000" :disabled="disableradio">
                        <label for="one_fifty">One Hundred Fifty Thousand Naira (&#8358; 150,000)</label>
                        <span></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="chiller_cb form-check-inline align-items-center"><br />
                        <input id="two_hundred" type="radio" required v-model="amount" name="amount"  value="200000" :disabled="disableradio">
                        <label for="two_hundred">Two Hundred Thousand Naira (&#8358; 200,000)</label>
                        <span></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="chiller_cb form-check-inline align-items-center"><br />
                        <input id="two_hundred_fifty" type="radio" required v-model="amount" name="amount"  value="250000" :disabled="disableradio">
                        <label for="two_hundred_fifty">Two Hundred Fifty Thousand Naira (&#8358; 250,000)</label>
                        <span></span>
                    </div>
                </div>
            </div>


            <br /><br />


            <!-- Radio Buttons -->
            <div class="row">
                <div class="col-sm-4">
                    <div class="chiller_cb form-check-inline align-items-center"><br />
                        <input id="three_hundred" type="radio" required v-model="amount" name="amount"  value="300000" :disabled="disableradio">
                        <label for="three_hundred">Three Hundred Thousand Naira (&#8358; 300,000)</label>
                        <span></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="chiller_cb form-check-inline align-items-center"><br />
                        <input id="five_hundred" type="radio" required v-model="amount" name="amount"  value="500000" :disabled="disableradio">
                        <label for="five_hundred">Five Hundred Thousand Naira (&#8358; 500,000)</label>
                        <span></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="chiller_cb form-check-inline align-items-center"><br />
                        <input id="million" type="radio" required v-model="amount"  name="amount" value="1000000" :disabled="disableradio">
                        <label for="million">One Million Naira (&#8358; 1,000,000)</label>
                        <span></span>
                    </div>
                </div>
            </div>


            <br /><br /><br /><br />

            <!-- Proceed Button -->
            <div class="row">
                <div class="col-sm-12"><!--Button-->
                    <div class="form-group d-grid gap-2 col-3 mx-auto">
                        <button :v-model="proceed" :disabled="disableProceedButton" v-on:click="GenerateRRR" type="submit" value="Submit" class="btn btn-success btn-block btn-lg" name="btn_submit">
                            <span>Proceed </span>
                            <span v-html="proceedBtnSpinner"></span>
                        </button> 
                    </div>
                </div><!--End Button-->
            </div>

            <div class="row" v-show="showRemitaSection"><!-- Display Remita Details on Page -->
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <br />
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Remita RRR: </h4>
                        </div>
                        <div class="col-sm-6">
                            <h4><span v-html="rrrSpinner"></span></h4>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Service Fee (&#8358;):    </h4>
                        </div>
                        <div class="col-sm-6">
                            <h4><span v-html="feeSpinner"></span></h4>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Description:    </h4>
                        </div>
                        <div class="col-sm-6">
                            <h4><span v-html="descSpinner"></span></h4>
                        </div>
                    </div>
                    <br />
                    <div class="row"><!-- Beginning of Pay Via -->
                        <div class="col-sm-5">
                            <hr class="separator">
                        </div>
                        <div class="col-sm-2">
                            <center><h5>PAY VIA</h5></center>
                        </div>
                        <div class="col-sm-5">
                            <hr class="separator">
                        </div>
                    </div><!-- End of Pay Via -->

                    <div class="row"><!-- Remita Button -->
                        <div class="col-sm-12">
                            <center>
                                <div class="form-group d-grid gap-2 col-3 mx-auto">
                                    <button :disabled="disableRemitaBtn" v-on:click="MakePayment()" type="submit" title="Proceed to Remita Payment Gateway" class="btn remita btn-sm" name="remitaBtn">
                                        <img src="images/remita-payment-logo.png" width="40" height="41" style="display: inline; position: relative; left: -30px; v-align: middle;" />
                                        <b style="font-size: 1.71428571rem; v-align: middle">Remita</b>
                                    </button> 
                                </div>
                            </center>
                        </div>
                    </div><!-- End Remita Button -->
                    <div class="row">
                        <div class="col-sm-12">
                            <hr class="separator">
                        </div>
                    </div>
                </div>
            </div><!-- End of Remita Details Page -->
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
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

</div>
</template>
<script>
import NavBar from './navigations/BuycreditNav.vue';
import axios from 'axios';
export default {
    setup() {
        
    },
    data() {
        return{
            header_1: "Buy API Call Credit",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            rotor: '&nbsp;<i class="fas fa-sign-in-alt"></i>',
            amount: 0,
            proceed: null,
            disableProceedButton: true,
            disableRemitaBtn: true,
            showRemitaSection: false,
            rrr: null,
            disableradio: false,
            rrrSpinner: '',
            feeSpinner: '',
            descSpinner: '',
            proceedBtnSpinner: '',
            payerName: this.$session.get("organization"),
            payerEmail: this.$session.get("email"),
            payerPhone: this.$session.get("phone"),
            merchantId: "2547916",
            apiKey: "1946",
            serviceTypeId: "4430731",
            transId: "",
            units: null
        }
    }, 
    components:{
        NavBar
    },
    methods:{
        GenerateRRR(){
            this.proceedBtnSpinner = '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-white"></i>';
            var description = "CAC API e-Wallet Top up";

            var d = new Date();
            var orderId = d.getTime();
            var totalAmount = this.amount;

            var apiHash = CryptoJS.SHA512(this.merchantId+ this.serviceTypeId+ orderId+ totalAmount+ this.apiKey);
            var data = new TextEncoder().encode(JSON.stringify({
                'serviceTypeId': this.serviceTypeId,
                'amount': totalAmount,
                'orderId': orderId,
                'payerName': this.payerName,
                'payerEmail': this.payerEmail,
                'payerPhone': this.payerPhone,
                'description': description
            }))


            try{
                axios({
                method: 'post',
                url: 'https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit',
                data: data,
                headers: { 
                    'Content-type': 'application/json; charset=utf-8', 
                    'Authorization': 'remitaConsumerKey=' + this.merchantId + ',remitaConsumerToken=' + apiHash
                },
                responseType: 'json'
                })
                .then(response=>{
                    var str = response.data.substr(7,80);
                    var RemitaResponse = JSON.parse(str);
                    if(RemitaResponse.statuscode == "025"){ 
                        console.log(RemitaResponse);
                        this.showRemitaSection = true;
                        this.rrrSpinner = '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>';
                        this.feeSpinner = '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>';
                        this.descSpinner = '<i class="fa fa-spinner fa-spin fa-1x fa-fw text-secondary"></i>';
                        this.proceedBtnSpinner = '';
                        this.rrr = RemitaResponse.RRR;
                        this.disableradio = true;
                        this.disableProceedButton = true;
                        this.rrrSpinner = '<h4>' + this.rrr +'</h4>';
                        this.feeSpinner = '<h4>' + Number(this.amount).toLocaleString() +'</h4>';
                        this.descSpinner = '<h4>' + description +'</h4>';
                        this.disableRemitaBtn = false;
                    }
                    else{
                        alert("You got it wrong.");
                    }
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
        //New Function
        MakePayment(){
            const self = this;
            var merchantId = this.merchantId;
            var rrr = this.rrr;
            var apiKey = this.apiKey;
            var apiHash = CryptoJS.SHA512(rrr + apiKey + merchantId);
            var paymentEngine = RmPaymentEngine.init({
			key:"U09MRHw0MDgxOTUzOHw2ZDU4NGRhMmJhNzVlOTRiYmYyZjBlMmM1YzUyNzYwZTM0YzRjNGI4ZTgyNzJjY2NjYTBkMDM0ZDUyYjZhZWI2ODJlZTZjMjU0MDNiODBlMzI4YWNmZGY2OWQ2YjhiYzM2N2RhMmI1YWEwYTlmMTFiYWI2OWQxNTc5N2YyZDk4NA==",
		    processRrr: true,
			transactionId: this.GetTransactionId(),
			extendedData: { 
				customFields: [ 
					{ 
						name: "rrr", 
						value: this.rrr,
                        amount: this.amount
					} 
				 ]
			},
            onSuccess: function (msg) {
                this.transId = msg.transactionId;
                //console.log(msg);
                console.log('Now checking RRR Status');
                //Get RRR Status Demo
                try{
                axios({
                method: 'get',
                url: 'https://remitademo.net/remita/ecomm/' + merchantId +'/' + rrr + '/'+ apiHash + '/status.reg',
                headers: { 
                    'Content-type': 'application/json; charset=utf-8', 
                    'Authorization': 'remitaConsumerKey=' + merchantId + ',remitaConsumerToken=' + apiHash
                },
                responseType: 'json'
                })
                .then(response=>{
                    //console.log(response.data);
                    //We Submit the Data and Response to the DB
                    var postData = {
                        "amount": self.amount,
                        "message": response.data['message'],
                        "rrr": self.rrr,
                        "description": "CAC API e-Wallet Top up",
                        "transaction_datetime": response.data['paymentDate'],
                        "orderId": response.data['orderId'],
                        "status": response.data['status'],
                        "processorId": msg.processorId,
                        "transactionId": msg.transactionId,
                        "username": self.$session.get("username"),
                        "email": self.$session.get("email")
                    }
                    try{
                        axios.post("http://127.0.0.1:8000/api/post_transaction", postData) 
                        .then(response =>{
                            self.disableRemitaBtn = true;
                            this.disableRemitaBtn = true;
                            self.$router.push({ name: 'TransactionDetails', params: { rrr: self.rrr } });
                        })
                    }
                    catch{

                    }
                    //self.$router.push({ path: '/client-dashboard', params: { user: response.data } });
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
            onError: function (response) {
                console.log('callback Error Response', response);
            },
            onClose: function () {
            }
        });
         paymentEngine.showPaymentWidget();
        },
        //New Function
        GetTransactionId(){
            try{
                axios({
                method: 'get',
                url: 'http://127.0.0.1:8000/api/get_transaction_id',
                headers: { 
                    'Content-type': 'application/json; charset=utf-8', 
                },
                responseType: 'json'
                })
                .then(response =>{
                    return response.data;
                })
            }catch(err){    
                console.log(err)
            }
        }
    },
    watch: { //This watches the radio button group for any change of state
      amount: function()
      {
        this.disableProceedButton = false;
      }
    },
    beforeCreate: function () {
        if (!this.$session.exists()) {
        this.$router.push('/');
        }
        else{
            if(this.$session.get("role") != "Accessor" || this.$session.get('clientType') == 'Government'){
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
    }
}
</script>
