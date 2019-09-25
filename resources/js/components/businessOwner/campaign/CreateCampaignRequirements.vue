<template>
    <v-row class="mx-auto main_wrapper">
        <v-flex class="panes-container full_height" v-bind:class="paneClass">
            <v-card fluid grid-list-md v-bind:class="cardClass">
                <v-tabs v-model="active_tab" vertical flat icons-and-text active-class="active_tab" background-color="decent" color="gutter">
                    <LeftTabs></LeftTabs>

                    <v-tab-item>
                        <SetupLeftPane></SetupLeftPane>
                    </v-tab-item>
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
        <v-flex lg8 sm6 xl8 md7 xs12 class="right-panes">
            <SetupRightPane v-if="active_tab == 0"></SetupRightPane>
            <CreateRightPane v-if="active_tab == 1"></CreateRightPane>
            <InviteRightPaneListView v-if="active_tab == 2"></InviteRightPaneListView>
        </v-flex>
    </v-row>
</template>

<script>
    import LeftTabs from './requirements/LeftTabs';
    import SetupLeftPane from './requirements/SetupLeftPane';
    import CreateLeftPane from './requirements/CreateLeftPane';
    import InviteLeftPane from './requirements/InviteLeftPane';
    import SetupRightPane from './requirements/SetupRightPane';
    import CreateRightPane from './requirements/CreateRightPane';
    import InviteRightPaneListView from './requirements/InviteRightPaneListView';
    import InviteRightPaneGridView from './requirements/InviteRightPaneGridView';
    import Promote from './requirements/Promote';
    export default {
        components: {
            LeftTabs: LeftTabs,
            SetupLeftPane: SetupLeftPane,
            CreateLeftPane: CreateLeftPane,
            InviteLeftPane: InviteLeftPane,
            SetupRightPane: SetupRightPane,
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
                return (this.active_tab == 3) ? 'lg12 sm12 xl12 md12 xs12' : 'lg4 sm6 xl4 md5 xs12';
            },
            cardClass: function() {
                return (this.active_tab == 3) ? 'full_width' : 'full_width';
            }
        }
    }
</script>

<style scoped>
    .main_wrapper{
        background: #F4F7FD !important;
    }
    .full_height{
        max-height: 100vh !important;
        min-height: 100vh !important;
        overflow-y: scroll !important;
    }
    .full_height::-webkit-scrollbar {
        width: 6px;
        background-color: #F5F5F5;
    }
    .full_height::-webkit-scrollbar-thumb {
        background-color: #EE6F6F;
    }
    .full_height::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }
</style>
