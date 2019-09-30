<template>
    <v-flex>
        <v-card>
            <v-card-text>
                <v-row class="mx-auto" justify="start">
                    <v-badge color="transparent">
                        <template v-slot:badge>
                            <v-icon class="display-1 mt-5">
                                mdi-chat
                            </v-icon>
                            <v-icon class="display-1 mt-5">
                                mdi-close
                            </v-icon>
                        </template>
                        <v-row justify="start">
                            <v-col cols="12" md="2" class="float-left">
                                <v-avatar height="150" width="150">
                                    <v-img
                                        src="https://cdn.vuetifyjs.com/images/cards/store.jpg"
                                    ></v-img>
                                </v-avatar>
                            </v-col>
                            <v-col class="text-center inner_wrapper mt-8" cols="12" md="10">
                                <v-card-title class="my-0 py-0">
                                    <div class="headline mb-2 mr-4">
                                        <v-icon color="primary" large>mdi-instagram</v-icon>
                                        <strong>Amanda Nash</strong>
                                    </div>
                                    <v-rating v-model="rating" color="warning" class="mt-n4"></v-rating>
                                    <v-btn color="grayLighten pl-2 pr-2 ml-4 mr-2" depressed height="30">
                                        Lifestyle
                                    </v-btn>
                                    <v-btn color="grayLighten pl-2 pr-2 ml-1" depressed height="30">
                                        Fashion
                                    </v-btn>
                                    <v-spacer></v-spacer>
                                    <v-btn color="success" class="mr-12" depressed>
                                        Accept Proposal
                                    </v-btn>
                                </v-card-title>
                                <v-container class="pa-0">
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
                                </v-container>
                            </v-col>
                        </v-row>
                    </v-badge>
                </v-row>
            </v-card-text>
        </v-card>

        <v-card class="mx-auto card_wrapper pa-12" color="gutterDark">
            <v-card-title>
                <div class="subtitle-1 mb-2"><strong>Touch Points Overview</strong></div>
            </v-card-title>
            <v-card-text>
                <v-simple-table>
                    <tbody>
                    <tr v-for="i in 8" :key="i" class="my-3">
                        <td class="text-center">
                            <v-layout row>
                                <v-flex md2 p>
                                    <v-btn class="btn_class" color="primary" height="48px">
                                        1
                                    </v-btn>
                                </v-flex>
                                <v-flex md10>
                                    <v-text-field class="text_class" label="Promoting Global Real Estate Licence" readonly type="text" solo></v-text-field>
                                </v-flex>
                            </v-layout>
                        </td>
                        <td class="text-center">
                            Original Price: <span class="primary--text">$18</span>
                        </td>
                        <td class="text-center">
                            Influencer Requested: <span class="primary--text">$18</span>
                        </td>
                        <td class="column_border text-center">
                            <v-icon class="display-1" color="primary">
                                mdi-close
                            </v-icon>
                        </td>
                        <td class="text-center">
                            <v-icon class="display-1" color="success">
                                mdi-check
                            </v-icon>
                        </td>
                    </tr>
                    </tbody>
                </v-simple-table>
            </v-card-text>
        </v-card>
    </v-flex>
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
    >>>.v-badge{
        width: 95%;
    }
    >>>.v-text-field__details{
        display: none;
    }
    >>>.btn_class {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    >>>.text_class{
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .column_border{
        border-left:1px solid #cccccc;
        border-right:1px solid #cccccc;
    }
</style>
