<template>
    <div>
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

</div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {

            header_1: "Signup",
            units: 0,
            freeze: false,
            rotor: '&nbsp;<i class="fas fa-save"></i>',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    components:{
         
    },
    beforeCreate: function () {
        //Get Realtime Units
        var postData = {
                    "accountNumber": "0069598659"
                }
        try{
            axios.post("https://sterlingonline.sterlingbankng.com/moneytor-service/api/v1/onboarding/name_enquiry", postData) 
            .then(response =>{
                console.log(response);
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

    },
    methods:{
        SignUp(){

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