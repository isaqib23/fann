<template>
    <div>
        <v-flex>
            <v-card class="elevation-4  mx-auto pa-3 transition-swing">
                <v-card-title>
                    <div class="subtitle-1 mb-2"><strong>Campaign Cover</strong></div>
                </v-card-title>
                <v-card-text>
                    <v-text-field
                        outlined
                        label="Instagram image post"
                    ></v-text-field>
                </v-card-text>
            </v-card>
        </v-flex>

        <v-flex>
            <v-card class="elevation-4  mx-auto pa-3 transition-swing mt-3">
                <v-card-title>
                    <div class="subtitle-1 mb-2"><strong>Placement</strong></div>
                </v-card-title>
                <v-card-text>
                    <div class="kind_group">
                        <v-radio-group v-model="kind" row class="mt-0">
                            <v-radio class="insta_radio" label="Instagram" off-icon="mdi-instagram" on-icon="mdi-instagram" value="radio-1" active-class="kind_active"></v-radio>
                            <v-radio class="youtube_radio ml-8" label="Youtube" off-icon="mdi-youtube" on-icon="mdi-youtube" value="radio-2" active-class="kind_active"></v-radio>
                            <!--
                                <v-radio class="blogger_radio ml-8" label="Blogger" off-icon="mdi-blogger" on-icon="mdi-blogger" value="radio-3" active-class="kind_active"></v-radio>
                            -->
                        </v-radio-group>
                    </div>
                </v-card-text>
            </v-card>
        </v-flex>


        <v-flex>
            <v-card class="elevation-4  mx-auto pa-3 transition-swing mt-3">
                <v-card-title>
                    <div class="subtitle-1 mb-2"><strong>Campaign Type</strong></div>
                </v-card-title>
                <v-card-text>
                    <div class="full_width card_radio">
                        <v-radio-group v-model="kind2" row class="mt-0 full_width">

                            <v-radio value="radio-1" active-class="active_card_radio">
                                <template slot="label">
                                    <v-card class="mx-auto full_width text-center" outlined>
                                        <div class="float_class full_width">
                                            <v-icon align-end color="white">mdi-check-circle</v-icon>
                                        </div>
                                        <v-card-title>
                                            <p class="icon_border ma-auto"><v-icon class="display-2">mdi-currency-usd</v-icon></p>
                                        </v-card-title>
                                        <v-card-text class="px-2">
                                            <p class="title">PAID</p>
                                            <p>Lorem Ipsum is simply dummy text</p>
                                        </v-card-text>
                                    </v-card>
                                </template>
                            </v-radio>

                            <v-radio value="radio-2" active-class="active_card_radio">
                                <template slot="label">
                                    <v-card class="mx-auto full_width text-center" outlined>
                                        <div class="float_class full_width">
                                            <v-icon align-end color="white">mdi-check-circle</v-icon>
                                        </div>
                                        <v-card-title>
                                            <p class="icon_border ma-auto"><v-icon class="display-2">mdi-ballot-recount-outline</v-icon></p>
                                        </v-card-title>
                                        <v-card-text class="px-2">
                                            <p class="title">BARTER</p>
                                            <p>Lorem Ipsum is simply dummy text</p>
                                        </v-card-text>
                                    </v-card>
                                </template>
                            </v-radio>

                        </v-radio-group>
                    </div>
                </v-card-text>
            </v-card>
        </v-flex>


        <v-flex>
            <v-card class="elevation-4  mx-auto pa-3 transition-swing mt-3">
                <v-card-title>
                    <div class="subtitle-1 mb-2"><strong>Campaign Scale</strong></div>
                </v-card-title>
                <v-card-text>
                    <div class="full_width card_radio">
                        <v-radio-group v-model="kind3" row class="mt-0 full_width">

                            <v-radio value="radio-1" active-class="active_card_radio">
                                <template slot="label">
                                    <v-card class="mx-auto full_width text-center" outlined>
                                        <div class="float_class full_width">
                                            <v-icon align-end color="white">mdi-check-circle</v-icon>
                                        </div>
                                        <v-card-title>
                                            <p class="icon_border ma-auto"><v-icon class="display-2">mdi-text-subject</v-icon></p>
                                        </v-card-title>
                                        <v-card-text class="px-2">
                                            <p class="title">SILVER</p>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                        </v-card-text>
                                    </v-card>
                                </template>
                            </v-radio>

                            <v-radio value="radio-2" active-class="active_card_radio">
                                <template slot="label">
                                    <v-card class="mx-auto full_width text-center" outlined>
                                        <div class="float_class full_width">
                                            <v-icon align-end color="white">mdi-check-circle</v-icon>
                                        </div>
                                        <v-card-title>
                                            <p class="icon_border ma-auto"><v-icon class="display-2">mdi-gate</v-icon></p>
                                        </v-card-title>
                                        <v-card-text class="px-2">
                                            <p class="title">PLATINUM</p>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                        </v-card-text>
                                    </v-card>
                                </template>
                            </v-radio>

                        </v-radio-group>
                    </div>
                </v-card-text>

                <v-card class="mx-auto" flat>
                    <v-card-title>
                        <div class="subtitle-1 mb-2"><strong>Campaign Cover</strong></div>
                    </v-card-title>
                    <v-card-text>
                        <v-text-field
                            outlined
                            label="Instagram image post"
                        ></v-text-field>
                    </v-card-text>
                </v-card>
            </v-card>
        </v-flex>


    </div>
</template>

<script>

    export default {
        components: {

        },
        data: () => {
           return  {
               e1: 0,
               checkbox2: true,
               checkbox1: false,
               kind: 'radio-1',
               kind2: 'radio-1',
               kind3: 'radio-1',
            }
        },
        methods: {}
    }
</script>

<style scoped>
    >>>.kind_group .v-label{
        position: absolute !important;
        bottom: -60px;
        font-size: 11px;
    }
    >>>.youtube_radio .v-label{
        margin-left: 80px !important;
    }
    >>>.blogger_radio .v-label{
        margin-left: 162px !important;
    }
    >>>.kind_group .v-radio .v-icon.v-icon{
        font-size:40px !important;
    }
    >>>.kind_group .kind_active .v-icon.v-icon,  >>>.active_card_radio .v-icon.v-icon{
        color: #EE6F6F !important;
    }
    >>>.active_card_radio .v-card {

    }
    >>>.card_radio .v-input--selection-controls__input{
        display:none !important
    }
    .card_radio .icon_border{
        border:2px solid #cccccc;
        border-radius: 50%;
    }
    >>>.active_card_radio .icon_border{
        border-color: #EE6F6F !important;
    }
    >>>.card_radio .v-input__control{
        width: 100% !important;
    }
    >>>.card_radio .v-radio{
        width: 50% !important;
        margin-right: 0px !important;
    }
    >>>.card_radio .v-label{
        width: 100% !important;
        margin: 5px !important;
    }
    .float_class{
        text-align: right !important;
        float: right !important;
        position: absolute;
        right:1px;
        top:1px;
    }
</style>
