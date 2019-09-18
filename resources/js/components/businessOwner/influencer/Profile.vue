<template>
    <div>
        <v-flex class="ma-12">
            <div class="subtitle-1 mb-2"><strong>Amanda's Profile</strong></div>
            <v-card
                class="mx-auto"
            >
                <v-row class="py-4 px-12 mx-auto main_wrapper">
                    <v-avatar height="150" width="150">
                        <v-img
                            src="https://cdn.vuetifyjs.com/images/cards/store.jpg"
                        ></v-img>
                    </v-avatar>
                    <v-col class="text-center inner_wrapper">
                        <v-container class="pa-0">
                            <v-card-title class="my-0 py-0">
                                <div class="headline mb-2 mr-4"><strong>Amanda Nash</strong></div>
                                <v-rating v-model="rating" color="warning" class="mt-n4"></v-rating>
                                <v-btn color="grayLighten pl-1 pr-1 ml-4 mr-2" depressed height="30">
                                    Lifestyle
                                </v-btn>
                                <v-btn color="grayLighten pl-1 pr-1 ml-1" depressed height="30">
                                    Fashion
                                </v-btn>
                            </v-card-title>
                            <div class="text-start ml-4 mt-n2">
                                <p class="overline integrityColor--text" color="grayLighten">Amanda Nash</p>
                            </div>
                            <div class="icons text-start ml-4">
                                <v-icon color="primary" large>mdi-instagram</v-icon>
                                <v-icon large>mdi-youtube</v-icon>
                                <v-icon large>mdi-blogger</v-icon>
                            </div>
                            <div class="followers text-start ml-4 mt-3 body-2">
                                <span class="mr-3 integrityColor--text">
                                    <strong class="mr-2 black--text">2.2K</strong>Posts
                                </span>
                                <span class="mr-3 integrityColor--text">
                                    <strong class="mr-2 black--text">40.2K</strong>Posts
                                </span>
                                <span class="mr-3 integrityColor--text">
                                    <strong class="mr-2 black--text">14.2K</strong>Posts
                                </span>
                            </div>
                            <div class="text-start ml-4 mt-2">
                                <p class="text-justify integrityColor--text caption">
                                    Morbi mattis ullamcorper velit. Donec orci lectus, aliquam ut, faucibus non, euismod id, nulla. Fusce convallis metus id felis luctus adipiscing.
                                </p>
                            </div>
                            <v-row>
                                <v-col>

                                </v-col>
                                <v-col>

                                </v-col>
                                <v-col>

                                </v-col>
                            </v-row>
                        </v-container>
                    </v-col>
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
               rating: 3,
            }
        },
        methods: {}
    }
</script>

<style scoped>
    .main_wrapper{
        width: 90%;
    }
    >>>.v-rating .v-icon{
        padding:0px;
    }
    .inner_wrapper{
        width: 60%;
        max-width: 60% !important;
    }
</style>
