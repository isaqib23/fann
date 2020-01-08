<template>

    <v-container fluid style="width: 85%">
        <v-layout wrap class="pa-12">
            <v-flex xs12>
                <v-card class="description_wrapper">
                    <v-row>
                        <v-col cols="12" md="12" xs="12">
                            <v-btn icon @click="preTab()" class="nav_control nav_left" style="">
                                <v-icon right>keyboard_arrow_left</v-icon>
                            </v-btn>
                            <v-card width="85%" class="mx-auto py-3">
                                <v-list three-line>
                                    <v-list-item>
                                        <v-list-item-avatar class="brand_logo" tile height="120" width="120" min-width="120">
                                            <v-img src="https://cdn.vuetifyjs.com/images/cards/cooking.png"></v-img>
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-list-item-title>
                                                <v-list-item-avatar class="brand_logo2 mr-2 ml-0 my-1" tile height="30" width="30" min-width="30">
                                                    <v-img v-if="campaignInformation === null" src="/images/icons/company_placeholder.png"></v-img>
                                                    <v-img v-else :src="'/images/'+campaignInformation.company_logo"></v-img>
                                                </v-list-item-avatar>
                                                <span class="subtitle-1 text-uppercase">
                                                    {{ (campaignInformation !== null) ? campaignInformation.company_name : ''}}
                                                </span>
                                            </v-list-item-title>
                                            <v-list-item-subtitle class="py-0 my-0">
                                                <p class=" mb-0 mr-5 d-inline-block subtitle-1 black--text font-weight-bold">
                                                    {{ (campaignInformation !== null) ? campaignInformation.name : ''}}
                                                </p>
                                                <v-chip class="mr-2">
                                                    {{ (campaignObjective !== null) ? campaignObjective.name : ''}}
                                                </v-chip>
                                                <v-chip class="mr-2">
                                                    {{ (placement !== null) ? placement.paymentTypeName : ''}}
                                                </v-chip>
                                            </v-list-item-subtitle>
                                            <v-list-item-subtitle>
                                                {{ (campaignInformation !== null) ? campaignInformation.description : ''}}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </v-card>
                            <v-btn icon @click="nextTab()" class="nav_control nav_right">
                                <v-icon right>keyboard_arrow_right</v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-card>
            </v-flex>
            <v-flex xs12 md12>
                <v-card tile>
                    <v-card width="80%" flat class="mx-auto py-3">
                        <v-card-text class="text-center">
                            Touch Points
                            <v-btn-toggle
                                v-model="toggle_exclusive"
                                mandatory
                                color="primary"
                            >
                                <v-btn v-for="(value, index) in savedTouchPoints" :key="index">
                                    {{index+1}}
                                </v-btn>
                            </v-btn-toggle>
                        </v-card-text>
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Touch Point # {{tab+1}}</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12 class="ma-auto white">
                                <p class="mb-0 mt-4">To win, all you habe to do is:</p>
                                <v-list class="guide_list">
                                    <v-list-item
                                        v-for="(guideline, guidelineIndex) in guideLines"
                                        :key="guidelineIndex"
                                        height="35"
                                        min-height="35"
                                    >
                                        <v-list-item-icon class="ma-0">
                                            <strong class="primary--text">{{ guidelineIndex+1 }}.</strong>
                                        </v-list-item-icon>
                                        <v-list-item-content class="mt-n3 py-0">
                                            <v-list-item-subtitle>
                                                {{ guideline }}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Captions</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <p class="mb-0 mt-4">{{touchPoint.caption}}</p>
                            </v-flex>
                        </v-layout>
                    </v-card>
                </v-card>
            </v-flex>
            <v-flex xs12 md12>
                <v-card tile class="hr_divider">
                    <v-card width="80%" flat class="mx-auto py-3">
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
                                    class="ma-3 text-lowercase"
                                    color="grey lighten-2"
                                    depressed
                                    height="42"
                                >
                                    @{{mention}}
                                </v-btn>
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
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>No. Of friends Tagged</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <v-btn class="ma-3 text-lowercase" color="grey lighten-2" depressed height="42">5</v-btn>
                            </v-flex>
                        </v-layout>
                    </v-card>
                </v-card>
            </v-flex>
            <v-flex xs12 md12 v-if="images.length > 0">
                <v-card tile class="hr_divider">
                    <v-card width="80%" flat class="mx-auto py-3">
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Images:</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <v-row :class="$vuetify.breakpoint.smAndUp ? '' : 'fix_width mx-auto'">
                                    <v-col
                                        v-for="(image, imageIndex) in images"
                                        :key="imageIndex"
                                        class="xl3 lg3 md3 sm4 xs12"
                                    >
                                        <v-card flat tile class="d-flex">
                                            <v-img
                                                :src="image.imageURL"
                                                :lazy-src="`https://picsum.photos/10/6?image=${imageIndex * 5 + 10}`"
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
                </v-card>
            </v-flex>
            <v-flex xs12 md12>
                <v-card tile class="hr_divider">
                    <v-card width="80%" flat class="mx-auto py-3">
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
                    </v-card>
                </v-card>
            </v-flex>
            <v-flex xs12 md12>
                <v-card tile class="py-3">
                    <v-card-actions class="pr-12">
                        <v-spacer></v-spacer>
                        <v-btn class="text-capitalize" color="grey lighten-2" depressed height="42" @click="goToBack()">Back</v-btn>
                        <v-btn class="text-capitalize" color="primary" depressed height="42" @click="applyCampaign()">Apply for this Campaign</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>

        <v-layout wrap class="pa-12 pt-0">
            <v-flex xs12 md12>
                <v-card tile class="py-3 pt-0">
                    <v-row>
                        <v-col cols="12" md="4" xs="12">
                            <v-list-item two-line class="pl-12">
                                <v-list-item-content>
                                    <v-list-item-title class="font-weight-bold">About the Client</v-list-item-title>
                                    <v-list-item-title class="font-weight-bold">
                                        <v-icon color="success">mdi-check-decagram</v-icon>
                                        Payment Method Verified
                                    </v-list-item-title>
                                    <v-list-item-subtitle>4.68 of 31 reviews</v-list-item-subtitle>
                                    <v-list-item-subtitle>
                                        <v-rating color="success" v-model="rating"></v-rating>
                                    </v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-col>

                        <v-col cols="12" md="4" xs="12">
                            <v-list-item two-line>
                                <v-list-item-content>
                                    <v-list-item-title class="font-weight-bold">UNITED KINGDOM</v-list-item-title>
                                    <v-list-item-subtitle>LONDON 11:52 AM</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item two-line>
                                <v-list-item-content>
                                    <v-list-item-title class="font-weight-bold">60 JOBS POSTED</v-list-item-title>
                                    <v-list-item-subtitle>79% HIRE RATE, 1 OPEN JOB</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item two-line>
                                <v-list-item-content>
                                    <v-list-item-title class="font-weight-bold">$2K+TOTAL SPENT</v-list-item-title>
                                    <v-list-item-subtitle>49 HIRES, 6 ACTIVE</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-col>

                        <v-col cols="12" md="4" xs="12">
                            <v-list-item two-line>
                                <v-list-item-content>
                                    <v-list-item-title class="font-weight-bold">$5.59/HR AVG HOURLY RATE PAID</v-list-item-title>
                                    <v-list-item-subtitle>107 HOURS</v-list-item-subtitle>
                                    <v-list-item-subtitle>MEMBER SINCE JUL 28, 2015</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-col>
                    </v-row>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    export default {
        data: () => ({
            hashtags : null,
            mentions : null,
            guideLines : null,
            touchPoint:{},
            images:[],
            rating: 3,
            tab : 0,
            toggle_exclusive:undefined,
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            list_items: [
                { number: 1, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
                { number: 2, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
                { number: 3, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'}
            ],
        }),
        methods: {
            ...mapActions({
                getCampaignTouchPoint       : 'campaign/getCampaignTouchPoint',
                collectInvitation           : 'campaign/collectInvitation'
            }),
            reserve () {
                this.loading = true

                setTimeout(() => (this.loading = false), 2000)
            },
            nextTab() {
                if (this.tab === this.savedTouchPoints.length -1) {
                    return false;
                }
                this.tab = this.tab + 1;
                this.toggle_exclusive = this.tab;
                this.touchPoint = this.savedTouchPoints[this.tab];
            },
            preTab() {
                if (this.tab === 0) {
                    return false;
                }
                this.tab = this.tab - 1;
                this.toggle_exclusive = this.tab;
                this.touchPoint = this.savedTouchPoints[this.tab];
            },
            goToBack() {
                this.$router.push({name: 'influencer-campaign'})
            },
            applyCampaign() {
                let payload =  {
                    user_id      : this.auth.id,
                    placement_id : this.campaignInformation.primary_placement_id,
                    campaign_id  : this.campaignInformation.id,
                    sender_id    : this.auth.id,
                    sent_from    : this.auth.type,
                    status       : 'queued',
                    price        : 123,

                };
                let response = this.collectInvitation(payload);
                if(response) {
                    this.$toast.success('You have successfully sent invitation to this campaign')
                }
            }
        },
        computed: {
            ...mapGetters({
                savedTouchPoints    : 'campaign/savedTouchPoints',
                campaignInformation : 'campaign/campaignInformation',
                placement           : 'campaign/campaignPlacement',
                campaignObjective   : 'campaign/campaignObjective',
                auth                : 'auth/user'
            })
        },
        async mounted() {
            await this.getCampaignTouchPoint({slug:this.$router.currentRoute.params.slug});
            this.touchPoint = this.savedTouchPoints[this.tab];
        },
        watch : {
            'touchPoint.hashtags' : {
                handler: function(newVal, oldVal) {
                    if (_.isNil(newVal)) {
                        this.hashtags = null;
                        return;
                    }
                    this.hashtags = newVal.split(',');
                },
                immediate: false
            },
            'touchPoint.mentions' : {
                handler: function(newVal, oldVal) {
                    if (_.isNil(newVal)) {
                        this.mentions = null;
                        return;
                    }
                    this.mentions = newVal.split(',');
                },
                immediate: false
            },
            'touchPoint.images' : {
                handler: function(val) {
                    let self = this;
                    if (!_.isNil(val)) {
                        self.images = val;
                    }
                }
            },
            'touchPoint.guideLines' : {
                handler: function(val) {
                    let self = this;
                    this.guideLines = _.compact(val);
                }
            },
            'toggle_exclusive' : {
                handler: function(val) {
                    this.touchPoint = this.savedTouchPoints[val];
                }
            }
        }
    }
</script>

<style scoped>
    .description_wrapper{
        background:linear-gradient(90deg, #ee6f6e 0%,#fea57e 100% );
        padding: 50px 90px;
    }
    >>>.brand_logo{
        margin-left: -65px;
        border-radius: 10px;
    }
    >>>.brand_logo2{
        border-radius: 5px;
    }
    >>>.guide_list .v-list-item{
        min-height: 35px !important;
    }
    .hr_divider {
        border-top: 1px solid #cccccc;
    }
    >>>.nav_control .v-btn__content .v-icon{
        font-size: 48px;
        color: #fff;
    }
    >>>.nav_right{
        position: absolute;
        bottom: 140px;
        right:110px
    }
    >>>.nav_left{
        position: absolute;
        bottom: 140px;
        left:40px
    }
    >>>.v-rating .v-icon{
        padding:0px;
    }
</style>
