<template>

    <v-container fluid>
        <v-layout wrap class="pa-12">
            <v-flex xs12>
                <v-row >
                    <v-col cols="12" md="6" xs="12">
                        <div class="subtitle-1 mb-2"><strong>Campaign</strong></div>
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
                        <v-col class="d-flex" cols="3" v-for="(campaign, index) in campaigns" :key="index">
                            <v-card
                            :loading="loading"
                            class="mx-auto my-2"
                            @click="goToDetail()"
                        >
                                <img
                                    :src="'/'+campaign.touch_point[0].media.path+'/medium/'+campaign.touch_point[0].media.name"
                                    alt="John"
                                    height="250"
                                    v-if="campaign.touch_point[0].media.length > 0"
                                >
                                <img
                                    src="/images/icons/company_placeholder.png"
                                    alt="John"
                                    height="250"
                                    v-else
                                >

                            <v-avatar tile class="brand_logo">
                                <img
                                    :src="'/'+campaign.touch_point[0].media.path+'/medium/'+campaign.touch_point[0].media.name"
                                    alt="John"
                                    style="border: 2px solid white"
                                    v-if="campaign.touch_point[0].media.length > 0"
                                >
                                <img
                                    src="/images/icons/user_placeholder.png"
                                    alt="John"
                                    style="border: 2px solid white"
                                    v-else
                                >
                            </v-avatar>
                            <v-card-title class="title">
                                <v-icon class="primary--text headline mr-2" v-if="campaign.primary_placement_id === 1">mdi-instagram</v-icon>
                                <v-icon class="primary--text headline mr-2" v-else>mdi-youtube</v-icon>
                                {{(campaign.name.length > 15) ? campaign.name.substring(0,15)+"..." : campaign.name}}
                            </v-card-title>

                            <v-card-text class="py-0">
                                <div>
                                    {{(campaign.description.length > 30) ? campaign.description.substring(0,30)+"..." : campaign.description}}
                                </div>
                            </v-card-text>

                            <v-card-text class="py-0 mb-5">
                                <v-chip-group active-class="deep-purple accent-4 white--text" column>
                                    <v-chip>
                                        {{(campaign.objective.name.length > 10) ? campaign.objective.name.substring(0,10)+"..." : campaign.objective.name}}
                                    </v-chip>

                                    <v-chip>
                                        {{(campaign.payment.payment_type.name.length > 10) ? campaign.payment.payment_type.name.substring(0,10)+"..." : campaign.payment.payment_type.name}}
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
            campaigns : [],
            loading: false,
        }),
        methods: {
            ...mapActions({
                getActiveCampaigns : 'campaignManagement/getActiveCampaigns',
            }),
            reserve () {
                this.loading = true

                setTimeout(() => (this.loading = false), 2000)
            },
            goToDetail(){
                this.$router.push({ name: 'influencer-campaign-detail' })
            }
        },
        async mounted() {
            this.campaigns = await this.getActiveCampaigns({status:'active'});
            console.log(this.campaigns);
        }
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
</style>
