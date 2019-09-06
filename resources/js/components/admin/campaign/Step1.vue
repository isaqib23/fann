<template>
    <div>
        <v-progress-linear background-opacity="-1" value="20" height="8" class="pa-0 mt-n6 ml-n1" style="border-top-left-radius: 4px;"></v-progress-linear>
        <v-card flat class="pa-12">
            <v-card-title class="pb-8 justify-center">Create your amazing campaign in few steps</v-card-title>
            <v-card-text class="text-center">Give your campaign an awesome <span class="primary--text">name</span></v-card-text>
            <v-card-text class="mb-12">
                <v-text-field class="text_field_width ma-auto"
                  :label="labels.name"
                  v-model="form.name"
                  solo
                ></v-text-field>
            </v-card-text>
            <v-card-actions class="float-right pr-12 pb-12">
                <v-btn color="primary" dark large @click="goToNext()">
                    Next
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
                name: 'Write a suitable name here',
            }
        }),

        mounted() {

        },
        methods: {
            goToNext(){
                router.push({name:'create-step2'})
            }
        }
    }
</script>
<style scoped>
    .text_field_width{
        width:50% !important;
    }
</style>
