<template>
    <div>
        <v-tab
            :class="$vuetify.breakpoint.mdAndUp ? 'pb-8 pt-12' : 'd-inline-block full_height'"
            v-for="(tab,index) of manageTabs"
            :key="tab.name"
            :to="{name:tab.name}"
            :disabled="(index === 0) ? false : true"
        >
            <v-icon left class="hidden-md-and-up">{{tab.icon}}</v-icon>
            <p class="text-capitalize">{{tab.title}}</p>
            <v-icon left class="hidden-md-and-down">{{tab.icon}}</v-icon>
        </v-tab>
        <!--<v-tab :class="$vuetify.breakpoint.mdAndUp ? 'pb-8 pt-12' : 'd-inline-block full_height'" >
            <v-icon left class="hidden-md-and-up">mdi-account-plus</v-icon>
            <p class="text-capitalize">Placement</p>
            <v-icon left class="hidden-md-and-down">mdi-account-plus</v-icon>
        </v-tab>
        <v-tab :class="$vuetify.breakpoint.mdAndUp ? 'pb-8 pt-12' : 'd-inline-block full_height'">
            <v-icon left class="hidden-md-and-up">mdi-lock</v-icon>
            <p class="text-capitalize">Influencer</p>
            <v-icon left class="hidden-md-and-down">mdi-lock</v-icon>
        </v-tab>-->
    </div>
</template>

<script>

    export default {
        components: {

        },
        props : {
            manageTabs:null
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
