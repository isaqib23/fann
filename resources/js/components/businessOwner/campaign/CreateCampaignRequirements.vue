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

                    <!--<v-tab-item>
                        <SetupLeftPane></SetupLeftPane>
                    </v-tab-item>-->
                    <v-tab-item>
                        <UnboxingCampaign :objective="campaignObjective" :touch-point="touchPoint" v-if="campaignObjective.ObjectiveId == 1"></UnboxingCampaign>
                        <productReview :objective="campaignObjective" :touch-point="touchPoint" v-else-if="campaignObjective.ObjectiveId == 2"></productReview>
                        <contestsGiveways :objective="campaignObjective" :touch-point="touchPoint" v-else-if="campaignObjective.ObjectiveId == 3"></contestsGiveways>
                        <brandShoutOut :objective="campaignObjective" :touch-point="touchPoint" v-else-if="campaignObjective.ObjectiveId == 4 || campaignObjective.id == 5"></brandShoutOut>
                        <SponsoredContent :objective="campaignObjective" :touch-point="touchPoint" v-else-if="campaignObjective.ObjectiveId == 6"></SponsoredContent>

                        <CreateLeftPane v-else></CreateLeftPane>
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
    import UnboxingCampaign from './requirements/objectiveSelection/UnboxingCampaign';
    import contestsGiveways from './requirements/objectiveSelection/contestsGiveways';
    import productReview from './requirements/objectiveSelection/productReview';
    import brandShoutOut from './requirements/objectiveSelection/brandShoutOut';
    import SponsoredContent from './requirements/objectiveSelection/SponsoredContent';
    import InviteLeftPane from './requirements/InviteLeftPane';
    import CreateRightPane from './requirements/CreateRightPane';
    import InviteRightPaneListView from './requirements/InviteRightPaneListView';
    import InviteRightPaneGridView from './requirements/InviteRightPaneGridView';
    import Promote from './requirements/Promote';
    import {mapGetters} from 'vuex';
    export default {
        components: {
            LeftTabs: LeftTabs,
            CreateLeftPane: CreateLeftPane,
            UnboxingCampaign: UnboxingCampaign,
            contestsGiveways: contestsGiveways,
            productReview: productReview,
            InviteLeftPane: InviteLeftPane,
            CreateRightPane: CreateRightPane,
            InviteRightPaneListView: InviteRightPaneListView,
            InviteRightPaneGridView: InviteRightPaneGridView,
            Promote: Promote,
            brandShoutOut: brandShoutOut,
            SponsoredContent: SponsoredContent
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
               active_tab: 0,
               campaignObjective: {
                   ObjectiveId:null,
                   slug:null,
                   name:null
               },
               campaignPlacement:{
                   platform:null,
                   type:null
               },
               touchPoint : {
                   caption: null,
                   hashtags: null,
                   mentions: null,
                   guideLines : [],
                   dispatchProduct : {},
                   barterProduct : {},
                   amount : 0,
                   campaignDescription : null,
                   images : [],
                   instaPost : null,
                   instaBioLink : null,
                   instaStory : null,
                   instaStoryLink : null,
               },
            }
        },
        methods: {},
        computed: {
            paneClass: function() {
                return (this.active_tab == 2) ? 'lg12 sm12 xl12 md4 xs12' : 'xl4 lg4 md4 sm12 xs12';
            },
            cardClass: function() {
                return (this.active_tab == 2) ? 'full_width' : 'full_width';
            },
            ...mapGetters({
                objective: 'campaign/campaignObjective',
                placement: 'campaign/campaignPlacement'
            })
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
