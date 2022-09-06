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
        <div class="col-sm-8">
            <h2 style="border-bottom: 1px solid #DDDDDD">{{header_1}}</h2>
            <br />

        </div>
        <div class="col-sm-3"> <!-- Handles User Profile Details and current units -->

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
import NavBar from './navigations/StatisticsNav.vue';
import axios from 'axios'
export default {
    data() {
        return {
                header_1: "Statistics",
                units: 0
            }
    },
    components:{
        NavBar
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
            else{

            }
        }
    },
    methods:{

    },
}
</script>
