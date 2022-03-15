<template>
      <nav class="navbar  bg-success sizer justify-content-center">

  	<div class="btn-group ">
    	<button type="button" class="btn btn-sm btn-success btn-block active"><i class="fa fa-home"></i>
            <router-link class="lo text-white" :to="{ name: 'Dashboard'}">dashboard</router-link>
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
            <router-link class="lo text-white" :to="{ name: 'Buycredit'}">API Documentation</router-link>
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
    	<button type="button" class="btn btn-sm btn-success btn-block dropdown-toggle" data-bs-toggle="dropdown">
		<i class="fas fa-tools"></i>    Settings</button>
      <div class="dropdown-menu" style="font-size:14px">
      	<a class="dropdown-item text-success" href="edit_user_profile.php"><i class="fa fa-pencil-square-o"></i>	Edit User Details</a>
		<div class="dropdown-divider"></div>
      	<a class="dropdown-item text-success" href="change_password.php"><i class="fa fa-key"></i>	Change Password</a>
      </div>
    </div>

    <div class="v-divider"></div>
	
    <form class="form-inline my-2 my-lg-0 ">
           <div class="input-group">                    
                    <input type="text" class="form-control" placeholder="Search" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-light btn-block"><i class="fa fa-search"></i></button>
                    </div>
           </div>
    </form>
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
