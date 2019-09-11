<template>
    <div>
        <v-flex>
            <v-layout class="panes-container">
                <div class="left-pane" >
                    <v-stepper v-model="e1"  :vertical=true>
                        <v-stepper-header>
                            <v-stepper-step :complete="e1 > 1" step="1">Name of step 1</v-stepper-step>

                            <v-stepper-step :complete="e1 > 2" step="2">Name of step 2</v-stepper-step>

                            <v-stepper-step step="3">Name of step 3</v-stepper-step>
                        </v-stepper-header>

                        <v-stepper-items>
                            <v-stepper-content step="1">
                                <v-card
                                        class="mb-12"
                                        color="grey lighten-1"
                                        height="200px"
                                ></v-card>

                                <v-btn
                                        color="primary"
                                        @click="e1 = 2"
                                >
                                    Continue
                                </v-btn>

                                <v-btn text>Cancel</v-btn>
                            </v-stepper-content>

                            <v-stepper-content step="2">
                                <v-card
                                        class="mb-12"
                                        color="grey lighten-1"
                                        height="200px"
                                ></v-card>

                                <v-btn
                                        color="primary"
                                        @click="e1 = 3"
                                >
                                    Continue
                                </v-btn>

                                <v-btn text>Cancel</v-btn>
                            </v-stepper-content>

                            <v-stepper-content step="3">
                                <v-card
                                        class="mb-12"
                                        color="grey lighten-1"
                                        height="200px"
                                ></v-card>

                                <v-btn
                                        color="primary"
                                        @click="e1 = 1"
                                >
                                    Continue
                                </v-btn>

                                <v-btn text>Cancel</v-btn>
                            </v-stepper-content>
                        </v-stepper-items>
                    </v-stepper>
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

<style>
    .panes-container {
        display: flex;
        width: 100%;
        overflow: hidden;
    }

    .left-pane {
        width: 35%;
    }


    .right-pane {
        flex: auto;
        background: #eee;
    }

    .panes-container,
    .left-pane,
    .right-pane {
        margin: 0;
        padding: 0;
        height: 100%;
    }
</style>