<template>
    <v-flex
        :class="$vuetify.breakpoint.mdAndUp ? 'ma-12' : 'mx-1 mt-5'"
    >
        <div class="subtitle-1 mb-2"><strong>Search Results</strong></div>
        <v-card class="card_wrapper">
            <v-flex
               :class="$vuetify.breakpoint.mdAndUp ? 'description_wrapper' : 'description_wrapper_sm'"
            >
                <v-card class="description_card ma-auto" width="80%" height="200">
                    <v-layout class="left-pane">
                        <div class="card_box"></div>
                    </v-layout>
                    <v-layout class="right-pane" style="background:#ccc">
                    </v-layout>
                </v-card>
            </v-flex>


            <v-flex class="ma-auto mt-5"
                :class="$vuetify.breakpoint.smAndUp ? 'common_wrapper' : 'full_width'"
            >
                <v-card class="description_card ma-auto" flat>
                    <v-layout row wrap>
                        <v-flex lg4 sm4 m4 xs12>
                            <v-card-title class="text-center">
                                <div class="subtitle-1 mb-2"><strong>Campaign Requirements</strong></div>
                            </v-card-title>
                        </v-flex>
                        <v-flex lg8 sm8 m8 xs12 class="ma-auto white">
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
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <hr class="my-3 hr_divider" />
            <v-flex color="black" class="ma-auto"
                    :class="$vuetify.breakpoint.smAndUp ? 'common_wrapper' : 'full_width'"
            >
                <v-card class="description_card ma-auto" flat>
                    <v-layout row wrap>
                        <v-flex lg4 sm4 m4 xs12>
                            <v-card-title class="text-center">
                                <div class="subtitle-1 mb-2"><strong>Touch Points</strong></div>
                            </v-card-title>
                        </v-flex>
                        <v-flex lg8 sm8 m8 xs12 class="ma-auto white">
                            <v-list class="list_cards">
                                <v-list-item v-for="i in 3" :key="i" :class="$vuetify.breakpoint.smAndUp ? '' : 'fix_width mx-auto'">
                                    <v-list-item-icon class="mr-0 mt-5">
                                        <strong class="primary--text">1.</strong>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-row class="mx-auto">
                                            <v-flex xl2 lg2 md2 sm2 xs2>
                                                <v-list-item-avatar height="49" min-width="100%" width="100%" class="ma-0 field_icon">
                                                    <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg"></v-img>
                                                </v-list-item-avatar>
                                            </v-flex>
                                            <v-flex xl8 lg8 md8 sm8 xs8>
                                                <v-text-field
                                                    label="Instagram image post"
                                                    solo
                                                    dense
                                                    class="custom_dropdown product_right_border product_left_border"
                                                ></v-text-field>
                                            </v-flex>
                                            <v-flex xl2 lg2 md2 sm2 xs2>
                                                <v-list-item-avatar height="50" min-width="45" width="45" class="ma-0 field_right_icon" color="grey lighten-2">
                                                    <span>$25</span>
                                                </v-list-item-avatar>
                                            </v-flex>
                                        </v-row>
                                        <p class="primary--text overline ma-0"><v-icon color="primary">mdi-instagram</v-icon> Lorem Ipsum is simply dummy text</p>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <hr class="my-3 hr_divider" />

            <v-flex class="ma-auto"
                    :class="$vuetify.breakpoint.smAndUp ? 'common_wrapper' : 'full_width'"
            >
                <v-card class="description_card ma-auto" flat>
                    <v-layout row wrap>
                        <v-flex lg4 sm4 m4 xs12>
                            <v-card-title class="text-center">
                                <div class="subtitle-1 mb-2"><strong>Hashtags</strong></div>
                            </v-card-title>
                        </v-flex>
                        <v-flex lg8 sm8 m8 xs12>
                            <v-btn
                                   v-for="(hashtag, index) in hashtags"
                                   :key="index"
                                   v-if="hashtag"
                                   class="ma-3 text-capitalize"
                                   color="grey lighten-2"
                                   depressed height="42"
                            >
                                #{{hashtag}}
                            </v-btn>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <hr class="my-3 hr_divider" />
            <v-flex class="ma-auto"
                    :class="$vuetify.breakpoint.smAndUp ? 'common_wrapper' : 'full_width'"
            >
                <v-card class="description_card ma-auto" flat>
                    <v-layout row wrap>
                        <v-flex lg4 sm4 m4 xs12>
                            <v-card-title class="text-center">
                                <div class="subtitle-1 mb-2"><strong>Brand Mentions</strong></div>
                            </v-card-title>
                        </v-flex>
                        <v-flex lg8 sm8 m8 xs12>
                            <v-btn
                                v-for="(mention, index) in mentions"
                                :key="index"
                                v-if="mention"
                                class="ma-3 text-lowercase"
                                color="grey lighten-2"
                                depressed height="42"
                            >
                                @{{mention}}
                            </v-btn>

                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <hr class="my-3 hr_divider" />
            <v-flex class="ma-auto my-3"
                    :class="$vuetify.breakpoint.smAndUp ? 'common_wrapper' : 'full_width'"
            >
                <v-card class="description_card ma-auto" flat>
                    <v-layout row wrap>
                        <v-flex lg4 sm4 m4 xs12>
                            <v-card-title class="text-center">
                                <div class="subtitle-1 mb-2"><strong>Captions</strong></div>
                            </v-card-title>
                        </v-flex>
                        <v-flex lg8 sm8 m8 xs12 class="ma-auto white">
                            <p class="ma-0" :class="$vuetify.breakpoint.smAndUp ? '' : 'fix_width mx-auto'">{{ touchPoint.caption }}</p>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <hr class="my-3 hr_divider" />
            <v-flex class="ma-auto my-3"
                    :class="$vuetify.breakpoint.smAndUp ? 'common_wrapper' : 'full_width'"
            >
                <v-card class="description_card ma-auto" flat>
                    <v-layout row wrap>
                        <v-flex lg4 sm4 m4 xs12>
                            <v-card-title class="text-center">
                                <div class="subtitle-1 mb-2"><strong>Images</strong></div>
                            </v-card-title>
                        </v-flex>
                        <v-flex lg8 sm8 m8 xs12 class="ma-auto white">
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
                </v-card>
            </v-flex>

            <hr class="my-3 hr_divider" />

            <v-flex color="black" class="ma-auto"
                    :class="$vuetify.breakpoint.smAndUp ? 'common_wrapper' : 'full_width'"
            >
                <v-card class="description_card ma-auto" flat>
                    <v-layout row wrap>
                        <v-flex lg4 sm4 m4 xs12>
                            <v-card-title class="text-center">
                                <div class="subtitle-1 mb-2"><strong>Content Guidelines</strong></div>
                            </v-card-title>
                        </v-flex>
                        <v-flex lg8 sm8 m8 xs12 class="ma-auto white">
                            <v-list>
                                <v-list-item
                                    v-for="(guideline, guidelineIndex) in touchPoint.guideLines"
                                    :key="guidelineIndex"
                                >
                                        <v-list-item-icon class="mr-0" v-if="guidelineIndex != 0">
                                            <strong class="primary--text">{{ guidelineIndex }}.</strong>
                                        </v-list-item-icon>
                                        <v-list-item-content v-if="guidelineIndex != 0">
                                            <v-list-item-subtitle>
                                                {{ guideline }}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
        </v-card>
    </v-flex>
