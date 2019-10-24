<template>
    <div>
        <v-flex class="ma-12">
            <div class="subtitle-1 mb-2"><strong>Amanda's Profile</strong></div>
            <v-card class="mx-auto card_wrapper">
                <span class="primary--text pl-8 pt-8" style="position: absolute"><u>Back</u></span>
                <v-row class="py-12 mx-auto main_wrapper">
                    <v-badge color="primary">
                        <template v-slot:badge>
                            <v-icon dark>
                                mdi-chat
                            </v-icon>
                        </template>
                        <div class="top_wrapper">
                            <v-col class="image_wrapper">
                                <v-avatar height="150" width="150">
                                    <v-img
                                        src="https://cdn.vuetifyjs.com/images/cards/store.jpg"
                                    ></v-img>
                                </v-avatar>
                            </v-col>
                            <v-col class="text-center inner_wrapper">
                                <v-container class="pa-0">
                                    <v-card-title class="my-0 py-0">
                                        <div class="headline mb-2 mr-4"><strong>Amanda Nash</strong></div>
                                        <v-rating v-model="rating" color="warning" class="mt-n4"></v-rating>
                                        <v-btn color="grayLighten pl-2 pr-2 ml-4 mr-2 text-capitalize" depressed height="30">
                                            Lifestyle
                                        </v-btn>
                                        <v-btn color="grayLighten pl-2 pr-2 ml-1 text-capitalize" depressed height="30">
                                            Fashion
                                        </v-btn>
                                    </v-card-title>
                                    <div class="text-start ml-4 mt-n2">
                                        <p class="overline integrityColor--text text-capitalize" color="grayLighten">Amanda Nash</p>
                                    </div>
                                    <div class="icons text-start ml-4">
                                        <v-icon color="primary" large class="mr-3">mdi-instagram</v-icon>
                                        <v-icon color="integrityColor" large>mdi-youtube</v-icon>
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
                                    <div class="icons text-start ml-4">
                                        <span class="custom_icon"><v-icon color="red">mdi-fire</v-icon></span>
                                        <span class="custom_icon"><v-icon color="indigo">mdi-shield-half-full</v-icon></span>
                                        <span class="custom_icon"><v-icon color="warning">mdi-wifi-strength-4</v-icon></span>
                                    </div>
                                    <div class="buttons text-right mt-n6">
                                        <v-spacer></v-spacer>
                                        <v-dialog v-model="proposal" max-width="70%" transition="slide-y-reverse-transition">
                                            <template v-slot:activator="{ on }">
                                                <v-btn color="grayLighten ml-4 mr-2 text-capitalize" depressed height="32" v-on="on">
                                                    Invite to campaign
                                                </v-btn>
                                            </template>
                                            <Proposal></Proposal>
                                        </v-dialog>
                                        <v-dialog v-model="touchPoint" max-width="50%" transition="slide-y-reverse-transition">
                                            <template v-slot:activator="{ on }">
                                                <v-btn color="primary ml-1 text-capitalize" depressed height="32" v-on="on">
                                                    Make Offer
                                                </v-btn>
                                            </template>
                                            <TouchPoint></TouchPoint>
                                        </v-dialog>
                                    </div>
                                </v-container>
                            </v-col>
                        </div>
                    </v-badge>
                </v-row>
            </v-card>

            <v-card class="mx-auto card_wrapper" color="gutterDark">
                <v-row class="py-12 mx-auto main_wrapper">
                    <v-row align="center" class="full_width">
                        <v-col class="d-flex" cols="4">
                            <div class="subtitle-1 mb-2"><strong>Instagram Stats Overview</strong></div>
                        </v-col>
                        <v-spacer></v-spacer>
                        <v-col class="d-flex" cols="2">
                            <v-select :items="items" label="Platform" solo class="custom_dropdown" append-icon="keyboard_arrow_down"></v-select>
                        </v-col>
                        <v-col class="d-flex" cols="2">
                            <v-select :items="items" label="From" solo class="custom_dropdown" append-icon="keyboard_arrow_down"></v-select>
                        </v-col>
                    </v-row>

                    <v-row class="full_width" align="center">
                        <v-col class="d-flex" cols="3">
                            <v-card min-width="100%">
                                <v-card-title class="overline1">
                                    Media Posts (last 30 days)
                                    <v-spacer></v-spacer>
                                    <div class="icons text-end">
                                        <span class="custom_icon bg1"><v-icon class="title" color="#C73EA9">mdi-instagram</v-icon></span>
                                    </div>
                                </v-card-title>
                                <v-card-text class="display-1 pb-0"><strong color="darkSecondary">178</strong></v-card-text>
                                <v-card-actions class="pl-5">
                                    <span class="error--text mr-2">
                                        <v-icon color="error" small>mdi-arrow-down</v-icon>13.8%
                                    </span>
                                    <span class="overline1">Less post then ussual.</span>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                        <v-col class="d-flex" cols="3">
                            <v-card min-width="100%">
                                <v-card-title class="overline1">
                                    Media Posts (last 30 days)
                                    <v-spacer></v-spacer>
                                    <div class="icons text-end">
                                        <span class="custom_icon bg2"><v-icon class="title" color="#1788F9">mdi-account-clock-outline</v-icon></span>
                                    </div>
                                </v-card-title>
                                <v-card-text class="display-1 pb-0"><strong color="darkSecondary">148.5K</strong></v-card-text>
                                <v-card-actions class="pl-5">
                                    <span class="success--text mr-2">
                                        <v-icon color="success" small>mdi-arrow-up</v-icon>13.8%
                                    </span>
                                    <span class="overline1">Less post then ussual.</span>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                        <v-col class="d-flex" cols="3">
                            <v-card min-width="100%">
                                <v-card-title class="overline1">
                                    Media Posts (last 30 days)
                                    <v-spacer></v-spacer>
                                    <div class="icons text-end">
                                        <span class="custom_icon bg3"><v-icon class="title" color="primary">mdi-heart</v-icon></span>
                                    </div>
                                </v-card-title>
                                <v-card-text class="display-1 pb-0"><strong color="darkSecondary">148.5K</strong></v-card-text>
                                <v-card-actions class="pl-5">
                                    <span class="success--text mr-2">
                                        <v-icon color="success" small>mdi-arrow-down</v-icon>13.8%
                                    </span>
                                    <span class="overline1">Less post then ussual.</span>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                        <v-col class="d-flex" cols="3">
                            <v-card min-width="100%">
                                <v-card-title class="overline1">
                                    Media Posts (last 30 days)
                                    <v-spacer></v-spacer>
                                    <div class="icons text-end">
                                        <span class="custom_icon bg4"><v-icon color="#FDBA2C" class="title">mdi-tooltip</v-icon></span>
                                    </div>
                                </v-card-title>
                                <v-card-text class="display-1 pb-0"><strong color="darkSecondary">17.1K</strong></v-card-text>
                                <v-card-actions class="pl-5">
                                    <span class="error--text mr-2">
                                        <v-icon color="error" small>mdi-arrow-down</v-icon>13.8%
                                    </span>
                                    <span class="overline1">Less post then ussual.</span>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                    </v-row>

                    <div class="subtitle-1 mb-3 mt-3"><strong>Featured Posts</strong></div>

                    <v-row class="full_width" align="center">
                        <v-col class="d-flex" cols="4" v-for="i in 15" :key="i">
                            <v-card
                                max-width="344"
                                class="mx-auto"
                            >
                                <v-list-item>
                                    <v-list-item-avatar color="grey"></v-list-item-avatar>
                                    <v-list-item-content>
                                        <v-list-item-title class="subtitle-2">Amanda Nash</v-list-item-title>
                                        <v-list-item-subtitle class="caption">by Kurt Wagner</v-list-item-subtitle>
                                    </v-list-item-content>

                                    <v-btn color="primary" class="text-capitalize" depressed height="30">
                                        View Profile
                                    </v-btn>
                                </v-list-item>

                                <v-img
                                    src="https://cdn.vuetifyjs.com/images/cards/mountain.jpg"
                                    height="194"
                                ></v-img>

                                <v-card-text class="py-2">
                                    <strong class="primary--text">View more on instagram</strong>
                                </v-card-text>

                                <v-card-actions class="action_class">
                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on }">
                                            <v-icon v-on="on" class="mr-2">mdi-heart-outline</v-icon>
                                        </template>
                                        <span>1,7524 likes</span>
                                    </v-tooltip>
                                    <v-icon class="mr-2">mdi-tooltip-outline</v-icon>
                                    <v-icon>mdi-briefcase-upload-outline</v-icon>
                                    <div class="flex-grow-1"></div>
                                    <v-btn icon>
                                        <v-icon>mdi-share-variant</v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                    </v-row>
                    <div class="full_width text-end"><v-btn large text>Back</v-btn></div>
                </v-row>
            </v-card>
        </v-flex>
    </div>
