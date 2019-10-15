<template>
    <div>
        <v-flex class="my-12">
            <v-card class="mx-auto card_wrapper">
                <v-row class="py-12 mx-auto main_wrapper">
                    <v-flex lg6 sm12 xs12 m12>
                        <div class="url_field">
                            <div class="subtitle-2 mb-2"><strong>Public URL</strong></div>
                            <v-text-field
                                outlined
                                label="http://influencerapp.1dea.test/campaign/create"
                                append-outer-icon="mdi-alert-circle-outline"
                                append-icon="mdi-content-copy"
                                class="tag_field"
                            ></v-text-field>
                        </div>
                        <div class="url_boxes">
                            <div class="subtitle-2 mb-2"><strong>Public URL</strong></div>
                            <v-row class="full_width px-3">
                                <v-flex lg6 sm12 xs12 :class="$vuetify.breakpoint.mdAndUp ? 'pr-2' : 'mb-5'">
                                    <v-card
                                        max-width="full_width"
                                        color="darkTextColor"
                                        class="text-center"
                                    >
                                        <v-card-title style="display:block" class="display-4 darkSecondary--text"><strong>90</strong></v-card-title>
                                        <v-card-text>
                                            <p class="subtitle-1">POTENTIAL INFLUENCER</p>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                            <v-btn block color="#B4B3BB" large>View All</v-btn>
                                            <p class="pt-4"><u>Lorem Ipsum is simply dummy text of the printing</u></p>
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex lg6 sm12 xs12 :class="$vuetify.breakpoint.mdAndUp ? 'pl-2' : 'mb-5'">
                                    <v-card
                                        max-width="full_width"
                                        color="primary"
                                        dark
                                        class="text-center"
                                    >
                                        <v-card-title style="display:block" class="display-4 white--text"><strong>15</strong></v-card-title>
                                        <v-card-text>
                                            <p class="subtitle-1">POTENTIAL INFLUENCER</p>
                                            <p class="white--text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                            <v-btn class="white--text" block color="#A64D4D" large>View All</v-btn>
                                            <p class="pt-4"><u>Lorem Ipsum is simply dummy text of the printing</u></p>
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                            </v-row>
                        </div>

                        <v-row class="full_width">
                            <v-flex lg12 sm12 class="pr-2 mt-12">
                                <v-card
                                    max-width="full_width" dense outlined
                                >
                                    <v-card-text>
                                        <v-checkbox v-model="checkbox2"  color="primary">
                                            <template slot="label">
                                                <strong>I will be shipping this product to influencers</strong>
                                            </template>
                                        </v-checkbox>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                                        </p>
                                    </v-card-text>
                                </v-card>
                                <v-btn color="primary" large class="mt-8 float-right text-capitalize">
                                    Launch Campaign
                                    <v-icon right>keyboard_arrow_right</v-icon>
                                </v-btn>
                            </v-flex>
                        </v-row>
                    </v-flex>
                    <v-flex lg6 sm6 m12 class="hidden-sm-and-down">

                    </v-flex>
                </v-row>
            </v-card>
        </v-flex>
    </div>
</template>

<script>

    export default {
        components: {

        },
        data: () => {
           return  {
               checkbox2: false,
            }
        },
        methods: {}
    }
</script>

<style scoped>
    .main_wrapper, .card_wrapper{
        width: 90%;
    }
    >>>.tag_field > .v-input__control > .v-input__slot{
        padding-right: 0px !important;
    }
    >>>.tag_field .v-input__append-inner{
        margin-top: 0px !important;
    }
    >>>.tag_field .v-input__append-inner .v-input__icon{
        background: #EE6F6F;
        padding: 28px;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }
    >>>.tag_field .v-input__append-inner .v-icon.v-icon{
        color: #ffffff;
    }
</style>
