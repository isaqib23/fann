<template>
    <v-card class="create_card mx-auto mt-12">
        <v-card-title class="pb-8 justify-center">Select Your Campaign Objective</v-card-title>
        <v-card-text class="mb-12  ma-auto">
            <v-radio-group v-model="campaignObjective">
            <v-layout row justify-center wrap>
                <v-flex lg4 sm12 xs12>
                    <div class="pl-12">
                        <v-img src="/images/icons/balloon.svg" min-height="50" width="50" min-width="50" class="ml-12"></v-img>
                        <div class="subtitle-1 mb-2 black--text text-uppercase font-weight-bold">product placement</div>
                    </div>

                    <div class="pl-12">
                        <v-radio off-icon="mdi-checkbox-blank-outline" on-icon="mdi-checkbox-intermediate" label="Unboxing" color="primary" value="unboxing" hide-details></v-radio>
                        <v-radio off-icon="mdi-checkbox-blank-outline" on-icon="mdi-checkbox-intermediate" label="Product Review" color="primary" value="productReview" hide-details></v-radio>
                        <v-radio  off-icon="mdi-checkbox-blank-outline" on-icon="mdi-checkbox-intermediate" label="Contests & Giveways" color="primary" value="contestsGiveways" hide-details></v-radio>
                    </div>

                </v-flex>
                <v-flex lg4 sm12 xs12>
                    <div class="pl-12">
                        <v-img src="/images/icons/awareness.svg" min-height="50" width="50" min-width="50" class="ml-12"></v-img>
                        <div class="subtitle-1 mb-2 black--text text-uppercase font-weight-bold">brand awareness</div>
                    </div>
                    <div class="pl-12">
                        <v-radio  off-icon="mdi-checkbox-blank-outline" on-icon="mdi-checkbox-intermediate" label="Brand Shoutout" color="primary" value="brandShoutout" hide-details></v-radio>
                        <v-radio  off-icon="mdi-checkbox-blank-outline" on-icon="mdi-checkbox-intermediate" label="Brand Review" color="primary" value="brandReview" hide-details></v-radio>
                        <v-radio  off-icon="mdi-checkbox-blank-outline" on-icon="mdi-checkbox-intermediate" label="Event Invitation" color="primary" value="eventInvitation" hide-details></v-radio>
                    </div>
                </v-flex>
                <v-flex lg4 sm12 xs12>
                    <div class="pl-12">
                        <v-img src="/images/icons/sponsor.svg" min-height="50" width="50" min-width="50" class="ml-12"></v-img>
                        <div class="subtitle-1 mb-2 black--text text-uppercase font-weight-bold">sponsored content</div>
                    </div>
                    <div class="pl-12">
                        <v-radio  off-icon="mdi-checkbox-blank-outline" on-icon="mdi-checkbox-intermediate" label="Promotional Content" color="primary" value="promotionalContent" hide-details></v-radio>
                        <v-radio  off-icon="mdi-checkbox-blank-outline" on-icon="mdi-checkbox-intermediate" label="Special Events" color="primary" value="specialEvents" hide-details></v-radio>
                    </div>
                </v-flex>
            </v-layout>
            </v-radio-group>
        </v-card-text>

        <v-card-title class="pb-8 justify-center">Now Give Your Campaign A Beautiful Name</v-card-title>
        <v-card-text class="mb-12 text_field_width ma-auto">
            <v-layout row justify-center wrap>
                <v-flex lg12 sm12 xs12 class="text-center">
                    <v-text-field class="text_field_width ma-auto text-center"
                                  label="Type Name Here"
                                  solo
                    ></v-text-field>
                </v-flex>
            </v-layout>
        </v-card-text>
        <v-card-actions class="float-right action_btns mt-n12">
            <v-btn color="primary" class="text-capitalize" dark large @click="goToNext()">
                {{ $t('labels.campaign.name_nextBtn') }}
                <v-icon right>keyboard_arrow_right</v-icon>
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {

        data: () => ({
            campaignObjective: null
        }),
        computed: {
            ...mapGetters({
                campaign: 'campaign/campaignObjective'
            })
        },
        mounted() {
            console.log(this.campaign);
            this.campaignObjective = this.campaign
        },

        methods: {
            goToNext(){
                this.$store.dispatch('campaign/saveObjective', this.campaignObjective)
                this.$router.push({ name: 'create-campaign-objective' })
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

    }
    >>>.v-input--selection-controls .v-input__control{
        width: 100% !important;
    }
</style>
