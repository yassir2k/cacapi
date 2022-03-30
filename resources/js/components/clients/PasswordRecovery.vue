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
            <br />
            <br />
            <br />
            <br />
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <strong>Email:</strong><b class="text-danger">*</b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-user-check" style="color: #8FBC8F"></i>
                                </span>                    
                                <input v-on:blur="ValidateEmail"  class="form-control" placeholder="Enter your account email" v-model="email" required>
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
                        <button :disabled="freeze" v-on:click.prevent="ProcessPasswordRecovery" type="submit" value="submit" class="btn btn-success btn-block" name="save_user_info">
                            <span>Recover Password</span>
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

            header_1: "Password Recovery",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            AlertMsg: '',
            rotor: '<i class="fas fa-angle-right"></i>',
            email: '',
            freeze: false
        }
    },
    methods:{
        ProcessPasswordRecovery(){
            this.AlertMsg = '';
            this.rotor = '&nbsp;<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>';
            this.freeze = true;
            var dat = {
                "email": this.email,
            }
            try{
                axios({
                method: 'post',
                data: dat,
                url: 'http://127.0.0.1:8000/api/process_password_recovery',
                headers: { 
                    'Content-type': 'application/json; charset=utf-8', 
                },
                responseType: 'json'
                })
                .then(response =>{
                    if(response.data["Message"] == "Valid")
                    {
                        this.$session.start();
                        this.$session.set('TokenKey', response.data["Hash"]);
                        this.$router.push({ name: 'ValidatePasswordRecovery' });
                    }
                    else
                    {
                        this.AlertMsg = '<div id="s_alert" class="alert alert-danger alert-dismissible fade show">' +
                            '<strong><i class="fas fa-times-circle"></i></strong> '+ response.data  +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                    }
                    this.freeze = false;
                    this.rotor = '<i class="fas fa-angle-right"></i>';
                })
            }
            catch(err){    
                    console.log("Get Transaction Details Error: " + err);
            }
        },
        ValidateEmail(){
            var r = !/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.email);
            if(r){
                this.AlertMsg = '<div id="s_alert" class="alert alert-danger alert-dismissible fade show">' +
                            '<strong><i class="fas fa-times-circle"></i></strong> You\'ve entered an invalid email format. Please ensure you enter your email correctly' +
                            ' in order to proceed.' +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                this.freeze = true;
            }
            else{
                this.freeze = false;
            }
        }
    }
}
</script>