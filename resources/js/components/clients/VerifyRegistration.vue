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
        <div class="col-sm-8">
            <h2 style="border-bottom: 1px solid #DDDDDD">{{header_1}}</h2>
            <br />
            <!-- -------------------------------------------------------------
            Main Stuff Here
            -------------------------------------------------------------- -->

            <br />

            <br />
            <div class="row">
                <div class="col-sm-12">
                    <span v-html="AlertMsg"></span>
                </div>
            </div>

        </div>
        <div class="col-sm-3">
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
import axios from 'axios';
export default {
    data() {
        return {

            header_1: "Verify Registration",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            AlertMsg: ''
        }
    },
    beforeCreate() {
        const token = this.$route.params.token;
        var dat = {
                "token": token,
            }
        try{
            axios({
            method: 'post',
            data: dat,
            url: 'http://127.0.0.1:8000/api/validate_registration_token',
            headers: { 
                'Content-type': 'application/json; charset=utf-8', 
            },
            responseType: 'json'
            })
            .then(response =>{
                if(response.data == "Valid")
                {
                    this.AlertMsg = '<div id="s_alert" class="alert alert-success alert-dismissible fade show">' +
                        '<strong><i class="fas fa-check-circle"></i></strong> You have successfully verified your email. Click <b><a class="text-success" href="/"> here </a></b>' +
                        'and login with your credentials created earlier.'
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                }
                else
                {
                    this.AlertMsg = '<div id="s_alert" class="alert alert-danger alert-dismissible fade show">' +
                        '<strong><i class="fas fa-times-circle"></i></strong> '+ response.data  +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                }
            })
            .catch(
                console.log("Get Transaction Details Error: ")
            );
        }
        finally{
            return;
        }
    }
}
</script>