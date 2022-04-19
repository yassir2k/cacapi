<template>
    <div>
    <br />
    <br />
    <!-- Beginning of Center -->
    <!-- Heading -->
    <input type="hidden" name="_token" :value="csrf"> 
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-9">
            <h2 style="border-bottom: 1px solid #DDDDDD">{{header_1}}</h2>
            <br />
            <br />
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <div class="alert alert-success alert-dismissible fade show">
                        <h4 class="alert-heading"><i class="fas fa-check-circle"></i>&nbsp; You've successfully verified your Email.</h4>
                        <hr>
                        <p>Please kindly go ahead and create a new password.</p>
                    </div>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <strong>New Password:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-unlock" style="color: #8FBC8F"></i>
                                </span>                    
                                <input v-bind:type="[showNewPassword ? 'text' : 'password']"  class="form-control" placeholder="Your new password here" v-model="NewPassword" required>
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
            </div>

            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <strong>Confirm New Password:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-unlock" style="color: #8FBC8F"></i>
                                </span>                    
                                <input v-bind:type="[showConfirmPassword ? 'text' : 'password']"  class="form-control" placeholder="Retype new password here" v-model="ConfirmNewPassword" required>
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
            </div>

            <br />

            <div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif"><!-- Update Button -->
                <div class="col-sm-5">
                </div>
                <div class="col-sm-2">
                    <div class="form-group d-grid gap-2">
                        <button :disabled="freeze" v-on:click.prevent="ResetPassword" type="submit" value="submit" class="btn btn-success btn-block" name="save_user_info">
                            <span>Create New Password</span>
                            <span v-html="rotor"></span>
                        </button> 
                    </div>
                </div>
                <div class="col-sm-5">
                </div>
            </div><!--End Button-->
            <br />
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <span v-html="AlertMsg"></span>
                </div>
                <div class="col-sm-3">
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
export default {
    data() {
        return {

            header_1: "Reset Password",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            AlertMsg: '',
            rotor: '&nbsp;<i class="fas fa-check"></i>',
            token: '',
            freeze: false,
            hash: '',
            showNewPassword: false,
            showConfirmPassword: false,
            NewPassword: '',
            ConfirmNewPassword: ''
        }
    },
    beforeCreate(){
        this.hash = this.$session.get("MDAToken");
        if (this.hash == null) {
            this.$session.set('passwordRecoveryErrorMsg', "You are not allowed to access this request via direct url entry.");
            this.$router.push('/');
        }
    },
    methods:{
        ResetPassword(){
            this.AlertMsg = '';
            this.rotor = '&nbsp;<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>';
            this.freeze = true;
            if(this.NewPassword != this.ConfirmNewPassword)
            {
                this.AlertMsg = '<div id="s_alert" class="alert alert-danger alert-dismissible fade show">' +
                            '<strong><i class="fas fa-times-circle"></i></strong> The two passwords do not match.' +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                this.freeze = false;
                this.rotor = '&nbsp;<i class="fas fa-badge-check"></i>';
                return false;
            }
            const key = this.$session.get("MDAToken");
            var dat = {
                "newPassword": this.NewPassword,
                "confirmPassword": this.ConfirmNewPassword,
                "hash": key
            }
            try{
                axios({
                method: 'post',
                data: dat,
                url: 'http://127.0.0.1:8000/api/new_mda_password',
                headers: { 
                    'Content-type': 'application/json; charset=utf-8', 
                },
                responseType: 'json'
                })
                .then(response =>{
                    console.log(response);
                    if(response.data == "Success")
                    {
                        this.$session.remove("MDAToken");
                        this.$session.set('passwordResetSuccessMsg', "You have successfully created a new password.");
                        this.$router.push({ name: 'Login' });
                    }
                    else
                    {
                        this.AlertMsg = '<div id="s_alert" class="alert alert-danger alert-dismissible fade show">' +
                            '<strong><i class="fas fa-times-circle"></i></strong> '+ response.data  +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                    }
                    this.freeze = false;
                    this.rotor = '&nbsp;<i class="fas fa-badge-check"></i>';
                })
            }
            catch(err){    
                    console.log("Get Transaction Details Error: " + err);
            }
        }
    }
}
</script>