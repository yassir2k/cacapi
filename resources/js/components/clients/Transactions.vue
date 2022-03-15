<template>
    <div>
    <div class="row">
        <div class="col-sm-12">
             
        </div>
    </div>
    <br />
    <br />
    <!-- Beginning of Center -->
    <center>
        <div class="table-wrapper justify-content-center">
            <div style="padding-bottom: 15px; background: #717D7E; color: #f5f5f5; padding: 20px 30px; margin: -25px -5px 10px; border-radius: 4px 4px 0 0;">
                <div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
                    <div class="col-xs-6">
                        <h2 style="margin: 5px 0 0; font-size: 30px"><b>Today's Records</b></h2>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-condensed">
                <thead style="background-color: #AAB7B8; color: #FFFFFF; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
                    <tr>
                        <th>Name</th>
                        <th>Profession</th>
                        <th>Accreditation Number (if any)</th> 
                        <th>Feedback Date</th>
                        <th>Action</th>
                    </tr>  
                </thead> 
                <tbody v-if="(users) && (users.data.length > 0)">
                    <tr v-for="(user,index) in users.data" :key="index" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; color: #34495E">
                        <td>{{ user.name_ }}</td>
                        <td>{{ user.profession_ }}</td>
                        <td>{{ user.accreditation_ }}</td>
                        <td>{{ user.date_ }}</td>
                        <td><a href="#" data-bs-toggle="tooltip" title="View"><i class="fas fa-eye text-secondary"></i></a></td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td align="center" colspan="5">No record found.</td>
                    </tr>
                </tbody>
            </table>
            <pagination align="center" :data="users" @pagination-change-page="list"></pagination>
            <br />     
            <br />
            <div id="ll" v-html="LoadView"></div>
        </div>
        <br />
    </center>
    <!-- End of Center -->

</div>
</template>

<script>
import pagination from 'laravel-vue-pagination';
import axios from 'axios';
export default {
    data() {
        return {
                users:{
                    type: Object,
                    default: null,
                },
                LoadView: ''
            }
    },
    props: {
        records: Number,
        perPage: Number,
        length: Number
    },
    components:{
         pagination
    },
    created(){
        this.list()
    },
    methods:{
        list(page=0){
            try{
                var data = new TextEncoder().encode(JSON.stringify({
                'username': "firs",
                }));
                axios({
                method: 'get',
                url: `http://127.0.0.1:8000/api/transaction_history?page=${page}`,
                data: data,
                headers: { 
                    'Content-type': 'application/json; charset=utf-8', 
                },
                responseType: 'json'
                })
                .then(({response})=>{
                    console.log(response);
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
        }
    },
}
</script>
<style scoped>
    .pagination{
        margin-bottom: 0;
    }
</style>