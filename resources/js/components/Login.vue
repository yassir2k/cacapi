<template>
<div>
    <br />
    <br />
    <br />
    <form>
    <div class="login-form">
        <div class="row">
            <div class="col-sm-12">
                <span v-html="AlertMsg"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 my-auto"><!--Logo-->
                <img src="/images/caclogo_big.png" width="120" height="120" class="rounded" alt="Rounded Image" />
            </div>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-12" align="left"><!--Sign In-->
                        <h2 class="text-center text-secondary"><strong>API Portal</strong></h2>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-sm-12"><!--Sign In-->
                        <h5 class="text-center" style="color: #8FBC8F"><strong>Sign In</strong></h5>
                    </div>
                </div> 
                    <input type="hidden" name="_token" :value="csrf"> 
                    <div class="row"> 
                        <div class="col-sm-12"><!--Username-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <span class="fa fa-user" style="color: #8FBC8F"></span>
                                    </span>                    
                                    <input type="text" class="form-control" placeholder="Email" name="username" v-model="username">
                                </div>
                                <span v-if="username_" class="text-danger small">Username required</span>
                            </div>
                        
                        </div><!--End Username-->
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12"><!--Password-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock" style="color: #8FBC8F"></i>
                                    </span>                    
                                    <input type="password" class="form-control" placeholder="Password" name="password" v-model="password">
                                </div>
                                <span v-if="password_" class="text-danger small">Password required</span>
                            </div>
                        </div><!--End Password-->
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12"><!--Button-->
                            <div class="form-group d-grid gap-2">
                                <button :disabled="freeze" v-on:click.prevent="Login" type="submit"  class="btn btn-success btn-block">
                                    <span>Login</span>
                                    <span v-html="rotor"></span>
                                </button> 
                            </div>
                        </div><!--End Button-->
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span v-html="status"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5"><!--Forgot Password-->
                            <small class="text-center medium" ><a class="text-success" href="/password-recovery">Forgot Password?</a></small>
                        </div>
                        <div class="col-sm-7"><!--Sign Up-->
                            <small class="text-center medium">New user Account? <a class="text-success" href="/signup">Sign up here</a></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </form>
</div>
</template>

<script>
import axios from 'axios'
    export default {
        data() {
            return{
                errors: [],
                username: null,
                password: null,
                username_: null,
                password_: null,
                freeze: false,
                status: null,
                rotor: '&nbsp;<i class="fas fa-sign-in-alt"></i>',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                user: {},
                msg: null
                
            }
        },
        beforeCreate(){
            this.msg = this.$session.get("passwordRecoveryErrorMsg");
            if(this.msg != null){
                this.AlertMsg = '<div id="s_alert" class="alert alert-danger alert-dismissible fade show">' +
                            '<strong><i class="fas fa-times-circle"></i></strong> '+ this.msg  +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            }
            this.msg = this.$session.get("passwordResetSuccessMsg");
            if(this.msg != null){
                this.AlertMsg = '<div id="s_alert" class="alert alert-success alert-dismissible fade show">' +
                            '<strong><i class="fas fa-check-circle"></i></strong> '+ this.msg  +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            }
            this.$session.destroy();
        },
        methods:{
            checkForm(e){
                this.status = "";
                this.username_=false;
                this.password_=false;
                if (this.username && this.password) {
                    return true;
                }

                this.errors = [];

                if (!this.username) {
                    this.errors.push('Password required.');
                    this.username_=true;
                }
                if (!this.password) {
                    this.errors.push('Password required.');
                    this.password_=true;
                }
                e.preventDefault();
            },
            Login(){
                this.checkForm();
                this.rotor = '&nbsp;<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>';
                this.freeze = true;
                var postData = {
                    "username": this.username,
                    "password": this.password
                }
                const genRanHex = size => [...Array(size)].map(() => Math.floor(Math.random() * 16)
                .toString(16)).join(''); //Generates Random Hex
                const token = genRanHex(100);
                var d = new Date();
                const sessionId = d.getTime();
                var apiHash = CryptoJS.SHA512(sessionId + this.username + token );
                try{
                    axios({
                    method: 'post',
                    url: 'http://127.0.0.1:8000/api/login',
                    data: postData,
                    headers: { 
                        'Content-type': 'application/json; charset=utf-8', 
                        'Authorization': 'Key=' + sessionId + ',Hash=' + apiHash + ',Token=' + token,
                    },
                    responseType: 'json'
                    })
                    .then(response =>{
                        if(response.data["status"] == "success"){
                            this.status='<div class="alert alert-success text-justify"><center>Success!</center></label>';
                            this.$session.start();
                            this.$session.set('token', response.data["token"]);
                            this.$session.set('email', response.data["email"]);
                            this.$session.set('username', response.data["username"]);
                            this.$session.set('organization', response.data["organization"]);
                            this.$session.set('address', response.data["address"]);
                            this.$session.set('phone', response.data["phone"]);
                            this.$session.set('role', response.data["role"]);
                            this.$session.set('clientType', response.data["clientType"]);
                            //window.axios.defaults.headers.common['X-CSRF-TOKEN'] ;
                            if(response.data["role"] == "Accessor")
                                this.$router.push({ name: 'Dashboard'});
                            if(response.data["role"] == "Admin")
                                this.$router.push({ name: 'AdminDashboard'});
                        }
                        else{
                            this.status='<div class="alert alert-danger text-danger"><center>Login attempt failed.</center></label>';
                            this.rotor = '&nbsp;<i class="fas fa-sign-in-alt"></i>';
                             this.freeze = false;
                        }
                    })
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
            }
        },
        watch: {
            $route(to, from) {
                this.login();
            }
        }
    }
</script>

<style>
    .error-boarder {
        border-color: red;
    }
</style>
