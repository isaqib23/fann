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
        <v-flex xl8 lg8 md12 sm12 xs12 class="right-panes">
            <!--<SetupRightPane v-if="active_tab == 0"></SetupRightPane>-->
            <CreateRightPane v-if="active_tab == 0"></CreateRightPane>
            <InviteRightPaneListView v-if="active_tab == 1"></InviteRightPaneListView>
        </v-flex>
    </v-row>
</template>

<script>
    import LeftTabs from './requirements/LeftTabs';
    //import SetupLeftPane from './requirements/SetupLeftPane';
    import CreateLeftPane from './requirements/CreateLeftPane';
    import InviteLeftPane from './requirements/InviteLeftPane';
    //import SetupRightPane from './requirements/SetupRightPane';
    import CreateRightPane from './requirements/CreateRightPane';
    import InviteRightPaneListView from './requirements/InviteRightPaneListView';
    import InviteRightPaneGridView from './requirements/InviteRightPaneGridView';
    import Promote from './requirements/Promote';
    export default {
        components: {
            LeftTabs: LeftTabs,
            //SetupLeftPane: SetupLeftPane,
            CreateLeftPane: CreateLeftPane,
            InviteLeftPane: InviteLeftPane,
            //SetupRightPane: SetupRightPane,
            CreateRightPane: CreateRightPane,
            InviteRightPaneListView: InviteRightPaneListView,
            InviteRightPaneGridView: InviteRightPaneGridView,
            Promote: Promote
        },
        data: () => {
           return  {
               active_tab: 0
            }
        },
        methods: {},
        computed: {
            paneClass: function() {
                return (this.active_tab == 2) ? 'lg12 sm12 xl12 md12 xs12' : 'xl4 lg4 md12 sm12 xs12';
            },
            cardClass: function() {
                return (this.active_tab == 2) ? 'full_width' : 'full_width';
            }
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
</style>
