<template>
    <v-flex class="ma-12">
        <div class="subtitle-1 mb-2"><strong>Search Results</strong></div>
        <v-card class="card_wrapper">
            <v-flex class="description_wrapper">
                <v-card class="description_card ma-auto" width="80%" height="200">
                    <v-layout class="left-pane">
                        <div class="card_box"></div>
                    </v-layout>
                    <v-layout class="right-pane" style="background:#ccc">
                    </v-layout>
                </v-card>
            </v-flex>


            <v-flex class="common_wrapper ma-auto mt-5">
                <v-card class="description_card ma-auto" flat>
                    <v-layout class="left-pane">
                        <card-title>
                            <div class="subtitle-1 mb-2"><strong>Campaign Requirements</strong></div>
                        </card-title>
                    </v-layout>
                    <v-layout class="right-pane ma-auto">
                            <div class="parent_box ma-3">
                                <v-badge overlap color="accent">
                                    <template v-slot:badge>0</template>
                                    <div class="child_box pa-5">
                                        Instagram Post
                                    </div>
                                </v-badge>
                            </div>

                        <div class="parent_box ma-3">
                            <v-badge overlap color="accent">
                                <template v-slot:badge>0</template>
                                <div class="child_box pa-5">
                                    Instagram Story
                                </div>
                            </v-badge>
                        </div>
                    </v-layout>
                </v-card>
            </v-flex>

            <v-flex class="common_wrapper ma-auto" color="black">
                <v-card class="description_card ma-auto" flat>
                    <v-layout class="left-pane">
                        <card-title>
                            <div class="subtitle-1 mb-2"><strong>Touch Points</strong></div>
                        </card-title>
                    </v-layout>
                    <v-layout class="right-pane ma-auto inline_display">
                        <v-list class="list_cards">
                            <v-list-item v-for="i in 3" :key="i">
                                <v-list-item-icon class="mr-0 mt-5">
                                    <strong class="primary--text">1.</strong>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-row class="mx-auto">
                                        <v-flex xl2 lg2 md2 sm2 xs2>
                                            <v-list-item-avatar height="40" min-width="40" width="40">
                                                <v-img src="/images/avtar.png"></v-img>
                                            </v-list-item-avatar>
                                        </v-flex>
                                        <v-flex xl10 lg10 md10 sm10 xs10>
                                            <v-text-field
                                                solo
                                                label="Instagram post"
                                                append-icon="place"
                                                class="touch_field"
                                                readonly
                                            ></v-text-field>
                                        </v-flex>
                                    </v-row>
                                    <p class="primary--text overline ma-0"><v-icon color="primary">mdi-instagram</v-icon> Lorem Ipsum is simply dummy text</p>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-layout>
                </v-card>
            </v-flex>


            <v-flex class="common_wrapper ma-auto">
                <v-card class="description_card ma-auto" flat>
                    <v-layout class="left-pane">
                        <card-title>
                            <div class="subtitle-1 mb-2"><strong>Hashtags</strong></div>
                        </card-title>
                    </v-layout>
                    <v-layout class="right-pane ma-auto">
                        <v-btn class="ma-3" small>#Hashtag 1</v-btn>
                        <v-btn class="ma-3" small>#Hashtag 1</v-btn>
                    </v-layout>
                </v-card>
            </v-flex>

            <v-flex class="common_wrapper ma-auto">
                <v-card class="description_card ma-auto" flat>
                    <v-layout class="left-pane">
                        <card-title>
                            <div class="subtitle-1 mb-2"><strong>Brand Mentions</strong></div>
                        </card-title>
                    </v-layout>
                    <v-layout class="right-pane ma-auto">
                        <v-btn class="ma-3" small>@Mentions 1</v-btn>
                        <v-btn class="ma-3" small>@Mentions 2</v-btn>
                    </v-layout>
                </v-card>
            </v-flex>

            <v-flex class="common_wrapper ma-auto my-3">
                <v-card class="description_card ma-auto" flat>
                    <v-layout class="left-pane">
                        <card-title>
                            <div class="subtitle-1 mb-2"><strong>Captions</strong></div>
                        </card-title>
                    </v-layout>
                    <v-layout class="right-pane ma-auto">
                        <p class="ma-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </v-layout>
                </v-card>
            </v-flex>

            <v-flex class="common_wrapper ma-auto my-3">
                <v-card class="description_card ma-auto" flat>
                    <v-layout class="left-pane">
                        <card-title>
                            <div class="subtitle-1 mb-2"><strong>Images</strong></div>
                        </card-title>
                    </v-layout>
                    <v-layout class="right-pane ma-auto">
                        <v-row>
                            <v-col
                                v-for="n in 6"
                                :key="n"
                                class="d-flex child-flex"
                                cols="3"
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
                    </v-layout>
                </v-card>
            </v-flex>

            <v-divider></v-divider>

            <v-flex class="common_wrapper ma-auto" color="black">
                <v-card class="description_card ma-auto" flat>
                    <v-layout class="left-pane">
                        <card-title>
                            <div class="subtitle-1 mb-2"><strong>Content Guidelines</strong></div>
                        </card-title>
                    </v-layout>
                    <v-layout class="right-pane ma-auto inline_display">
                        <v-list>
                            <v-list-item
                                v-for="item in list_items"
                                :key="item.title"
                                @click=""
                            >
                                <v-list-item-icon class="mr-0">
                                    <strong class="primary--text">{{item.number}}.</strong>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-subtitle>

                                        {{item.title}}
                                    </v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-layout>
                </v-card>
            </v-flex>

            <v-divider></v-divider>


        </v-card>
    </v-flex>
