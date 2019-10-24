<template>
    <v-flex>
        <v-card>
            <v-card-text>
                <v-row class="mx-auto px-12" justify="start">
                    <v-row justify="start">
                        <v-col cols="12" md="2" class="float-left">
                            <v-avatar height="120" width="120">
                                <v-img
                                    src="https://cdn.vuetifyjs.com/images/cards/store.jpg"
                                ></v-img>
                            </v-avatar>
                        </v-col>
                        <v-col class="text-center inner_wrapper" cols="12" md="10">
                            <v-container class="pa-0">
                                <v-card-title class="my-0 py-0">
                                    <div class="title mb-2 mr-4">
                                        <v-icon color="primary" large>mdi-instagram</v-icon>
                                        <strong>Amanda Nash</strong>
                                    </div>
                                    <v-rating v-model="rating" color="warning" class="mt-n4"></v-rating>
                                    <v-btn color="grayLighten pl-2 pr-2 ml-4 mr-2" class="text-capitalize" depressed height="30">
                                        Lifestyle
                                    </v-btn>
                                    <v-btn color="grayLighten pl-2 pr-2 ml-1" class="text-capitalize" depressed height="30">
                                        Fashion
                                    </v-btn>
                                </v-card-title>
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
                </v-row>
            </v-card-text>
        </v-card>

        <v-card class="mx-auto card_wrapper px-12 py-8" color="gutterDark">
            <v-card-text>
                <v-card class="mx-auto card_wrapper pa-3">
                    <v-list-item three-line style="border-bottom: 1px solid #cccccc">
                        <v-list-item-content>
                            <div class="caption text-uppercase">Touch Point # 1</div>
                            <v-list-item-title class="title">Orange Delight Scrub promotion</v-list-item-title>
                            <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-avatar tile min-width="120px" width="120px">
                            <v-btn depressed>In Progress</v-btn>
                        </v-list-item-avatar>
                    </v-list-item>
                    <v-card-text>
                        <v-layout row wrap class="hr_divider">
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Content Guidelines</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12 class="ma-auto white">
                                <p class="mb-0 pl-4">To win, all you have to do is:</p>
                                <v-list class="guide_list">
                                    <v-list-item
                                        v-for="item in list_items"
                                        :key="item.title"
                                        @click=""
                                        height="35"
                                        min-height="35"
                                    >
                                        <v-list-item-icon class="ma-0">
                                            <strong class="primary--text">{{item.number}}.</strong>
                                        </v-list-item-icon>
                                        <v-list-item-content class="mt-n3 py-0">
                                            <v-list-item-subtitle>
                                                {{item.title}}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Hashtags</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <v-btn class="ma-3 text-capitalize" color="grey lighten-2" depressed height="42">#Hashtag 1</v-btn>
                                <v-btn class="ma-3 text-capitalize" color="grey lighten-2" depressed height="42">#Hashtag 2</v-btn>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Brand Mentions</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <v-btn class="ma-3 text-lowercase" color="grey lighten-2" depressed height="42">@Mentions 1</v-btn>
                                <v-btn class="ma-3 text-lowercase" color="grey lighten-2" depressed height="42">@Mentions 2</v-btn>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Follow</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <v-btn class="ma-3 text-lowercase" color="grey lighten-2" depressed height="42">@Telefloral</v-btn>
                                <v-btn class="ma-3 text-lowercase" color="grey lighten-2" depressed height="42">@Telefloralofficial</v-btn>
                            </v-flex>
                        </v-layout>
                        <v-layout class="hr_divider" row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>No. Of friends Tagged</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <v-btn class="ma-3 text-lowercase" color="grey lighten-2" depressed height="42">5</v-btn>
                            </v-flex>
                        </v-layout>
                        <v-layout class="hr_divider" row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Images:</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <v-row :class="$vuetify.breakpoint.smAndUp ? '' : 'fix_width mx-auto'">
                                    <v-col
                                        v-for="n in 6"
                                        :key="n"
                                        class="xl3 lg3 md3 sm4 xs12"
                                    >
                                        <v-card flat tile class="d-flex">
                                            <v-img
                                                :src="`https://picsum.photos/500/300?image=${n * 5 + 10}`"
                                                :lazy-src="`https://picsum.photos/10/6?image=${n * 5 + 10}`"
                                                aspect-ratio="1"
                                                class="grey lighten-2"
                                            >
                                                <template v-slot:placeholder>
                                                    <v-row
                                                        class="fill-height ma-0"
                                                        align="center"
                                                        justify="center"
                                                    >
                                                        <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                                                    </v-row>
                                                </template>
                                            </v-img>
                                        </v-card>
                                    </v-col>
                                </v-row>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Start Date</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <p class="mb-0 mt-4">12-October-2019</p>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>End Date</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <p class="mb-0 mt-4">12-October-2019</p>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                </v-card>
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
               list_items: [
                   { number: 1, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
                   { number: 2, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
                   { number: 3, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'}
               ],
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
    .product_img {
        border-radius: 10px;
    }
    >>>.v-rating .v-icon{
        padding:0px;
    }
    .hr_divider {
        border-bottom: 1px solid #cccccc;
    }
    >>>.guide_list .v-list-item{
        min-height: 35px !important;
    }
</style>
