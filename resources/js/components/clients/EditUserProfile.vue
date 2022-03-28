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
            <!-- -------------------------------------------------------------
            Main Stuff Here
            -------------------------------------------------------------- -->

            <div class="row">
                <div class="col-sm-12">
                    <span v-html="AlertMsg"></span>
                </div>
            </div>

            <div class="row"> <!-- Top Row -->
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <strong>Username:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="far fa-user" style="color: #8FBC8F"></i>
                                    </span>                    
                                    <input v-model="username" type="text" class="form-control"  required disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <strong>Organization:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-10 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-university" style="color: #8FBC8F"></i>
                                </span>                    
                                <input  class="form-control" placeholder="Your CAC Email Address" v-model="organization" required disabled >
                            </div>
                        </div>
                    </div><!--End Email Subject-->
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <strong>Email:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-10 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope-open-text" style="color: #8FBC8F"></i>
                                </span>                    
                                <input  class="form-control" placeholder="Your CAC Email Address" v-model="email" required >
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
                        <div class="col-sm-12 align-middle">
                            <strong>Contact Name:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-file-signature" style="color: #8FBC8F"></i>
                                    </span>                    
                                    <input type="text" class="form-control" placeholder="Your Staff ID No." v-model="contactName" required >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <strong>Contact Mobile Phone Number:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-10 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-phone-square-alt" style="color: #8FBC8F"></i>
                                </span>                    
                                <input  class="form-control" placeholder="Your CAC Email Address" v-model="contactNumber" required >
                            </div>
                        </div>
                    </div><!--End Email Subject-->
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <strong>Status:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-10 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-user-check" style="color: #8FBC8F"></i>
                                </span>                    
                                <input  class="form-control" placeholder="Your CAC Email Address" v-model="status" required disabled>
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
                        <div class="col-sm-12 align-middle">
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
                                    <textarea class="form-control _textarea" v-model="address" 
                                        maxlength="1000" placeholder="Current Office Address" rows="2" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End of Bottom Row -->


            <div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif"><!-- Update Button -->
                <div class="col-sm-5">
                </div>
                <div class="col-sm-2">
                    <div class="form-group d-grid gap-2">
                        <button :disabled="freeze" v-on:click.prevent="UpdateUserInfo" type="submit" value="submit" class="btn btn-success btn-block" name="save_user_info">
                            <span>Update</span>
                            <span v-html="rotor"></span>
                        </button> 
                    </div>
                </div>
                <div class="col-sm-5">
                </div>
            </div><!--End Button-->

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

</div>
</template>

<script>
import NavBar from './navigations/UserSettingsNav.vue';
import axios from 'axios';
export default {
    data() {
        return {

            header_1: "Edit User Profile",
            units: 0,
            freeze: false,
            rotor: '&nbsp;<i class="fas fa-save"></i>',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            username: "...",
            email: "...",
            organization: "...",
            contactName: "...",
            contactNumber: "...",
            status: "...",
            address: "...",
            AlertMsg:''
        }
    },
    components:{
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
                const postData = {
                    "username": this.$session.get("username"),
                }
                try{
                    axios.post("http://127.0.0.1:8000/api/get_realtime_units", postData) 
                    .then(response =>{
                        this.units = response.data["units"];
                    })
                }
                catch{
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

                /*--------------------------------------------------------
                Now populating text fields with info using API
                ------------------------------------------------------- */

                try{
                    axios.post("http://127.0.0.1:8000/api/fetch_user_details", postData) 
                    .then(resp =>{
                        this.username = resp.data['username'],
                        this.email = resp.data['email'],
                        this.organization = resp.data['organization_name'],
                        this.contactName = resp.data['contact_name'],
                        this.contactNumber = resp.data['contact_phone'],
                        this.status = resp.data['is_active'] == 1? "Active" : "Inactive",
                        this.address = resp.data['address']
                    })
                }
                catch{
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
        }
    },
    methods:{
        UpdateUserInfo(){
            this.AlertMsg = '';
            const user = this.$session.get('username');
            this.rotor = '&nbsp;<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>';
            this.freeze = true;
            var dat = {
                "username": user,
                "email": this.email,
                "contactName": this.contactName,
                "contactMobile": this.contactNumber,
                "address": this.address
            }
            /*---------------------------------------------
                Update via API
             ---------------------------------------------*/
             try{
                axios.post('http://127.0.0.1:8000/api/update_user_details', dat)
                .then(response =>{
                    console.log(response);
                    this.freeze = false;
                    this.rotor = '&nbsp;<i class="fas fa-save"></i>';
                    if(response.data == "User data successfully updated"){
                        this.AlertMsg = '<div id="s_alert" class="alert alert-success alert-dismissible fade show">' +
                        '<strong><i class="fas fa-check-circle"></i></strong> User data successfully updated' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                    }
                    else{
                        this.AlertMsg = '<div id="s_alert" class="alert alert-danger alert-dismissible fade show">' +
                        '<strong><i class="fas fa-times-circle"></i></strong> '+ response.data  +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
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
            this.freeze = false;
            this.rotor = '&nbsp;<i class="fas fa-save"></i>';
        }
    },
}
</script>