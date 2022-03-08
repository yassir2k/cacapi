<template>
      <nav class="navbar  bg-success sizer justify-content-center">

  	<div class="btn-group ">
    	<button type="button" class="btn btn-sm btn-success btn-block"><i class="fa fa-home"></i>
            <router-link class="lo text-white" to="dashboard">dashboard</router-link>
		</button>
    </div>

    <span class="v-divider"></span>

    <div class="btn-group ">
    	<button type="button" class="btn btn-sm btn-success btn-block active"><i class="fas fa-money-check-alt"></i>
            <router-link class="lo text-white" to="dashboard">Buy Credit</router-link>
		</button>
    </div>

    <span class="v-divider"></span>
	
	<div class="btn-group d-flex">
    	<button type="button" class="btn btn-sm btn-success btn-block dropdown-toggle" data-bs-toggle="dropdown">
		<!-- <i class="fas fa-file-signature"></i> --> <i class="fas fa-comments"></i>	Feedbacks</button>
    <div class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu" style="font-size:14px">
        <div class="dropdown-submenu">
      	    <a class="dropdown-item text-success" href=""><i class="fas fa-calendar-day "></i>	Today</a>
            <!-- Submenu For Dropdown-->
                <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
                    <a class="dropdown-item green" href="/admin/todays-records"><i class="fas fa-clipboard-list"></i>	Total Feedback</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item green" href="/admin/todays-records-accredited-users"><i class="fas fa-user-tag"></i>	From Accredited Users</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item green" href="/admin/todays-records-public-users"><i class="fas fa-users"></i>	From Public Users</a>
                  </div>
            <!-- End of Submeny For Dropdown-->
        </div>
		<div class="dropdown-divider"></div>

        <div class="dropdown-submenu">
            <a class="dropdown-item text-success" href="#"><i class="fas fa-calendar-alt "></i>	Select a Date</a>
            <!-- Submenu For Dropdown-->
                <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
                    <a class="dropdown-item green" href="/admin/total-records-with-date"><i class="fas fa-clipboard-list"></i>	For Total Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item green" href="/admin/accredited-users-records-with-date"><i class="fas fa-user-tag"></i>	For Feedbacks From Accredited Users</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item green" href="/admin/public-users-records-with-date"><i class="fas fa-users"></i>	For Feedbacks From Public Users</a>
                </div>
            <!-- End of Submeny For Dropdown-->
        </div>
        <div class="dropdown-divider"></div>

        <div class="dropdown-submenu">
            <a class="dropdown-item text-success" href="#"><i class="fas fa-calendar-week "></i>	Select a Date Range</a>
            <!-- Submenu For Dropdown-->
                <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
                    <a class="dropdown-item green" href="/admin/total-records-with-date-range"><i class="fas fa-clipboard-list"></i>	For Total Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item green" href="/admin/accredited-users-records-with-date-range"><i class="fas fa-user-tag"></i>	For Feedbacks From Accredited Users</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item green" href="/admin/public-users-records-with-date-range"><i class="fas fa-users"></i>	For Feedbacks From Public Users</a>
                </div>
            <!-- End of Submeny For Dropdown-->
        </div>
        <div class="dropdown-divider"></div>
            <div class="dropdown-submenu">
                <a class="dropdown-item text-success" href="#"><i class="fas fa-history "></i>	From Beginning (Absolute)</a>
                <!-- Submenu For Dropdown-->
                <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
                    <a class="dropdown-item green" href="/admin/absolute-records"><i class="fas fa-clipboard-list"></i>	For Total Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item green" href="/admin/absolute-records-accredited-users"><i class="fas fa-user-tag"></i>	For Feedbacks From Accredited Users</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item green" href="/admin/absolute-records-public-users"><i class="fas fa-users"></i>	For Feedbacks From Public Users</a>
                </div>
            <!-- End of Submeny For Dropdown-->
            </div>
      </div>
    </div>
	<div class="v-divider"></div>
	
    <div class="btn-group d-flex">
    	<button type="button" class="btn btn-sm btn-success btn-block dropdown-toggle" data-bs-toggle="dropdown">
		<i class="fas fa-comments"></i>&nbsp;<i class="fas fa-chart-bar"></i>	Feedbacks Statistics</button>
    <div class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu" style="font-size:14px">
        <div class="dropdown-submenu">
      	    <a class="dropdown-item text-success" href=""><i class="fas fa-calendar-day "></i>	Today's</a>
            <!-- Submenu For Dropdown-->
                <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
                    <a class="dropdown-item green" href="#"><i class="fas fa-clipboard-list"></i>	Total Feedback</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item green" href="#"><i class="fas fa-user-tag"></i>	From Accredited Users</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item green" href="#"><i class="fas fa-users"></i>	From Public Users</a>
                  </div>
            <!-- End of Submeny For Dropdown-->
        </div>
		<div class="dropdown-divider"></div>

        <div class="dropdown-submenu">
            <a class="dropdown-item text-success" href="#"><i class="fas fa-calendar-alt "></i>	For a Selected Date</a>
            <!-- Submenu For Dropdown-->
                <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
                    <a class="dropdown-item green" href="#"><i class="fas fa-clipboard-list"></i>	For Total Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item green" href="#"><i class="fas fa-user-tag"></i>	For Feedbacks From Accredited Users</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item green" href="#"><i class="fas fa-users"></i>	For Feedbacks From Public Users</a>
                </div>
            <!-- End of Submeny For Dropdown-->
        </div>
        <div class="dropdown-divider"></div>

        <div class="dropdown-submenu">
            <a class="dropdown-item text-success" href="#"><i class="fas fa-calendar-week "></i>	For a Given Date Range</a>
            <!-- Submenu For Dropdown-->
                <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
                    <a class="dropdown-item green" href="#"><i class="fas fa-clipboard-list"></i>	For Total Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item green" href="#"><i class="fas fa-user-tag"></i>	For Feedbacks From Accredited Users</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item green" href="#"><i class="fas fa-users"></i>	For Feedbacks From Public Users</a>
                </div>
            <!-- End of Submeny For Dropdown-->
        </div>
        <div class="dropdown-divider"></div>
            <div class="dropdown-submenu">
                <a class="dropdown-item text-success" href="#"><i class="fas fa-history "></i>	For Absolute Records</a>
                <!-- Submenu For Dropdown-->
                <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
                    <a class="dropdown-item green" href="#"><i class="fas fa-clipboard-list"></i>	For Total Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item green" href="#"><i class="fas fa-user-tag"></i>	For Feedbacks From Accredited Users</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item green" href="#"><i class="fas fa-users"></i>	For Feedbacks From Public Users</a>
                </div>
            <!-- End of Submeny For Dropdown-->
            </div>
      </div>
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
    	<button type="button" class="btn btn-success btn-sm btn-block" href="signout.php"><i class="fas fa-sign-out-alt"></i>
			<a class="lo text-white" href="signout.php">Logout</a>
		</button>
    </div>

   </nav>
</template>
<script>
export default {
    setup() {
        
    },
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
