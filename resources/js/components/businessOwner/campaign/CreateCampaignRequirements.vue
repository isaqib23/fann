<template>
    <div>
        <v-flex>
            <v-layout class="panes-container full_height">
                <div class="left-pane" >
                    <v-card>

                        <v-tabs vertical flat icons-and-text active-class="active_tab" background-color="decent" color="gutter" >
                            <v-tab >
                                Create
                                <v-icon left>mdi-account-plus</v-icon>
                            </v-tab>
                            <v-tab>
                                <v-icon left>mdi-lock</v-icon>
                                Option 2
                            </v-tab>
                            <v-tab>
                                <v-icon left>mdi-access-point</v-icon>
                                Option 3
                            </v-tab>

                            <v-tab-item>
                                <div class="elevation-3 mx-auto pa-6 transition-swing" >
                                    Class based elevation
                                </div>

                                <v-col cols="12" sm="6" md="3" >
                                    <v-card>
                                        <p>
                                            Sed aliquam ultrices mauris. Donec posuere vulputate arcu. Morbi ac felis. Etiam
                                            feugiat lorem non metus. Sed a libero.
                                        </p>

                                        <p>
                                            Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Aenean tellus
                                            metus, bibendum sed, posuere ac, mattis non, nunc. Aliquam lobortis. Aliquam
                                            lobortis. Suspendisse non nisl sit amet velit hendrerit rutrum.
                                        </p>

                                        <p class="mb-0">
                                            Phasellus dolor. Fusce neque. Fusce fermentum odio nec arcu. Pellentesque libero
                                            tortor, tincidunt et, tincidunt eget, semper nec, quam. Phasellus blandit leo ut
                                            odio.
                                        </p>
                                    </v-card>
                                </v-col>


                            </v-tab-item>
                            <v-tab-item>
                                <v-card>
                                    <v-card-text>
                                        <p>
                                            Morbi nec metus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Nunc sed turpis.
                                        </p>

                                        <p>
                                            Suspendisse feugiat. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In hac habitasse platea dictumst. Fusce ac felis sit amet ligula pharetra condimentum.
                                        </p>

                                        <p>
                                            Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Nam commodo suscipit quam. In consectetuer turpis ut velit. Sed cursus turpis vitae tortor. Aliquam eu nunc.
                                        </p>

                                        <p>
                                            Etiam ut purus mattis mauris sodales aliquam. Ut varius tincidunt libero. Aenean viverra rhoncus pede. Duis leo. Fusce fermentum odio nec arcu.
                                        </p>

                                        <p class="mb-0">
                                            Donec venenatis vulputate lorem. Aenean viverra rhoncus pede. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Fusce commodo aliquam arcu. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi.
                                        </p>
                                    </v-card-text>
                                </v-card>
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
                </div>
                <div class="right-pane"></div>

            </v-layout>
        </v-flex>

    </div>
</template>

<script>

    export default {
        data: () => {
           return  {
               e1: 0
            }
        },
        methods: {}
    }
</script>

<style scoped>
    >>>.v-tabs-items, >>>.v-card{
        background-color: #F0F0F7 !important;
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
    .theme--light.v-tabs>.v-tabs-bar .v-tab--disabled, .theme--light.v-tabs>.v-tabs-bar .v-tab:not(.v-tab--active), .theme--light.v-tabs>.v-tabs-bar .v-tab:not(.v-tab--active) > .v-icon {
        color:#A5A4BF !important;
    }
</style>
