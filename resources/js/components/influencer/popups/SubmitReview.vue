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
                        <v-layout row wrap class="hr_divider pl-4">
                            <v-row justify="start">
                                <v-col cols="12" md="2" class="text-left">
                                    <v-img height="70" width="70" class="mx-auto product_img" src="https://cdn.vuetifyjs.com/images/cards/store.jpg"></v-img>
                                </v-col>
                                <v-col cols="12" md="9" class="text-left">
                                    <p class="mb-1 dark--text">Orange Light Scrub</p>
                                    <v-btn color="primary" class="overline text-capitalize" depressed>
                                        Copy Product Url
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-layout>
                        <v-layout row wrap class="pa-4">
                            <v-flex lg12 sm12 m12 xs12>
                                <div class="title black--text mb-2 text-uppercase font-weight-medium">Submit for Review</div>
                                <label class="body-1 mb-1">Write Your Caption Here</label>
                                <v-textarea
                                    outlined
                                    name="input-7-4"
                                    rows="4"
                                    class="custom_dropdown"
                                ></v-textarea>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap class="pl-4 pt-2 pr-4">
                            <v-flex lg6 sm6 m6 xs12>
                                <label class="body-1 mb-3 d-block">Upload Associated Images</label>
                                <image-input v-model="avatar1" class="d-inline-block">
                                    <div slot="activator">
                                        <v-avatar size="70" v-ripple v-if="!avatar1" class="avatar_class lighten-3 mb-3" tile min-height="61" min-width="64" max-height="61" max-width="64">
                                            <v-icon class="display-2">mdi-image-outline</v-icon>
                                        </v-avatar>
                                        <v-avatar size="70" v-else class="mb-3" tile min-height="61" min-width="64" max-height="61" max-width="64">
                                            <v-img class="white--text align-end" :src="avatar1.imageURL" alt="avatar"></v-img>
                                        </v-avatar>
                                        <label class="caption d-block text-center">Upload</label>
                                    </div>
                                </image-input>
                                <image-input v-model="avatar2" class="d-inline-block ml-2">
                                    <div slot="activator">
                                        <v-avatar size="70" v-ripple v-if="!avatar2" class="avatar_class lighten-3 mb-3" tile min-height="61" min-width="64" max-height="61" max-width="64">
                                            <v-icon class="display-2">mdi-image-outline</v-icon>
                                        </v-avatar>
                                        <v-avatar size="70" v-else class="mb-3" tile min-height="61" min-width="64" max-height="61" max-width="64">
                                            <v-img class="white--text align-end" :src="avatar2.imageURL" alt="avatar"></v-img>
                                        </v-avatar>
                                        <label class="caption d-block text-center">Upload</label>
                                    </div>
                                </image-input>
                                <image-input v-model="avatar3" class="d-inline-block ml-2">
                                    <div slot="activator">
                                        <v-avatar size="70" v-ripple v-if="!avatar3" class="avatar_class lighten-3 mb-3" tile min-height="61" min-width="64" max-height="61" max-width="64">
                                            <v-icon class="display-2">mdi-image-outline</v-icon>
                                        </v-avatar>
                                        <v-avatar size="70" v-else class="mb-3" tile min-height="61" min-width="64" max-height="61" max-width="64">
                                            <v-img class="white--text align-end" :src="avatar3.imageURL" alt="avatar"></v-img>
                                        </v-avatar>
                                        <label class="caption d-block text-center">Upload</label>
                                    </div>
                                </image-input>
                            </v-flex>
                            <v-flex lg6 sm6 m6 xs12>
                                <label class="body-1 mb-3">Add Post URL</label>
                                <v-text-field
                                    outlined
                                    name="input-7-4"
                                    class="custom_input"
                                ></v-text-field>
                                <v-btn color="primary" class="overline text-capitalize float-right" depressed>
                                    Submit For Review
                                </v-btn>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                </v-card>
            </v-card-text>
        </v-card>
    </v-flex>
</template>

<script>
    import ImageInput from '../../general/ImageInput';
    export default {
        components: {
            ImageInput: ImageInput
        },
        data: () => {
           return  {
               rating: 3,
               list_items: [
                   { number: 1, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
                   { number: 2, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
                   { number: 3, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'}
               ],
               avatar1: null,
               avatar2: null,
               avatar3: null,
               saving: false,
               saved: false
            }
        },
        methods: {},
        watch:{
            avatar1: {
                handler: function() {
                    this.saved = false
                },
                deep: true
            },
            avatar2: {
                handler: function() {
                    this.saved = false
                },
                deep: true
            },
            avatar3: {
                handler: function() {
                    this.saved = false
                },
                deep: true
            }
        }
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
    >>>.custom_input .v-input__control, >>>.custom_input .v-input__control .v-input__slot{
        min-height: 45px !important;
    }
    .avatar_class{
        border: 1px solid #cccc !important;
        border-radius: 5px;
    }
</style>
