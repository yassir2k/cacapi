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
                <div class="col-sm-3">
                </div>
                <div class="col-sm-5">
                    <span v-html="AlertMsg"></span>
                </div>
                <div class="col-sm-3">
                </div>
            </div>

            <div class="row"> <!-- Top Row -->
                <div class="col-sm-3">
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <strong>Current Password:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-10 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-unlock-alt" style="color: #8FBC8F"></i>
                                </span>                    
                                <input v-bind:type="[showCurrentPassword ? 'text' : 'password']"  class="form-control" placeholder="Your current password here" v-model="c_password" required>
                                <span class="input-group-text" style="background-color: white"  @click="showCurrentPassword = !showCurrentPassword">
                                    <i class="fas" :class="[showCurrentPassword ? 'fa-eye' : 'fa-eye-slash']"></i>
                                </span>
                            </div>
                        </div>
                    </div><!--End Email Subject-->
                    </div>
                </div>

                <div class="col-sm-3">
                </div>
            </div> <!-- Top Row -->

            <br />

            <div class="row"> <!-- Middle Row -->
                <div class="col-sm-3">
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <strong>New Password:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-10 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-unlock" style="color: #8FBC8F"></i>
                                </span>                    
                                <input v-bind:type="[showNewPassword ? 'text' : 'password']"  class="form-control" placeholder="Your new password here" v-model="n_password" required>
                                <span class="input-group-text" style="background-color: white"  @click="showNewPassword = !showNewPassword">
                                    <i class="fas" :class="[showNewPassword ? 'fa-eye' : 'fa-eye-slash']"></i>
                                </span>
                            </div>
                        </div>
                    </div><!--End Email Subject-->
                    </div>
                </div>

                <div class="col-sm-3">
                </div>
            </div> <!-- Middle Row -->

            <br />

            <div class="row"> <!-- Bottom Row -->
                <div class="col-sm-3">
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <strong>Confirm New Password:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-10 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-unlock" style="color: #8FBC8F"></i>
                                </span>                    
                                <input v-bind:type="[showConfirmPassword ? 'text' : 'password']"  class="form-control" placeholder="Retype new password here" v-model="cf_password" required>
                                <span class="input-group-text" style="background-color: white"  @click="showConfirmPassword = !showConfirmPassword">
                                    <i class="fas" :class="[showConfirmPassword ? 'fa-eye' : 'fa-eye-slash']"></i>
                                </span>
                            </div>
                        </div>
                    </div><!--End Email Subject-->
                    </div>
                </div>

                <div class="col-sm-3">
                </div>
            </div> <!-- Bottom Row -->

            <br />
            <div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif"><!-- Update Button -->
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="form-group d-grid gap-2">
                        <button :disabled="freeze" v-on:click.prevent="UpdatePassword" type="submit" value="submit" class="btn btn-success btn-block" name="save_user_info">
                            <span>Update</span>
                            <span v-html="rotor"></span>
                        </button> 
                    </div>
                </div>
                <div class="col-sm-3">
                </div>
            </div><!--End Button-->

            <br />

        </div>
        <div class="col-sm-3"> <!-- Handles User Profile Details and current units -->

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

</div>
</template>

<script>
import NavBar from './navigations/EditAdminNav.vue';
import axios from 'axios';
export default {
    data() {
        return {

            header_1: "Change Admin Password",
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
            showCurrentPassword: false,
            showNewPassword: false,
            showConfirmPassword: false,
            n_password: '',
            c_password: '',
            cf_password: '',
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
            if(this.$session.get("role") != "Admin"){
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
            }
        }
    },
    methods:{
        UpdatePassword(){
            this.AlertMsg = '';
            const user = this.$session.get('username');
            this.rotor = '&nbsp;<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>';
            this.freeze = true;
            var dat = {
                "password": this.c_password,
                "new_password": this.n_password,
                "confirm_password": this.cf_password,
                "username": user
            }
            if(this.cf_password != this.n_password)
            {
                this.AlertMsg = '<div id="s_alert" class="alert alert-danger alert-dismissible fade show">' +
                '<strong><i class="fas fa-times-circle"></i></strong> New Password and Confirm New Password Mismatch' +
                '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                this.freeze = false;
                this.rotor = '&nbsp;<i class="fas fa-save"></i>';
                return;
            }
            else{
                /*---------------------------------------------
                Update via API
                ---------------------------------------------*/
                try{
                    axios.post('http://127.0.0.1:8000/api/change_user_password', dat)
                    .then(response =>{
                        console.log(response);
                        this.freeze = false;
                        this.rotor = '&nbsp;<i class="fas fa-save"></i>';
                        if(response.data == "success"){
                            this.AlertMsg = '<div id="s_alert" class="alert alert-success alert-dismissible fade show">' +
                            '<strong><i class="fas fa-check-circle"></i></strong> Password successfully changed' +
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
                    this.freeze = false;
                    this.rotor = '&nbsp;<i class="fas fa-save"></i>';
                }

            }
        }
    },
    mounted(){
        //$('.alert-success').fadeOut(10000);
        //$('.alert-danger').fadeOut(10000);
    }
}
</script>