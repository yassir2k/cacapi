<template>
<div>
    <div class="row">
        <div class="col-sm-12">
            <NavBar /> 
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
            <div class="card bg-white mb-12 shadow-sm" style="border-radius: 0.5em; border-bottom: 1px solid #50C878">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <center><i class="fa fa-user fa-5x text-secondary"></i></center>
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <center><h2>Hi, Yassir </h2></center>
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>
                    <h2 class="card-text"><b class="text-secondary">PROFILE SUMMARY</b></h2>
                    <hr class="separator">
                    <!-- The actual Summary -->
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3">
                            <h3>Current Balance (&#8358;):</h3>
                        </div>
                        <div class="col-sm-3">
                            <h3>20,000</h3>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3">
                            <h3>Total API Calls Made:</h3>
                        </div>
                        <div class="col-sm-3">
                            <h3>20,000</h3>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3">
                            <h3>Total Credit Spent (&#8358;):</h3>
                        </div>
                        <div class="col-sm-3">
                            <h3>20,000,000</h3>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                    <br />
                </div>
            </div>
            <br />
        </div>
        <div class="col-sm-1">
        </div>
    </div>
</div>
</template>
<script>

import NavBar from './DashboardNav.vue';
export default {
    setup() {
        
    },
    components:{
        NavBar
    },
}
</script>