</template>

<script>
    export default {
        components: {

        },
        data: () => {
           return  {
               list_items: [
                   { number: 1, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
                   { number: 2, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
                   { number: 3, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'}
               ],
            }
        },
        methods: {

        }
    }
</script>

<style scoped>
    .card_wrapper {
        border-radius: 10px !important;
    }
    >>>.touch_field > .v-input__control > .v-input__slot{
        padding-right: 0px !important;
    }
    >>>.touch_field .v-input__append-inner{
        margin-top: 0px !important;
    }
    >>>.touch_field .v-input__append-inner .v-input__icon{
        background: #dcdcdc;
        padding: 28px;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }
    >>>.touch_field .v-input__append-inner .v-icon.v-icon{
        color: #2f2f2f !important;
    }
    >>>.list_cards .v-avatar{
        border-radius: 0px !important;
    }
    >>>.list_cards .v-text-field__details{
        display: none !important;
    }
    >>>.list_cards .v-list-item__content, >>>.list_cards  .v-list-item{
        padding:0px !important;
    }



    .description_wrapper{
        background:linear-gradient(90deg, #ee6f6e 0%,#fea57e 100% );
        padding: 50px 90px;
    }
    .left-pane {
        width: 25% !important;
        position: relative;
    }
    .right-pane {
        width: 75% !important;
    }
    .common_wrapper .left-pane {
        width: 40% !important;
    }
    .common_wrapper .right-pane {
        width: 60% !important;
        background:none !important;
    }
    .card_box {
        height: 120px;
        width: 120px;
        background: yellow;
        margin-left: -25px;
        border-radius: 10px;
        top: 50%;
        position: absolute;
        vertical-align: middle;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    .common_wrapper {
        width:65% !important;
        clear: both !important;
    }
    .parent_box {
        background: red;
        width: 120px;
        height: 120px;
        border-radius: 10px;
        background:#FFA67D;
    }
    .child_box {
        background: red;
        width: 120px;
        height: 120px;
        border-radius: 10px;
        background:linear-gradient(90deg, #ee6f6e 0%,#fea57e 100% );
        margin-top:10px;
        margin-left:10px;
        color: #fff;
    }

    .parent_box:last-child {
        background: red;
        width: 120px;
        height: 180px;
        border-radius: 10px;
        background:#FFA67D;
    }
    .parent_box:last-child .child_box {
        background: red;
        width: 120px;
        height: 180px;
        border-radius: 10px;
        background:linear-gradient(90deg, #ee6f6e 0%,#fea57e 100% );
        margin-top:10px;
        margin-left:10px;
        color: #fff;
    }
    .parent_box .v-badge{
        position: absolute !important;
    }
    .inline_display{
        display: inline-block !important;
    }
    .inline_display .v-list-item__subtitle{
        word-wrap: break-word !important;
        white-space: initial !important;
    }

    .right-pane .v-data-table thead, .right-pane .v-data-table tfoot{
        background: #cccccc !important;
    }
    .right-pane .v-data-table td{
        font-size: 10px !important;
    }
    >>>.right-pane .v-data-table tfoot tr:first-child{
        font-size: 24px !important;
        font-weight: bolder;
    }
</style>
