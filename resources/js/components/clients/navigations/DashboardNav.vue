<template>
      <nav class="navbar  bg-success sizer d-flex justify-content-center">

  	<div class="btn-group ">
    	<button type="button" class="btn btn-sm btn-success btn-block active"><i class="fa fa-home"></i>
            <router-link class="lo text-white" :to="{ name: 'Dashboard'}">Dashboard</router-link>
		</button>
    </div>

    <span class="v-divider"></span>

    <div class="btn-group ">
    	<button type="button" class="btn btn-sm btn-success btn-block"><i class="far fa-credit-card"></i>
            <router-link class="lo text-white" :to="{ name: 'Buycredit'}">Buy Credit</router-link>
		</button>
    </div>
	
    <span class="v-divider"></span>

    <div class="btn-group ">
    	<button type="button" class="btn btn-sm btn-success btn-block"><i class="fas fa-file-pdf"></i>
            <router-link class="lo text-white" :to="{ name: 'Documentation'}">API Documentation</router-link>
		</button>
    </div>

    <div class="v-divider"></div>

    <div class="btn-group d-flex">
    	<button type="button" class="btn btn-sm btn-success btn-block"><i class="fas fa-history"></i>	
            <router-link class="lo text-white" :to="{ name: 'Transactions'}">Transaction History</router-link>
        </button>
    </div>

    <div class="v-divider"></div>

    <div class="btn-group d-flex">
    	<button type="button" class="btn btn-sm btn-success btn-block"><i class="fas fa-eye"></i>	
            <router-link class="lo text-white" :to="{ name: 'APIHistory'}">View API Calls Log</router-link>
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
