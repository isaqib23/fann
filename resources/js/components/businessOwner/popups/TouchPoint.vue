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
                                    <div class="headline mb-2 mr-4">
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
                    <v-card-title style="border-bottom: 1px solid #cccccc">
                        <div class="body-1 mb-2 text-uppercase"><strong>Touch Points #1</strong></div>
                        <v-spacer></v-spacer>
                        <div class="body-1 mb-2 text-uppercase"><strong>Status <v-icon class="overline" color="warning">mdi-circle</v-icon></strong></div>
                    </v-card-title>
                    <v-card-text>
                        <v-row justify="start">
                            <v-col cols="12" md="4" class="text-left">
                                <div class="body-1 mb-2 black--text" ><strong>Product</strong></div>
                            </v-col>
                            <v-col cols="12" md="8">
                                <v-row justify="start">
                                    <v-col cols="12" md="3" class="text-left">
                                        <v-img height="70" width="70" class="product_img" src="https://cdn.vuetifyjs.com/images/cards/store.jpg"></v-img>
                                    </v-col>
                                    <v-col cols="12" md="9" class="text-left">
                                        <p class="mb-1 dark--text">Orange Light Scrub</p>
                                        <v-btn color="primary" class="overline text-capitalize" depressed>
                                            Copy Product Url
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                        <v-row justify="start">
                            <v-col cols="12" md="4" class="text-left">
                                <div class="body-1 mb-2 black--text" ><strong>Caption</strong></div>
                            </v-col>
                            <v-col cols="12" md="8">
                                <p class="mb-1 dark--text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                            </v-col>
                        </v-row>
                        <v-row justify="start">
                            <v-col cols="12" md="4" class="text-left">
                                <div class="body-1 mb-2 black--text" ><strong>Associated Images</strong></div>
                            </v-col>
                            <v-col cols="12" md="8">
                                <v-row>
                                    <v-col
                                        v-for="n in 9"
                                        :key="n"
                                        class="d-flex child-flex"
                                        cols="4"
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
                            </v-col>
                        </v-row>
                        <v-row justify="start">
                            <v-col cols="12" md="4" class="text-left">
                                <div class="body-1 mb-2 black--text" ><strong>Post URL</strong></div>
                            </v-col>
                            <v-col cols="12" md="8">
                                <v-text-field
                                    label="https://vuetifyjs.com/en/components/text-fields#text-fields"
                                    solo
                                    readonly
                                ></v-text-field>
                            </v-col>
                        </v-row>
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
</style>
