<template>
    <v-card class="create_card mx-auto mt-12">
        <v-card flat>
            <v-card-title class="pb-8 justify-center">Select Your Campaign Placement</v-card-title>
            <v-card-text class="mb-12 text_field_width ma-auto">
                <div class="card_radio placement_radio">
                    <v-radio-group v-model="campaignPlacement.platform" row class="mt-0 full_width">
                        <v-row justify="space-between">
                            <v-col col="6"
                                    v-for="(placementItem, placementIndex) in loadPlacements"
                                    :key="placementIndex"
                            >
                                <v-radio color="primary" :value="placementItem.id"
                                         off-icon="mdi-checkbox-blank-outline"
                                         on-icon="mdi-checkbox-intermediate"
                                         :class="(placementIndex != 0) ? 'last_radio' : ''"
                                >
                                    <template slot="label">
                                    <span class="subtitle-1 text-uppercase black--text font-weight-bold">
                                        <v-icon class="display-2 primary--text">{{placementItem.image}}</v-icon>
                                        {{placementItem.name}}
                                    </span>
                                    </template>
                                </v-radio>
                            </v-col>
                        </v-row>
                    </v-radio-group>
                </div>
            </v-card-text>
        </v-card>

        <v-card flat>
            <v-card-title class="pb-8 justify-center">Select Your Campaign Type</v-card-title>
            <v-card-text class="mb-12 text_field_width ma-auto">
                <div class="card_radio campaign_radio">
                    <v-radio-group v-model="campaignPlacement.type" row class="mt-0 full_width">
                        <v-row justify="space-between">
                            <v-col col="6">
                                <v-radio value="paid" active-class="active_card_radio">
                                    <template slot="label">
                                        <v-card class="text-center" outlined max-width="200">
                                            <div class="triangle-topright" v-if="campaignPlacement.type == 'paid'">
                                                <v-icon align-end color="white" class="float-right title">mdi-check-circle</v-icon>
                                            </div>
                                            <v-card-title>
                                                <p class="icon_border ma-auto"><v-icon class="display-2" :color="campaignPlacement.type == 'paid' ? 'primary' : ''">mdi-currency-usd</v-icon></p>
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
                            </v-col>
                            <v-col col="6">
                                <v-radio style="float: right" value="barter" active-class="active_card_radio">
                                    <template slot="label">
                                        <v-card class="text-center mx-auto" outlined max-width="200">
                                            <div class="triangle-topright" v-if="campaignPlacement.type == 'barter'">
                                                <v-icon align-end color="white" class="float-right title">mdi-check-circle</v-icon>
                                            </div>
                                            <v-card-title>
                                                <p class="icon_border ma-auto"><v-icon class="display-2" :color="campaignPlacement.type == 'barter' ? 'primary' : ''">mdi-ballot-recount-outline</v-icon></p>
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
                            </v-col>
                        </v-row>
                    </v-radio-group>
                </div>

                <div class="card_radio campaign_radio">
                    <v-radio-group v-model="campaignPlacement.type" row class="mt-0 full_width">
                        <v-row justify="space-between">
                            <v-col col="6">
                                <v-radio-group v-model="campaignPlacement.barterProduct" row class="mt-0 full_width">
                                    <v-radio :value="true" active-class="active_card_radio">
                                        <template slot="label">
                                            <v-card class="text-center" outlined max-width="200">
                                                <div class="triangle-topright" v-if="campaignPlacement.barterProduct == true">
                                                    <v-icon align-end color="white" class="float-right title">mdi-check-circle</v-icon>
                                                </div>
                                                <v-card-text class="px-2">
                                                    <p>
                                                        Would you like barter this product?
                                                    </p>
                                                </v-card-text>
                                            </v-card>
                                        </template>
                                    </v-radio>
                                </v-radio-group>
                            </v-col>
                            <v-col col="6">
                                <v-radio-group v-model="campaignPlacement.payForProduct" row class="mt-0" style="float: right">
                                    <v-radio :value="true" active-class="active_card_radio">
                                        <template slot="label">
                                            <v-card class="text-center mx-auto" outlined max-width="200">
                                                <div class="triangle-topright" v-if="campaignPlacement.payForProduct == true">
                                                    <v-icon align-end color="white" class="float-right title">mdi-check-circle</v-icon>
                                                </div>
                                                <v-card-text class="px-2">
                                                    <p>
                                                        Would you like pay for this product?
                                                    </p>
                                                </v-card-text>
                                            </v-card>
                                        </template>
                                    </v-radio>
                                </v-radio-group>
                            </v-col>
                        </v-row>
                    </v-radio-group>
                </div>

            </v-card-text>
            <v-card-actions class="float-right action_btns mt-n12">
                <v-btn color="grey lighten-2" depressed dark large @click="goToBack()" class="text-capitalize mr-2 grey--text">
                    {{ $t('labels.campaign.name_backBtn') }}
                </v-btn>
                <v-btn color="primary" depressed dark large @click="goToNext()" class="text-capitalize">
                    {{ $t('labels.campaign.name_nextBtn') }}
                    <v-icon right>keyboard_arrow_right</v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-card>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    import { required } from 'vuelidate/lib/validators'
    export default {

        data: () => ({
            campaignPlacement:{
                platform:null,
                type:null,
                barterProduct:false,
                payForProduct:false,
            },
            loadPlacements:null
        }),
        validations: {
            campaignPlacement:{
                platform: {
                    required
                },
                type: {
                    required
                }
            }
        },
        computed: {
            ...mapGetters({
                campaignObjective: 'campaign/campaignObjective',
                placement: 'campaign/campaignPlacement'
            })
        },
        mounted() {
            this.campaignPlacement = Object.assign(this.campaignPlacement, this.placement)
            if (this.campaignObjective == null) {
                this.$router.push({name: 'create-campaign-objective'})
            } else if (this.campaignObjective.id == 1 || this.campaignObjective.id == 2) {
                this.campaignPlacement.type = 'barter';
            } else if (this.campaignObjective.id == 3) {
                this.campaignPlacement.type = 'paid';
            }
        },
        methods: {
            ...mapActions({
                fetchAllPlacements: 'campaign/fetchAllPlacements'
            }),
            goToNext() {
                let self = this;
                self.$v.$touch()
                if (self.$v.$invalid) {
                    if (self.$v.campaignPlacement.platform.$error) {
                        this.$toast.error('Campaign Placement is required')
                    } else if (self.$v.campaignPlacement.type.$error) {
                        this.$toast.error('Campaign Type is required')
                    }
                } else {
                    this.$store.dispatch('campaign/savePlacement', this.campaignPlacement)
                    this.$router.push({name: 'create-campaign-requirements'})
                }
            },
            goToBack() {
                this.$store.dispatch('campaign/savePlacement', this.campaignPlacement)
                this.$router.push({name: 'create-campaign-objective'})
            }
        },
        async created() {
            let fetchAllPlacements = await this.fetchAllPlacements();
            this.loadPlacements = fetchAllPlacements.details;
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
    >>>.campaign_radio .v-input--selection-controls__input{
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
        margin-right: 0px !important;
    }

    >>>.card_radio .last_radio{
        float: right !important;
        padding-right: 0px !important;
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
    .youtube_radio{
        margin-left: -70px !important;
    }
    >>>.placement_radio .you_radio .v-input--selection-controls__input{
        margin: 0 auto !important;
    }

    @media only screen
    and (min-device-width: 960px)
    and (max-device-width: 1366px)
    and (-webkit-min-device-pixel-ratio: 1) {
        .youtube_radio{
            margin-left: -55px !important;
        }
    }

    @media only screen
    and (min-device-width: 768px)
    and (max-device-width: 1365px)
    and (-webkit-min-device-pixel-ratio: 1) {
        .youtube_radio{
            margin-left: -45px !important;
        }
    }
    .paymentRadio >>>.v-input__control{
        margin-left: 0px !important;
    }
</style>
