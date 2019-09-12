<template>
    <div>
        <v-progress-linear background-opacity="-1" value="20" height="8" class="pa-0 mt-n6 ml-n1" style="border-top-left-radius: 4px;"></v-progress-linear>
        <v-card flat class="create_card">
            <v-card-title class="pb-8 justify-center">{{ $t('labels.campaign.name_title') }}</v-card-title>
            <v-card-text class="text-center">{{ $t('labels.campaign.name_sub_text') }} <span class="primary--text">{{ $t('labels.campaign.name') }}</span></v-card-text>
            <v-card-text class="mb-12">
                <v-text-field class="text_field_width ma-auto"
                  :label="$t('labels.campaign.name_field_placeholder')"
                  v-model="form.name"
                  solo
                ></v-text-field>
            </v-card-text>
            <v-card-actions class="float-right action_btns">
                <v-btn color="primary" dark large @click="goToNext()">
                    {{ $t('labels.campaign.name_next_btn') }}
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
            }
        }),

        mounted() {

        },
        methods: {
            goToNext(){
                this.$router.push({name:'create-step2'})
            }
        }
    }
</script>
