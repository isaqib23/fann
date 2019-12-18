<template>
    <v-row class="mx-auto main_wrapper">
        <v-flex class="full_height" v-bind:class="paneClass">
            <v-card fluid grid-list-md v-bind:class="cardClass">
                <v-tabs v-model="active_tab"
                        :vertical="$vuetify.breakpoint.mdAndUp ? true : false"
                        :centered="$vuetify.breakpoint.mdAndUp ? false : true"
                        :active-class="$vuetify.breakpoint.mdAndUp ? 'active_tab' : 'active_tab_sm'"
                        flat icons-and-text background-color="decent" color="gutter">
                    <LeftTabs></LeftTabs>

                    <v-tab-item>
                        <CreateLeftPane></CreateLeftPane>
                    </v-tab-item>
                    <v-tab-item>
                        <InviteLeftPane></InviteLeftPane>
                    </v-tab-item>
                    <v-tab-item class="full_width">
                        <Promote></Promote>
                    </v-tab-item>
                </v-tabs>
            </v-card>
        </v-flex>
        <v-flex xl8 lg8 md8 sm12 xs12 class="right-panes "
           :class="active_tab == 0 ? 'custom-padding' : ''"
        >
            <!--<SetupRightPane v-if="active_tab == 0"></SetupRightPane>-->
            <CreateRightPane v-if="active_tab == 0"></CreateRightPane>
            <InviteRightPaneListView v-if="active_tab == 1"></InviteRightPaneListView>
        </v-flex>
    </v-row>
</template>

<script>
    import LeftTabs from './requirements/LeftTabs';
    import CreateLeftPane from './requirements/CreateLeftPane';
    import InviteLeftPane from './requirements/InviteLeftPane';
    import CreateRightPane from './requirements/CreateRightPane';
    import InviteRightPaneListView from './requirements/InviteRightPaneListView';
    import InviteRightPaneGridView from './requirements/InviteRightPaneGridView';
    import Promote from './requirements/Promote';
    import {mapActions, mapGetters} from 'vuex';
    export default {
        components: {
            LeftTabs: LeftTabs,
            CreateLeftPane: CreateLeftPane,
            InviteLeftPane: InviteLeftPane,
            CreateRightPane: CreateRightPane,
            InviteRightPaneListView: InviteRightPaneListView,
            InviteRightPaneGridView: InviteRightPaneGridView,
            Promote: Promote
        },
        created() {
            if (!localStorage.hasOwnProperty("touchPoint")) {
                localStorage.setItem('touchPoint', JSON.stringify(this.touchPoint));
            }
        },
        mounted() {
            this.campaignObjective = Object.assign(this.campaignObjective, this.objective)
            this.campaignPlacement = Object.assign(this.campaignPlacement, this.placement)
          /*  if (this.objective == null) {
                this.$router.push({name: 'create-campaign-objective'})
            }

            if (this.placement == null) {
                this.$router.push({name: 'create-campaign-placement'})
            }*/
        },
        data ()  {
           return  {
               active_tab         : 0,
               campaignObjective  : {
                   ObjectiveId    : null,
                   slug           : null,
                   name           : null
               },
               campaignPlacement : {
                   platform      : null,
                   type          : null
               }
            }
        },
        methods: {
            ...mapActions({
                getCountries: 'settings/getCountries',
                getNiches: 'settings/getNiches',
            }),
        },
        computed: {
            paneClass: function() {
                return (this.active_tab == 2) ? 'lg12 sm12 xl12 md4 xs12' : 'xl4 lg4 md4 sm12 xs12';
            },
            cardClass: function() {
                return (this.active_tab == 2) ? 'full_width' : 'full_width';
            },
            ...mapGetters({
                objective   : 'campaign/campaignObjective',
                placement   : 'campaign/campaignPlacement',
                touchPoint  : 'campaign/touchPoint'
            })
        },
        async mounted() {
            await this.getNiches();
            await this.getCountries();
        }
    }
</script>

<style scoped>
    .main_wrapper{
        background: #F4F7FD !important;
    }
    .full_heights{
        max-height: 100vh !important;
        min-height: 100vh !important;
        overflow-y: scroll !important;
    }
    @media only screen
    and (min-device-width: 960px)
    and (max-device-width: 1366px)
    and (-webkit-min-device-pixel-ratio: 1) {
        .custom-padding{
            padding-left: 48px !important;
        }
    }
</style>