</template>

<script>
import Proposal from '../popups/Proposal'
import TouchPoint from '../popups/TouchPoint'

    export default {
        components: {
            Proposal:Proposal,
            TouchPoint:TouchPoint
        },
        data: () => {
           return  {
               rating: 3,
               items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
               show: true,
               proposal: false,
               touchPoint: false
            }
        },
        methods: {}
    }
</script>

<style scoped>
    .main_wrapper{
        width: 85%;
    }
    >>>.card_wrapper .v-badge__badge{
        margin-top: 20px !important;
        padding: 15px;
        border-radius: 50px;
        height:auto !important;
    }
    >>>.v-sheet{
        border-bottom-left-radius: 0px !important;
        border-bottom-right-radius: 0px !important;
    }
    >>>.gutterDark.v-sheet{
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
    >>>.v-rating .v-icon{
        padding:0px;
    }
    .inner_wrapper{
        max-width: 55% !important;
        float: left !important;
    }
    .image_wrapper{
        max-width: 17% !important;
        float: left !important;
    }
    .icons .custom_icon{
        padding: 4px 2px;
        border-radius: 50px;
        height: auto !important;
        background: #FDE0E1;
        border: 3px solid #fff;
        -webkit-box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.2);
        -moz-box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.2);
        box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.2);
    }
    .icons .custom_icon:nth-child(2) {
        background: #D8CEFD;
    }
    .icons .custom_icon:nth-child(3) {
        background: #FEF7DA;
    }
    .overline1{
        font-size: 11px;
    }
    .overline1 .custom_icon{
        padding: 8px 6px !important;
        border-radius: 50px;
        height: auto !important;
        border: none;
        box-shadow: none;
    }
    >>>.v-btn {
        font-size: 10px !important;
    }
    .action_class {
        border-top: 1px solid #ccc;
    }
    >>>.custom_dropdown .v-input__control{
        min-height: 45px !important;
    }
    >>>.custom_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    .bg1{
        background: #F7E1F2 !important;
    }
    .bg2{
        background: #DCECFC !important;
    }
    .bg3{
        background: #FBDFE0 !important;
    }
    .bg4{
        background: #FFF6DA !important;
    }
</style>
