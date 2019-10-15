<template>
    <div>
        <v-tab :class="$vuetify.breakpoint.mdAndUp ? 'pb-8 pt-12' : 'd-inline-block full_height text-center'">
            <v-icon left class="hidden-md-and-up">mdi-account</v-icon>
            <p class="text-capitalize">Business Profile</p>
            <v-icon left class="hidden-md-and-down">mdi-account</v-icon>
        </v-tab>
        <v-tab :class="$vuetify.breakpoint.mdAndUp ? 'pb-8 pt-12' : 'd-inline-block full_height text-center'">
            <v-icon left class="hidden-md-and-up">mdi-credit-card-outline mdi-rotate-45</v-icon>
            <p class="text-capitalize">Billing & Payment</p>
            <v-icon left class="hidden-md-and-down">mdi-credit-card</v-icon>
        </v-tab>
        <v-tab :class="$vuetify.breakpoint.mdAndUp ? 'pb-8 pt-12' : 'd-inline-block full_height text-center'">
            <v-icon left class="hidden-md-and-up">mdi-lock</v-icon>
            <p class="text-capitalize">Integrations</p>
            <v-icon left class="hidden-md-and-down">mdi-lock</v-icon>
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
    }
    .active_tab_sm {
        color:black !important;
        background: #F7F7FF !important;
        border-top: 3px solid #EE6F6F;
        line-height: 1;
        padding-top: 12px;
        padding-left: 25px;
    }
    .theme--light.v-tabs>.v-tabs-bar .v-tab--disabled, .theme--light.v-tabs>.v-tabs-bar .v-tab:not(.v-tab--active), .theme--light.v-tabs>.v-tabs-bar .v-tab:not(.v-tab--active) > .v-icon {
        color:#A5A4BF !important;
    }

</style>
