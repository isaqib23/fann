<template>
    <div>
        <v-progress-linear background-opacity="-1" value="80" height="8" class="pa-0 mt-n6 ml-n1" style="border-top-left-radius: 4px;"></v-progress-linear>
        <v-card flat class="create_card">
            <v-card-title class="pb-8 justify-center">{{ $t('labels.campaign.name_title') }}</v-card-title>
            <v-card-text class="text-center">{{ $t('labels.campaign.paymentType_subText1') }} <span class="primary--text">{{ $t('labels.campaign.platform') }}</span> {{ $t('labels.campaign.paymentType_subText2') }}</v-card-text>
            <v-card-text class="mb-12 text_field_width ma-auto">
                <v-layout row justify-center wrap>
                    <v-flex lg4 sm4 xs12 class="radio-center">
                        <v-radio-group v-model="radios" class="first_radio">
                            <v-sheet color="grayLighten create_sheet">
                                <v-icon size="70">local_see</v-icon>
                            </v-sheet>
                            <v-radio :label="$t('labels.campaign.platform_InstagramRadio')" value="radio-1" color="primary"></v-radio>
                        </v-radio-group>
                    </v-flex>
                    <v-flex lg4 sm4 xs12 class="radio-center">
                        <v-radio-group class="pl-12" v-model="radios">
                            <v-sheet color="grayLighten create_sheet">
                                <v-icon size="70">video_library</v-icon>
                            </v-sheet>
                            <v-radio :label="$t('labels.campaign.platform_YoutubeRadio')" value="radio-2" color="primary"></v-radio>
                        </v-radio-group>
                    </v-flex>
                    <v-flex lg4 sm4 xs12 class="radio-center">
                        <v-radio-group class="pl-12" v-model="radios">
                            <v-sheet color="grayLighten create_sheet">
                                <v-icon size="70">rate_review</v-icon>
                            </v-sheet>
                            <v-radio :label="$t('labels.campaign.platform_BlogRadio')" value="radio-3" color="primary"></v-radio>
                        </v-radio-group>
                    </v-flex>
                </v-layout>
            </v-card-text>
            <v-card-actions class="float-right action_btns">
                <v-btn text color="grayLight" @click="goToBack()">
                    {{ $t('labels.campaign.name_backBtn') }}
                </v-btn>
                <v-btn color="primary" dark large @click="goToNext()">
                    {{ $t('labels.campaign.name_nextBtn') }}
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
                name: 'Write a suitable name here',
            },
            radios: 'radio-1'
        }),

        mounted() {

        },
        methods: {
            goToNext(){
                this.$router.push({name:'create-step5'})
            },
            goToBack(){
                this.$router.push({name:'create-step3'})
            }
        }
    }
</script>
