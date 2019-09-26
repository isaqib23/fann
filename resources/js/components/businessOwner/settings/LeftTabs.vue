<template>
    <div>
        <v-tab >
            Business Profile
            <v-icon left>mdi-account</v-icon>
        </v-tab>
        <v-tab >
            Billing & Payment
            <v-icon left>mdi-account-plus</v-icon>
        </v-tab>
        <v-tab>
            Integrations
            <v-icon left>mdi-lock</v-icon>
        </v-tab>
    </div>
</template>

<script>
    export default {
        components: {

        },
        data: () => {
           return  {

            }
        },
        methods: {}
    }
</script>

<style scoped>
    >>>.v-tabs-items, >>>.v-card{
        background-color:#F7F7FF !important;
    }
    >>>.v-card{
        box-shadow:none !important;
    }
     .full_height {
        height: 100% !important;
    }

    v-tabs {
        height:100%;
    }
    .v-tabs > .v-tabs-bar {
        margin: 0 0 0 -14px !important;
        background: #403C79 !important;
        height: 100% !important;
        display: block !important;
        border-radius:0px !important;
    }
    .active_tab {
        color:black !important;
        background: #F7F7FF !important;
        border-left: 3px solid #EE6F6F;
    }
    .theme--light.v-tabs>.v-tabs-bar .v-tab--disabled, .theme--light.v-tabs>.v-tabs-bar .v-tab:not(.v-tab--active), .theme--light.v-tabs>.v-tabs-bar .v-tab:not(.v-tab--active) > .v-icon {
        color:#A5A4BF !important;
    }

</style>
