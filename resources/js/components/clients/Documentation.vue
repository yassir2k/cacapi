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
                <h2 style="border-bottom: 1px solid #DDDDDD">{{header_1}}</h2>
                <br />
                <div class="m-6">
                    <div class="accordion" id="myAccordion">
                        <div class="accordion-item" >
                            <h2 class="accordion-header" id="headingOne">
                                <button style="background-color: #5F8575" type="button" class="accordion-button text-light" data-bs-toggle="collapse" data-bs-target="#collapseOne">1. Basic API call with Company details ONLY</button>									
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show">
                                <div class="card-body">
                                    <p>&nbsp; This API call is applicable to all Entity categories (Business Names [1], Company [2], and Incorporated Trustees [3]).</p>
                                    <p>&nbsp; The API resource is invoked using the link syntax below:
                                    <p class="text-primary"><strong>&nbsp; http://api.cac.gov.ng/api/organizations/[username]/[password]/[apiCallType]/[entityRegistrationNumber]/[entityClassification]</strong></p>
                                    <p>&nbsp; where:</p>
                                    <p><b>&nbsp; [username]:</b> Your given username issued by CAC (in your case, it is <b>{{this.$session.get('username')}}</b>)</p>
                                    <p><b>&nbsp; [password]:</b> Your alphanumeric password configured during your registration.</p>
                                    <p><b>&nbsp; [apiCallType]:</b> API Call type signals what exactly you're requesting from CAC. For instance, <b>1</b> means requesting Entity's basic info ONLY.</p>
                                    <p><b>&nbsp; [entityRegistrationNumber]:</b> Registration number of the entity you would want to search, whether BN, IT, or RC Number (e.g. RC 1662939)</p>
                                    <p><b>&nbsp; [entityClassification]:</b> The requesting Entity's category or classification. There are ONLY 3 possibilities here: </p>
                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>1 </b>- For Business Names </p>
                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>2 </b>- For Companies </p>
                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>3 </b>- For Incorporated Trustees </p>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header text-light" id="headingTwo">
                                <button style="background-color: #5F8575" type="button" class="accordion-button collapsed text-light" data-bs-toggle="collapse" data-bs-target="#collapseTwo">2. Basic API call with Company and Director(s) details</button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse">
                                <div class="card-body">
                                    <p>Bootstrap is a sleek, intuitive, and powerful front-end framework for faster and easier web development. It is a collection of CSS and HTML conventions. <a href="https://www.tutorialrepublic.com/twitter-bootstrap-tutorial/" target="_blank">Learn more.</a></p>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button style="background-color: #5F8575" type="button" class="accordion-button collapsed text-light" data-bs-toggle="collapse" data-bs-target="#collapseThree">3. Basic API call with Company and Shareholder(s) details</button>                     
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse">
                                <div class="card-body">
                                    <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="https://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button style="background-color: #5F8575" type="button" class="accordion-button collapsed text-light" data-bs-toggle="collapse" data-bs-target="#collapseFour">4. Basic API call with Company and Secretary details</button>                     
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse">
                                <div class="card-body">
                                    <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="https://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                                </div>
                            </div>
                        </div>


                    </div>
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
        <br />
        <br />
        <br />
        <br />
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
import NavBar from './navigations/APIDocumentationNav.vue';
export default ({
    setup() {
        
    },
    data(){
        return{
            header_1: "API Documentation",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            units: 0
        }
    },
    components:{
        NavBar
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
                        console.log(response);
                    })
                }
                catch(err){    
                        console.log("Get realtime Units Error: " + err);
                }
            }   
        }
    }
})
</script>
<style scoped>
/*.accordion-button.collapsed {
  
}*/

.accordion-button.collapsed::after {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

.accordion-button::before {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

</style>
