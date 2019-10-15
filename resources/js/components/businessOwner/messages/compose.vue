<template>
    <v-col cols="12" md="10" class="px-0 py-12">
        <v-row class="mx-auto">
            <v-card flat class="mx-auto card_wrapper">
                <v-card-text>
                    <v-text-field
                        label="To"
                        solo
                    ></v-text-field>
                    <v-text-field
                        label="CC"
                        solo
                    ></v-text-field>
                    <v-text-field
                        label="Subject"
                        solo
                    ></v-text-field>
                    <v-textarea
                        solo
                        rows="15"
                        name="input-7-4"
                        label="Write Something"
                    ></v-textarea>
                </v-card-text>

                <v-card-actions class="text-right float-right">
                    <v-btn color="primary" class="caption pl-12 pr-12 text-capitalize" large>Send</v-btn>
                </v-card-actions>
            </v-card>
        </v-row>
    </v-col>
</template>

<script>

    export default {
        data: () => ({

        }),

        mounted() {

        }
    }
</script>
<style scoped>
    .card_wrapper{
        width: 80%;
    }
    >>>.v-text-field__details {
        margin-bottom: 0px !important;
    }
</style>
