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
        <div class="col-sm-10">
            <div class="row" style="position: absolute; right: 8%">
                <div class="col-sm-12">
                    <span v-html="AlertMsg"></span>
                </div>
            </div>
            <h2 style="border-bottom: 1px solid #DDDDDD">{{header_1}}</h2>
            <br />
                <div class="table-wrapper justify-content-center">
                <div style="padding-bottom: 15px; background: #666666; color: #f5f5f5; padding: 20px 30px; margin: -25px -5px 10px; border-radius: 4px 4px 0 0;">
                    <div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <div class="col-xs-6">
                            <center><h2 style="margin: 5px 0 0; font-size: 30px"><b>Registered Users Table</b></h2></center>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-condensed">
                    <thead style="border: 2px solid #5F8575; background-color: #5F8575; color: #FFFFFF; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <tr>
                            <th style="width: 2%">S/No</th>
                            <th style="width: 30%">Organization</th>
                            <th style="width: 10%">Username</th> 
                            <th style="width: 30%">Date Registered</th>
                            <th style="width: 18%">Status</th>
                            <th style="width: 10%">View Details</th>
                        </tr>  
                    </thead> 
                    <tbody v-if="(users) && (users.data.length > 0)">
                        <tr v-for="(user,index) in users.data" :key="index" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; color: #34495E">
                            <td>{{ index + 1}}</td>
                            <td>{{ user.organization_name}}</td>
                            <td>{{ user.username }}</td>
                            <td>{{ user.datetime }}</td>
                            <td v-if="user.is_active == 1">
                                <div class="switch">
                                    <label>
                                        <label>Inactive</label>
                                        <input type="checkbox" :value="user.is_active" checked="checked" @change="onChange($event, user.username)">
                                        <span class="lever"></span><label style="color: green">Active</label>
                                    </label>
                                </div>
                            </td>
                            <td v-else>
                                <div class="switch">
                                    <label>
                                        <label style="color: Red">Inactive</label>
                                        <input type="checkbox" :value="user.is_active"  @change="onChange($event, user.username)">
                                        <span class="lever"></span><label>Active</label>
                                    </label>
                                </div>
                            </td>
                            <td><i class="fas fa-eye text-secondary"></i></td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td align="center" colspan="6">No record found.</td>
                        </tr>
                    </tbody>
                </table>
                <pagination align="center" :data="users" @pagination-change-page="list"></pagination>
                <br />     
            </div>
            <br />     
            <br />
            <br />     
            <br />
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br />
    <center>
        
        <br />
    </center>
    <!-- End of Center -->

</div>
</template>

<script>
import pagination from 'laravel-vue-pagination'
import NavBar from './navigations/ManageUsersNav.vue';
import BootstrapToggle from 'vue-bootstrap-toggle';
import JQuery from 'jquery';
window.$ = JQuery;
import axios from 'axios';
export default {
    data() {
        return {
                users:{
                    type: Object,
                    default: null,
                },
                header_1: "Manage Registered Users",
                count: 0,
                AlertMsg:'',
                update: ''
            }
    },
    props: {
        records: Number,
        perPage: Number,
        length: Number
    },
    components:{
         pagination,
         NavBar,
         BootstrapToggle
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
        }
    },
    created(){
        this.list()
    },
    methods:{
        list(){
            var dat = {
                "username": this.$session.get("username")
                };
            try{
                axios.post('http://127.0.0.1:8000/api/get_users')
                .then(({data}) =>{
                    this.users = data;
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
        },
        onChange(event, tmp){
            this.update = '';
            this.AlertMsg = '';
            var val = event.target.value;
            if(val == 1){
                val = 0;
                this.update = 'The Username <b>' +tmp+ '</b> has been <i>deactivated</i> successfully.';
            }
            else{
                val = 1;
                this.update = 'The Username <b>' +tmp+ '</b> has been <i>activated</i> successfully.';
            }
            var dat = {
                "username": tmp,
                "value": val
                };
            try{
                axios.post('http://127.0.0.1:8000/api/change_user_status', dat)
                .then(response =>{
                    console.log(response.data);
                    if(response.data == "saved."){
                        this.AlertMsg = '<div id="s_alert" class="alert alert-success alert-dismissible fade show">' +
                        '<strong><i class="fas fa-check-circle"></i></strong> ' + this.update +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                    }
                    else{
                        this.AlertMsg = '<div id="s_alert" class="alert alert-danger alert-dismissible fade show">' +
                        '<strong><i class="fas fa-times-circle"></i></strong> Update failed'+
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
            }
            this.list();
        }
    },
    mounted(){
        
    }
}
</script>
<style scoped>
    .pagination{
        margin-bottom: 0;
    }
</style>