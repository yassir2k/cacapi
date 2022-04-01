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
            <!-- -------------------------------------------------------------
            Main Stuff Here
            -------------------------------------------------------------- -->
            <div class="m-4">
                <div class="alert alert-success alert-dismissible fade show">
                    <h4 class="alert-heading"><i class="fas fa-check-circle"></i> A Password recovery token has been sent to your email.</h4>
                    <p>Please enter the token in the text field below in order to reset your password successfully.</p>
                    <hr>
                    <p class="mb-0"><b>Attention: </b><i>Kindly ensure you do not refresh this page. For security reasons, you would have to re-initiate the password recovery process should you refresh, or navigate from this page.</i></p>
                </div>
            </div>
            <br />
            <br />
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <strong>Token:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-barcode" style="color: #8FBC8F"></i>
                                </span>                    
                                <input class="form-control" placeholder="Enter the token sent to your email" v-model="token" required>
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
                        <button :disabled="freeze" v-on:click.prevent="ValidatePasswordRecoveryToken" type="submit" value="submit" class="btn btn-success btn-block" name="save_user_info">
                            <span>Validate Token</span>
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

            header_1: "Validate Password Recovery Token",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            AlertMsg: '',
            rotor: '&nbsp;<i class="fas fa-check"></i>',
            token: '',
            freeze: false,
            hash: ''
        }
    },
    beforeCreate(){
        this.hash = this.$session.get("TokenKey");
        if (!this.$session.exists()) {
            this.$session.set('passwordRecoveryErrorMsg', "You are not allowed to access this request via direct url entry.");
            this.$router.push('/');
        }
    },
    methods:{
        ValidatePasswordRecoveryToken(){
            const key = this.$session.get("TokenKey");
            this.AlertMsg = '';
            this.rotor = '&nbsp;<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>';
            this.freeze = true;
            var dat = {
                "passwordRecoveryToken": this.token,
                "passwordRecoveryHash": key
            }
            try{
                axios({
                method: 'post',
                data: dat,
                url: 'http://127.0.0.1:8000/api/validate_password_recovery_token',
                headers: { 
                    'Content-type': 'application/json; charset=utf-8', 
                },
                responseType: 'json'
                })
                .then(response =>{
                    console.log(response);
                    if(response.data["Message"] == "Success")
                    {
                            this.$session.remove("TokenKey");
                            this.$session.set('Hash', response.data["Hash"]);
                            this.$router.push({ name: 'ResetPassword' });
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