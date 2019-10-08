<template>
    <v-card class="create_card mx-auto mt-12">
        <v-card-title class="pb-8 justify-center">Select Your Campaign Placement</v-card-title>
        <v-card-text class="mb-12 text_field_width ma-auto">
            <v-layout row justify-center wrap>
                <v-flex lg12 sm12 xs12 class="text-center">
                    <v-radio-group v-model="kind" row class="mx-auto">
                        <v-radio value="radio-1">
                            <template slot="label">
                                <span class="subtitle-1 text-uppercase black--text font-weight-bold">
                                    <v-icon class="display-2 primary--text">mdi-instagram</v-icon>
                                    Instagram
                                </span>
                            </template>
                        </v-radio>
                        <v-radio value="radio-2">
                            <template slot="label">
                                <span class="subtitle-1 text-uppercase black--text font-weight-bold">
                                    <v-icon class="display-2 primary--text">mdi-youtube</v-icon>
                                    Youtube
                                </span>
                            </template>
                        </v-radio>
                    </v-radio-group>
                </v-flex>
            </v-layout>
        </v-card-text>

        <v-card-title class="pb-8 justify-center">Select Your Campaign Type</v-card-title>
        <v-card-text class="mb-12 text_field_width ma-auto">
            <v-layout row justify-center wrap>
                <v-flex lg12 sm12 xs12 class="text-center">
                    <div class="card_radio">
                        <v-radio-group v-model="kind2" row class="mt-0 full_width">

                            <v-radio value="radio-1" active-class="active_card_radio">
                                <template slot="label">
                                    <v-card class="mx-auto text-center" outlined max-width="200">
                                        <div class="triangle-topright" v-if="kind2 == 'radio-1'">
                                            <v-icon align-end color="white" class="float-right title">mdi-check-circle</v-icon>
                                        </div>
                                        <v-card-title>
                                            <p class="icon_border ma-auto"><v-icon class="display-2" :color="kind2 == 'radio-1' ? 'primary' : ''">mdi-currency-usd</v-icon></p>
                                        </v-card-title>
                                        <v-card-text class="px-2">
                                            <p class="title">PAID</p>
                                            <p>
                                                Pay a fixed amount to influencer for each  promotion touch point.
                                            </p>
                                        </v-card-text>
                                    </v-card>
                                </template>
                            </v-radio>

                            <v-radio value="radio-2" active-class="active_card_radio">
                                <template slot="label">
                                    <v-card class="mx-auto text-center" outlined max-width="200">
                                        <div class="triangle-topright" v-if="kind2 == 'radio-2'">
                                            <v-icon align-end color="white" class="float-right title">mdi-check-circle</v-icon>
                                        </div>
                                        <v-card-title>
                                            <p class="icon_border ma-auto"><v-icon class="display-2" :color="kind2 == 'radio-2' ? 'primary' : ''">mdi-ballot-recount-outline</v-icon></p>
                                        </v-card-title>
                                        <v-card-text class="px-2">
                                            <p class="title">BARTER</p>
                                            <p>
                                                You will barter a product with influencer for each touch point.
                                            </p>
                                        </v-card-text>
                                    </v-card>
                                </template>
                            </v-radio>

                        </v-radio-group>
                    </div>
                </v-flex>
            </v-layout>
        </v-card-text>
        <v-card-actions class="float-right action_btns mt-n12">
            <v-btn color="primary" dark large @click="goToNext()">
                {{ $t('labels.campaign.name_nextBtn') }}
                <v-icon right>keyboard_arrow_right</v-icon>
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>

    export default {

        data: () => ({
            kind: 'radio-1',
            kind2: 'radio-1',
        }),

        mounted() {

        },
        methods: {
            goToNext(){
                this.$router.push({ name: 'create-campaign-name' })
            }
        }
    }
</script>
<style scoped>
    .create_card {
        width: 85%;
        border-radius: 10px;
    }
    >>>.v-input__control {
        margin: 0 auto !important;
    }
    >>>>>>.active_card_radio .v-icon.v-icon{
        color: #EE6F6F !important;
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
        position: absolute;
    }
    .triangle-topright {
        float: right;
        shape-outside: polygon(45px 45px, 45px 45px, 45px 0, 0 0);
        clip-path: polygon(45px 45px, 45px 45px, 45px 0, 0 0);
        background: #EE6F6F;
        height: 45px;
        width: 45px;
        position: absolute;
        right: 0px;
        margin-top: 2px;
        margin-right: 2px;
    }
    >>>.triangle-topright .v-icon{
        margin-right: 3px;
        margin-top: -1px;
    }
</style>
