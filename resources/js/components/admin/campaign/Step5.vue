<template>
    <div>
        <v-progress-linear background-opacity="-1" value="100" height="8" class="pa-0 mt-n6 mr-n5 ml-n1" style="border-top-left-radius: 4px; border-top-right-radius: 4px;"></v-progress-linear>
        <v-card flat class="pa-12">
            <v-card-title class="pb-8 justify-center">Create your amazing campaign in few steps</v-card-title>
            <v-card-text class="text-center">You are Almost done! Select your <span class="primary--text">Payment</span> mode to proceed</v-card-text>
            <v-card-text class="mb-12 text_field_width ma-auto">
                <v-layout row justify-center wrap>
                    <v-flex lg12 sm12 xs12 class="text-center">
                        <v-checkbox v-model="checkbox1" :label="labels.name1" color="primary"></v-checkbox>
                        <v-text-field class="ma-auto"
                                      :label="labels.name2"
                                      solo
                        ></v-text-field>
                        <v-checkbox v-model="checkbox2" :label="labels.name2" color="primary"></v-checkbox>
                    </v-flex>
                </v-layout>
            </v-card-text>
            <v-card-actions class="float-right pr-12 pb-12">
                <v-btn text color="grayLight" @click="goToBack()">
                    Back
                </v-btn>
                <v-btn color="primary" dark large @click="goToNext()">
                    Lets's Get Started
                    <v-icon right>keyboard_arrow_right</v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>

    import router from "../../../router";

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
                router.push({name:''})
            },
            goToBack(){
                router.push({name:'create-step4'})
            }
        }
    }
</script>
<style scoped>
    .text_field_width{
        width:50% !important;
    }
</style>
