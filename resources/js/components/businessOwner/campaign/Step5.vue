<template>
    <div>
        <v-progress-linear background-opacity="-1" value="100" height="8" class="pa-0 mt-n6 mr-n5 ml-n1" style="border-top-left-radius: 4px; border-top-right-radius: 4px;"></v-progress-linear>
        <v-card flat class="create_card">
            <v-card-title class="pb-8 justify-center">{{ $t('labels.campaign.name_title') }}</v-card-title>
            <v-card-text class="text-center">{{ $t('labels.campaign.payment_subText1') }} <span class="primary--text">{{ $t('labels.campaign.payment') }}</span> {{ $t('labels.campaign.payment_subText2') }}</v-card-text>
            <v-card-text class="mb-12 text_field_width ma-auto">
                <v-layout row justify-center wrap>
                    <v-flex lg12 sm12 xs12 class="text-center">
                        <v-checkbox v-model="checkbox1" :label="$t('labels.campaign.payment_AmountCheckBox')" color="primary"></v-checkbox>
                        <v-text-field class="ma-auto"
                                      :label="$t('labels.campaign.payment_FieldPlaceHolder')"
                                      solo
                        ></v-text-field>
                        <v-checkbox v-model="checkbox2" :label="$t('labels.campaign.payment_OfferCheckBox')" color="primary"></v-checkbox>
                    </v-flex>
                </v-layout>
            </v-card-text>
            <v-card-actions class="float-right action_btns">
                <v-btn text color="grayLight" @click="goToBack()">
                    {{ $t('labels.campaign.name_backBtn') }}
                </v-btn>
                <v-btn color="primary" dark large @click="goToNext()">
                    {{ $t('labels.campaign.payment_StartedBtn') }}
                    <v-icon right>keyboard_arrow_right</v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>

    export default {

        data: () => ({
            form: {
                name: null,
            },
            labels: {
                name1: 'I will pay a fixed amount',
                name2: 'I am open to offers',
                name3: 'Write your amount here'
            },
            checkbox1: true,
            checkbox2: false,
        }),

        mounted() {

        },
        methods: {
            goToNext(){
                this.$router.push({ name: 'create-campaign-requirements' })
            },
            goToBack(){
                this.$router.push({ name: 'create-step4' })
            }
        }
    }
</script>
