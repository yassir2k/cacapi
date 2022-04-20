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
        <div class="col-sm-9">
            <h2 style="border-bottom: 1px solid #DDDDDD">{{header_1}}</h2>
            <br />
            <!-- -------------------------------------------------------------
            Main Stuff Here
            -------------------------------------------------------------- -->

            <div class="row">
                <div class="col-sm-12">
                    <div v-if="errors.length">
                        <div id="s_alert" class="alert alert-danger alert-dismissible fade show">
                            <strong><i class="fas fa-times-circle"></i></strong> <b>Please correct the following error(s):</b>
                                <ul>
                                    <li v-for="error in errors" :key="error">{{ error }}</li>
                                </ul>
                            <button type="button" class="btn-close" ></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row"> <!-- Top Row -->

                <div class="col-sm-4">
                    <div class="row">
                        <div class=" align-middle">
                            <strong>Organization:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-university" style="color: #8FBC8F"></i>
                                </span>                    
                                <input  class="form-control" placeholder="Your Organization's name ..." v-model="Organization" required>
                            </div>
                        </div>
                    </div><!--End Email Subject-->
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class=" align-middle">
                            <strong>Contact Name:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="far fa-user" style="color: #8FBC8F"></i>
                                    </span>                    
                                    <input v-model="contactName" type="text" class="form-control"  required placeholder="Contact person's name...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class=" align-middle">
                            <strong>Email:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope-open-text" style="color: #8FBC8F"></i>
                                </span>    
                                <input  class="form-control" placeholder="Email address" v-model="Email" required >                
                                <!-- <input v-on:blur="GenerateUsername"  class="form-control" placeholder="Email address" v-model="Email" required > -->
                            </div>
                        </div>
                    </div><!--End Email Subject-->
                    </div>
                </div>
            </div> <!-- Top Row -->

            <br />

            <div class="row"> <!-- Middle Row -->
                <div class="col-sm-4">
                    <div class="row">
                        <div class=" align-middle">
                            <strong>Phone Number:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-phone-square-alt" style="color: #8FBC8F"></i>
                                </span>                    
                                <input  class="form-control" placeholder="Your Mobile phone number" v-model="phoneNumber" required >
                            </div>
                        </div>
                    </div><!--End Email Subject-->
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class=" align-middle">
                            <strong>Username:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user-alt" style="color: #8FBC8F"></i>
                                </span>                    
                                <input type="text"  class="form-control" placeholder="Your username (alphanumeric input only)" v-model="username" required>
                            </div>
                        </div>
                    </div><!--End Email Subject-->
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class=" align-middle">
                            <strong>Client's API Host IP Address:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-server" style="color: #8FBC8F"></i>
                                </span>                    
                                <input type="text"  class="form-control" placeholder="Your username (alphanumeric input only)" v-model="ipAddress" required>
                            </div>
                        </div>
                    </div><!--End Email Subject-->
                    </div>
                </div>
            </div> <!-- Middle Row -->

            <br />

            <div class="row"><!-- Bottom Row -->
                <div class="col-sm-12">
                    <div class="row">
                        <div class=" align-middle">
                            <strong>Address:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marked-alt" style="color: #8FBC8F; margin-top: -30px"></i>
                                    </span>                    
                                    <textarea class="form-control _textarea" v-model="Address" 
                                        maxlength="1000" placeholder="Current Office Address" rows="2" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End of Bottom Row -->

            <br />

            <div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif"><!-- Update Button -->
                <div class="col-sm-5">
                </div>
                <div class="col-sm-2">
                    <div class="form-group d-grid gap-2">
                        <button :disabled="freeze" v-on:click="CreateNewAccount" type="submit" value="submit" class="btn btn-success btn-block" name="create_account">
                            <span>Create Account</span>
                            <span v-html="rotor"></span>
                        </button> 
                    </div>
                </div>
                <div class="col-sm-5">
                </div>
            </div><!--End Button-->

            <div class="row">
                <div class="col-sm-12">
                    <span v-html="AlertMsg"></span>
                </div>
            </div>

        </div>
        <div class="col-sm-2">
        </div>
    </div>

