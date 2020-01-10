<template>

    <v-container fluid>
        <v-layout wrap class="pa-12">
            <v-flex xs12>
                <v-row >
                    <v-col cols="12" md="6" xs="12">
                        <div class="subtitle-1 mb-2"><strong>Campaign Invites</strong></div>
                    </v-col>
                    <v-spacer></v-spacer>
                    <v-col cols="12" md="1" xs="12" class="mr-n3">
                        <p class="mb-0 pt-2 text-uppercase font-weight-bold subtitle-2"><v-icon class="headline">mdi-filter-outline</v-icon> Filters</p>
                    </v-col>
                    <v-col cols="12" md="2" xs="12">
                        <v-select label="From" solo class="custom_dropdown custom_dropdown" append-icon="keyboard_arrow_down"></v-select>
                    </v-col>
                </v-row>
            </v-flex>
            <v-flex xs12 md12>
                <v-card outlined tile  class="pa-12">
                    <v-row class="full_width" align="center">
                        <v-col class="d-flex" cols="3" v-for="(invite, index) in invites" :key="index">
                            <v-card
                                :loading="loading"
                                class="mx-auto my-2"
                                @click="goToDetail(invite)"
                            >
                                <div class="img-container">
                                    <img
                                        src="/images/icons/company_placeholder.png"
                                        alt="Johnnnn"
                                        height="250"
                                    >
                                </div>
                                <v-avatar tile class="brand_logo">
                                    <img
                                        src="/images/icons/company_placeholder.png"
                                        alt="John"
                                        style="border: 2px solid white"
                                    >
                                </v-avatar>
                                <v-card-title class="title">
                                    <v-icon class="primary--text headline mr-2" v-if="invite.campaign.primary_placement_id === 1">mdi-instagram</v-icon>
                                    <v-icon class="primary--text headline mr-2" v-else>mdi-youtube</v-icon>
                                    {{(invite.campaign.name.length > 15) ? invite.campaign.name.substring(0,15)+"..." : invite.campaign.name}}
                                </v-card-title>

                                <v-card-text class="py-0">
                                    <div>
                                        {{(invite.campaign.description.length > 30) ? invite.campaign.description.substring(0,30)+"..." : invite.campaign.description}}
                                    </div>
                                </v-card-text>

                                <v-card-text class="py-0 mb-5">
                                    <v-chip-group active-class="deep-purple accent-4 white--text" column>
                                        <v-chip>
                                            {{(invite.campaign.objective.name.length > 10) ? invite.campaign.objective.name.substring(0,10)+"..." : invite.campaign.objective.name}}
                                        </v-chip>

                                        <v-chip>
                                            {{(invite.campaign.payment.payment_type.name.length > 10) ? invite.campaign.payment.payment_type.name.substring(0,10)+"..." : invite.campaign.payment.payment_type.name}}
                                        </v-chip>
                                    </v-chip-group>
                                </v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-card>
            </v-flex>

        </v-layout>
    </v-container>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data: () => ({
            invites : [],
            loading: false,
        }),
        methods: {
            ...mapActions({
                getCampaignInvitesByInfluencer : 'campaign/getCampaignInvitesByInfluencer',
            }),
            reserve () {
                this.loading = true

                setTimeout(() => (this.loading = false), 2000)
            },
            goToDetail(invite){
                this.$router.push({
                    name: 'influencer-campaign-invite-detail',
                    params: {
                        slug     : invite.campaign.slug,
                        sender   : invite.sender_id,
                        invite   : invite.id
                    }
                })
            }
        },
        async mounted() {
            this.invites = await this.getCampaignInvitesByInfluencer({
                status  :   'sent',
                user_id :   this.auth.id
            });
        },
        computed: {
            ...mapGetters({
                auth                : 'auth/user'
            })
        },
    }
</script>

<style scoped>
    >>>.custom_dropdown .v-input__control{
        min-height: 45px !important;
    }
    >>>.custom_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    >>>.v-text-field__details {
        display: none !important;
    }
    >>>.brand_logo{
        margin-top: -24px;
        margin-left: 24px;
        border-radius: 10px;
    }
    .img-container {
        text-align: center;
        display: block;
    }
</style>
