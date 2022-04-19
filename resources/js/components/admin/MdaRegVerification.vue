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

            header_1: "Verify MDA Registration",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            AlertMsg: ''
        }
    },
    mounted(){
        const token = this.$route.params.mdatoken;
        var dat = {
                "token": token,
            }
            axios({
            method: 'post',
            data: dat,
            url: 'http://127.0.0.1:8000/api/validate_mda_registration_token',
            headers: { 
                'Content-type': 'application/json; charset=utf-8', 
            },
            responseType: 'json'
            })
            .then(response =>{
                console.log(response.data);
                if(response.data["Message"] == "Valid")
                {
                    //Navigate to New Password Reset for MDAs
                    this.$session.start();
                    this.$session.set('MDAToken', response.data["Hash"]);
                    this.$router.push({ name: 'NewMdaPassword'});
                }
                else
                {
                    this.AlertMsg = '<div id="s_alert" class="alert alert-danger alert-dismissible fade show">' +
                        '<strong><i class="fas fa-times-circle"></i></strong> '+ response.data[""]  +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                }
            })
            .catch(
                console.log("Get Transaction Details Error: ")
            );
    }
}
</script>