</template>

<script>
    import {mapGetters, mapActions, mapMutations} from 'vuex';
    export default {
        components: {

        },
        data: () => {
           return  {
               hashtags : null,
               mentions : null,
            }
        },
        methods: {

        },
        computed: {
            ...mapGetters({
                touchPoint: 'campaign/touchPoint'
            })
        },
        watch : {
            'touchPoint.hashtags' : {
                handler: function(newVal, oldVal) {
                    this.hashtags = newVal.split(',');
                 },
                immediate: false,
                deep: false
            },
            'touchPoint.mentions' : {
                handler: function(newVal, oldVal) {
                    this.mentions = newVal.split(',');
                },
                immediate: false,
                deep: false
            }
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

    .description_wrapper_sm{
        background:linear-gradient(90deg, #ee6f6e 0%,#fea57e 100% );
        padding: 30px 15px;
    }
    .left-pane {
        width: 25% !important;
        position: relative;
    }
    .right-pane {
        width: 75% !important;
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
        -ms-transform: translateY(30%);
        transform: translateY(30%);
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
        display: inline-table;
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


    >>>.custom_dropdown .v-input__control{
        min-height: 50px !important;
    }
    >>>.custom_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    >>>.custom_dropdown .v-input__prepend-inner .v-input__icon, >>>.product_field .v-input__prepend-inner .v-input__icon{
        background: #EE6F6F;
        padding: 24px;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }
    >>>.custom_dropdown .v-input__prepend-inner .v-icon.v-icon, >>>.product_field .v-input__prepend-inner .v-icon.v-icon{
        color: #ffffff !important;
    }
    >>>.custom_dropdown .v-input__prepend-inner, >>>.product_field  .v-input__prepend-inner{
        margin-top: 0px !important;
        margin-left: -14px;
    }
    .field_icon{
        border-radius: 0px;
        border-top-left-radius: 5px !important;
        border-bottom-left-radius: 5px !important;
    }
    >>>.product_left_border .v-input__slot {
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .field_right_icon {
        border-radius: 0px;
        border-top-right-radius: 5px !important;
        border-bottom-right-radius: 5px !important;
    }
    >>>.product_right_border .v-input__slot {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    .fix_width {
        width: 90% !important;
    }

    @media only screen
    and (min-device-width: 960px)
    and (max-device-width: 1366px)
    and (-webkit-min-device-pixel-ratio: 1) {
        .common_wrapper {
            width:90% !important;
            clear: both !important;
        }
    }

    .hr_divider {
        height:1px;
        border:none;
        color:#333;
        background-color:#333;
    }
</style>
