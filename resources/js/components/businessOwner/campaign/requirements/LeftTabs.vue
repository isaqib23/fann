<template>
    <div>
        <!--<v-tab >
            Setup
            <v-icon left>mdi-settings</v-icon>
        </v-tab>-->
        <v-tab
            :class="$vuetify.breakpoint.mdAndUp ? 'pb-8 pt-12' : 'd-inline-block full_height'"
        >
            <v-icon left class="hidden-md-and-up">mdi-account-plus</v-icon>
            <p class="text-capitalize">Create</p>
            <v-icon left class="hidden-md-and-down">mdi-account-plus</v-icon>
        </v-tab>
        <v-tab
            :class="$vuetify.breakpoint.mdAndUp ? 'pb-8 pt-12' : 'd-inline-block full_height'"
            :disabled="savedTouchPoints.length == 0"
        >
            <v-icon left class="hidden-md-and-up">mdi-lock</v-icon>
            <p class="text-capitalize">invite</p>
            <v-icon left class="hidden-md-and-down">mdi-lock</v-icon>
        </v-tab>
        <v-tab
            :class="$vuetify.breakpoint.mdAndUp ? 'pb-8 pt-12' : 'd-inline-block full_height'"
            :disabled="savedTouchPoints.length == 0"
        >
            <v-icon left class="hidden-md-and-up">mdi-access-point</v-icon>
            <p class="text-capitalize">promote</p>
            <v-icon left class="hidden-md-and-down">mdi-access-point</v-icon>
        </v-tab>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    export default {
        components: {

        },
        data: () => {
           return  {

            }
        },
        computed: {
            ...mapGetters({
                savedTouchPoints    : 'campaign/savedTouchPoints'
            })
        },
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
