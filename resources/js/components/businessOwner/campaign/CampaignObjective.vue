<template>
    <v-card class="create_card mx-auto mt-12">
        <v-card-title class="pb-8 justify-center">Select Your Campaign Objective</v-card-title>
        <v-card-text class="mb-12  ma-auto">
            <v-radio-group id="campaignObjectiveGroup">
            <v-layout row justify-center wrap>
                <v-flex lg4 sm12 xs12 v-for="(objectives, category) in getCampaignObjectives" :key="category">
                    <div class="pl-12">
                        <v-img :src="objectives.category.image" min-height="50" width="50" min-width="50" class="ml-12"></v-img>
                        <div class="subtitle-1 mb-2 black--text text-uppercase font-weight-bold">{{category}}</div>
                    </div>

                    <div class="pl-12">
                        <v-radio-group v-model="campaignObjective.ObjectiveId">
                            <span v-for="(objective, objectiveIndex)  in objectives.main" :key="objectiveIndex">
                            <v-radio off-icon="mdi-checkbox-blank-outline" on-icon="mdi-checkbox-intermediate"
                                     :slug="objective.slug"
                                     :label="objective.name"
                                     :value="objective.id"
                                     color="primary"  hide-details>
                            </v-radio>
                            </span>
                        </v-radio-group>
                    </div>
                </v-flex>
            </v-layout>
            </v-radio-group>
        </v-card-text>

        <v-card-title class="pb-8 justify-center">Now Give Your Campaign A Beautiful Names</v-card-title>
        <v-card-text class="mb-12 text_field_width ma-auto">
            <v-layout row justify-center wrap>
                <v-flex lg12 sm12 xs12 class="text-center">
                    <v-text-field class="text_field_width ma-auto text-center"
                                  v-model="campaignObjective.name"
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
    import { mapGetters, mapActions } from 'vuex';
    import axios from 'axios'
    import { api } from '~/config'
    import { required, minLength } from 'vuelidate/lib/validators'
    export default {

        data: () => ({
            self: this,
            campaignObjective: {
                ObjectiveId: null,
                slug: null,
                name: null
            },
            getCampaignObjectives: {}
        }),
        validations: {
            campaignObjective:{
                ObjectiveId: {
                    required,
                },
                name: {
                    required,
                    minLength: minLength(4)
                }
            }
        },
        computed: {
            ...mapGetters({
                campaign: 'campaign/campaignObjective'

            })
        },
       mounted() {
           let self = this;
           this.campaignObjective = Object.assign(this.campaignObjective, this.campaign)
           axios
               .get(api.path('campaign.objectives'))
               .then(function (resp) {
                   self.getCampaignObjectives = resp.data.details;
               });
        },
        methods: {
            ...mapActions({
                saveObjective: 'campaign/saveObjective'
            }),
            async goToNext () {
                let self = this;
                self.$v.$touch()
                if (self.$v.$invalid) {
                    if(self.$v.campaignObjective.ObjectiveId.$error) {
                        this.$toast.error('Campaign Objective is required')
                    }else if(self.$v.campaignObjective.name.$error) {
                        this.$toast.error('Name must have at least '+self.$v.campaignObjective.name.$params.minLength.min+' letters.')
                    }
                } else {
                    this.campaignObjective.slug  = this.$el.querySelector("input[type=radio]:checked").getAttribute('slug')
                    let savedCampaign =  await this.saveObjective(this.campaignObjective);
                    console.info(savedCampaign,  'hey response');
                   this.$router.push({ name: 'create-campaign-placement', params: { slug: savedCampaign.details.slug } })
                }
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