</div>
</template>

<script>
import axios from 'axios';
import NavBar from './navigations/NewMdaUserNav.vue';
export default {
    data() {
        return {

            header_1: "Signup",
            units: 0,
            freeze: false,
            rotor: '&nbsp;<i class="fas fa-user-plus"></i>',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            AlertMsg: '',
            ipAddress:'',
            Organization: '',
            contactName: '',
            Email: '',
            phoneNumber: '',
            Address: '',
            username: '',
            errors: [],
            errorCount: 0,
            AlertMsg:''
        }
    },
    components:{
         NavBar
    },
    methods:{
        CreateNewAccount(){
            this.errorCount = 0;
            this.rotor = '&nbsp;<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>';
            this.freeze = true;
            this.errors = [];
            this.AlertMsg = '';
            //Use Regex to validate email format
            var r = !/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.Email)
            if(r == true)
            {
                //inavlid email
                this.errors.push("Invalid Email Syntax");
                this.errorCount++;
            }
            if(!this.Organization)
            {
                this.errors.push("Organization Name is unfilled.");
                this.errorCount++;
            }
            if(!this.contactName)
            {
                this.errors.push("Contact Name is unfilled.");
                this.errorCount++;
            }
            if(!this.phoneNumber)
            {
                this.errors.push("Phone number is unfilled.");
                this.errorCount++;
            }
            if(!this.Address)
            {
                this.errors.push("Address is unfilled.");
                this.errorCount++;
            }
            if(!this.username)
            {
                this.errors.push("Username is unfilled.");
                this.errorCount++;
            }
            if(!this.ipAddress)
            {
                this.errors.push("Client's Server IP Address is unfilled.");
                this.errorCount++;
            }
            if(this.errorCount > 0)
            {
                this.freeze = false;
                this.rotor = '&nbsp;<i class="fas fa-user-plus"></i>';
                return false;
            }

            /*-----------------------------------------------------------------------
                    Now is to focus on posting data vis API to the database
            -----------------------------------------------------------------------*/
            var dat = {
                "Organization": this.Organization,
                "ContactName": this.contactName,
                "Email": this.Email,
                "PhoneNumber": this.phoneNumber,
                "Address": this.Address,
                "IpAddress": this.ipAddress,
                "Username": this.username
            }

            //Axios time
            try{
                axios({
                method: 'post',
                url: 'http://127.0.0.1:8000/api/sign_up_mda_user',
                data: dat,
                headers: { 
                    'Content-type': 'application/json; charset=utf-8', 
                },
                responseType: 'json'
                })
                .then(response=>{
                    if(response.data == "saved"){
                        this.AlertMsg = '<div id="s_alert" class="alert alert-success alert-dismissible fade show">' +
                        '<strong><i class="fas fa-check-circle"></i></strong> MDA User Successfully Created. An email verification link has been sent to <b>' + this.Email +
                        '</b> for verification.'
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                        this.Organization = '';
                        this.contactName = '';
                        this.Email = '';
                        this.phoneNumber = '';
                        this.Address = '';
                        this.ipAddress = '';
                        this.username = '';
                    }
                    else{
                        this.AlertMsg = '<div id="s_alert" class="alert alert-danger alert-dismissible fade show">' +
                        '<strong><i class="fas fa-times-circle"></i></strong> '+ response.data  +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                    }

                    this.freeze = false;
                    this.rotor = '&nbsp;<i class="fas fa-user-plus"></i>';
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
        GenerateUsername(){
            var r = !/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.Email);
            if(r == false)
            {
                //Extract username from email address
                //e.g. somename@organization.com, then username becomes organization
                var atIndex = this.Email.indexOf('@');
                var dotIndex = this.Email.indexOf('.');
                this.username = this.Email.substr(atIndex + 1, dotIndex - atIndex - 1);
            }
        }
    },
    mounted(){
        //$('.alert-success').fadeOut(10000);
        //$('.alert-danger').fadeOut(10000);
    }
}
</script>
<style scoped>
    .pagination{
        margin-bottom: 0;
    }
</style>