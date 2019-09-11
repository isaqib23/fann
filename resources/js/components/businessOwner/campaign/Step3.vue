<template>
    <div>
        <v-progress-linear background-opacity="-1" value="60" height="8" class="pa-0 mt-n6 ml-n1" style="border-top-left-radius: 4px;"></v-progress-linear>
        <v-card flat class="create_card">
            <v-card-title class="pb-8 justify-center">Create your amazing campaign in few steps</v-card-title>
            <v-card-text class="text-center">Select the <span class="primary--text">Objective</span> of your campaign which you want to create</v-card-text>
            <v-card-text class="mb-12 text_field_width ma-auto">
                <v-layout row justify-center wrap>
                    <v-flex lg6 sm6 xs12 class="radio-center">
                        <v-radio-group v-model="radios" class="left_radio">
                            <v-sheet color="grayLighten create_sheet">
                                <v-icon size="70">toll</v-icon>
                            </v-sheet>
                            <v-radio label="Brand Awareness" value="radio-1" color="primary"></v-radio>
                        </v-radio-group>
                    </v-flex>
                    <v-flex lg6 sm6 xs12 class="radio-center">
                        <v-radio-group class="radio-center" v-model="radios">
                            <v-sheet color="grayLighten create_sheet">
                                <v-icon size="70">pan_tool</v-icon>
                            </v-sheet>
                            <v-radio label="Product Promotion" value="radio-2" color="primary"></v-radio>
                        </v-radio-group>
                    </v-flex>
                </v-layout>
            </v-card-text>
            <v-card-actions class="float-right action_btns">
                <v-btn text color="grayLight" @click="goToBack()">
                    Back
                </v-btn>
                <v-btn color="primary" dark large @click="goToNext()">
                    Next
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
                this.$router.push({name:'create-step4'})
            },
            goToBack(){
                this.$router.push({name:'create-step2'})
            }
        }
    }
</script>
