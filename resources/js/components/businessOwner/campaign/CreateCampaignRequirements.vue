<template>
    <div>
        <v-flex>
            <v-layout class="panes-container full_height" v-bind:class="paneClass">
                <v-card fluid grid-list-md v-bind:class="cardClass">
                    <v-tabs v-model="active_tab" vertical flat icons-and-text active-class="active_tab" background-color="decent" color="gutter">
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
            </v-layout>
            <v-layout column class="right-pane">
                <CreateRightPane v-if="active_tab == 0"></CreateRightPane>
                <InviteRightPane v-if="active_tab == 1"></InviteRightPane>
            </v-layout>
        </v-flex>
    </div>
</template>

<script>
    import LeftTabs from './requirements/LeftTabs';
    import CreateLeftPane from './requirements/CreateLeftPane';
    import InviteLeftPane from './requirements/InviteLeftPane';
    import CreateRightPane from './requirements/CreateRightPane';
    import InviteRightPane from './requirements/InviteRightPane';
    import Promote from './requirements/Promote';
    export default {
        components: {
            LeftTabs: LeftTabs,
            CreateLeftPane: CreateLeftPane,
            InviteLeftPane: InviteLeftPane,
            CreateRightPane: CreateRightPane,
            InviteRightPane: InviteRightPane,
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
                return (this.active_tab == 2) ? 'full_width' : 'left-pane';
            },
            cardClass: function() {
                return (this.active_tab == 2) ? 'full_width' : '';
            }
        }
    }
</script>

<style scoped>

</style>
