<template>
    <div>
        <v-flex>
            <v-layout class="panes-container full_height left-pane">
                <v-card fluid grid-list-md>

                    <v-tabs v-model="active_tab" vertical flat icons-and-text active-class="active_tab" background-color="decent" color="gutter" >
                        <LeftTabs></LeftTabs>

                        <v-tab-item>
                            <CreateLeftPane></CreateLeftPane>
                        </v-tab-item>
                        <v-tab-item>
                            <InviteLeftPane></InviteLeftPane>
                        </v-tab-item>
                        <v-tab-item>
                            <v-card>
                                <v-card-text>
                                    <p>
                                        Fusce a quam. Phasellus nec sem in justo pellentesque facilisis. Nam eget dui. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In dui magna, posuere eget, vestibulum et, tempor auctor, justo.
                                    </p>

                                    <p class="mb-0">
                                        Cras sagittis. Phasellus nec sem in justo pellentesque facilisis. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nam at tortor in tellus interdum sagittis.
                                    </p>
                                </v-card-text>
                            </v-card>
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
    export default {
        components: {
            LeftTabs: LeftTabs,
            CreateLeftPane: CreateLeftPane,
            InviteLeftPane: InviteLeftPane,
            CreateRightPane: CreateRightPane,
            InviteRightPane: InviteRightPane
        },
        data: () => {
           return  {
               active_tab: 0
            }
        },
        methods: {}
    }
</script>

<style scoped>

</style>
