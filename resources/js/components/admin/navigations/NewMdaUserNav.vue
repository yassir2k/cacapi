<template>
      <nav class="navbar  bg-success sizer d-flex justify-content-center">

  	<div class="btn-group ">
    	<button type="button" class="btn btn-sm btn-success btn-block"><i class="fa fa-home"></i>
            <router-link class="lo text-white" :to="{ name: 'AdminDashboard'}">Dashboard</router-link>
		</button>
    </div>

    <span class="v-divider"></span>

    <div class="btn-group ">
    	<button type="button" class="btn btn-sm btn-success btn-block"><i class="fas fa-users-cog"></i>
            <router-link class="lo text-white" :to="{ name: 'ManageRegisteredUsers'}">Manage Registered Users</router-link>
		</button>
    </div>

    <span class="v-divider"></span>

    <div class="btn-group ">
    	<button type="button" class="btn btn-sm btn-success btn-block active"><i class="fas fa-user-plus"></i>
            <router-link class="lo text-white" :to="{ name: 'CreateMdaUser'}">Create New MDA User</router-link>
		</button>
    </div>
	
    <span class="v-divider"></span>

    <div class="btn-group ">
    	<button type="button" class="btn btn-sm btn-success btn-block"><i class="fas fa-chart-line"></i>
            <router-link class="lo text-white" :to="{ name: 'Documentation'}">Statistics</router-link>
		</button>
    </div>

	<div class="v-divider"></div>
	
    <div class="btn-group d-flex">
    	<button type="button" class="btn btn-sm btn-success btn-block dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-user-cog"></i>	
            User Settings
        </button>
        <div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="font-size:14px">
            <router-link class="dropdown-item lo text-success" :to="{ name: 'EditUserProfile'}"><i class="fas fa-user-edit "></i> Edit User Profile</router-link>
            <div class="dropdown-divider"></div>
            <router-link class="dropdown-item lo text-success" :to="{ name: 'ChangeUserPassword'}"><i class="fas fa-unlock-alt "></i> Change User Password</router-link>
        </div>
    </div>

	<div class="v-divider"></div>

    <div class="btn-group d-flex">
    	<button type="button" class="btn btn-success btn-sm btn-block" v-on:click="Logout"><i class="fas fa-sign-out-alt"></i>
			Logout
		</button>
    </div>

   </nav>
</template>
<script>
export default {
    methods:{
        Logout(){
            this.$session.destroy();
            this.$router.push('/');
        }
    }
}
</script>
<style>
.sizer{
    font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; 
    font-size:10px;
}
.green{
    color: #8FBC8F
}
.green2{
    color: #28B463
}
</style>
