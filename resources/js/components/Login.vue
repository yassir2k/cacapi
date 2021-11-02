<template>
    <div class="login-form">
    <div class="row h-100">
        <div class="col-sm-3 my-auto"><!--Logo-->
            <img src="/images/caclogo_big.png" width="120" height="120" class="rounded" alt="Rounded Image" />
        </div>
        <div class="col-sm-9">
            <div class="row">
            <div class="col-sm-12" align="left"><!--Sign In-->
                <h1 class="text-center text-secondary"><strong>API Portal</strong></h1>
            </div>
            </div>
            <div class="row">
                <div class="col-sm-12"><!--Sign In-->
                    <h5 class="text-center" style="color: #8FBC8F"><strong>Sign In</strong></h5>
                </div>
            </div>
            <form id="app" action="/"  @submit="checkForm" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif"> 
                <input type="hidden" name="_token" :value="csrf">
                <div class="row">
                    <div class="col-sm-12"><!--Username-->
                    
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fa fa-user" style="color: #8FBC8F"></span>
                                    </span>                    
                                </div>
                                <input type="text" class="form-control" placeholder="Username" name="username" v-model="username">
                            </div>
                            <span v-if="username_" class="text-danger small">Username required</span>
                        </div>
                    
                    </div><!--End Username-->
                </div>
                
                <div class="row">
                    <div class="col-sm-12"><!--Password-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock" style="color: #8FBC8F"></i>
                                    </span>                    
                                </div>
                                <input type="password" class="form-control" placeholder="Password" name="password" v-model="password">
                            </div>
                            <span v-if="password_" class="text-danger small">Password required</span>
                        </div>
                    </div><!--End Password-->
                </div>
                
                <div class="row">
                    <div class="col-sm-12"><!--Button-->
                        <div class="form-group">
                            <button type="submit" value="Submit" class="btn btn-success btn-block" name="btn_submit">
                                <span>Login</span>
                                <i class="fa fa-sign-in" style="horizontal-align: right;" ></i>
                            </button> 
                        </div>
                    </div><!--End Button-->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><!--Forgot Password-->
                        <p class="text-center medium" ><a class="text-success" href="/forgot-password">Forgot Password?</a></p>
                    </div>
                    <div class="col-sm-7"><!--Sign Up-->
                        <p class="text-center medium">New user Account? <a class="text-success" href="/signup">Sign up here</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</template>

<script>
    export default {
    name: 'app',
        data() {
            return{
                errors: [],
                username: null,
                password: null,
                username_: null,
                password_: null,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods:{
            checkForm(e){
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
            }
        }
    }
</script>

<style>
    .error-boarder {
        border-color: red;
    }
</style>
