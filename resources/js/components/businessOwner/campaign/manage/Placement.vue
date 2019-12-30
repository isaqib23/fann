<template>
    <v-layout wrap class="ma-3 pa-2">
        <v-flex xs12 fluid>
            <v-btn color="primary" large class="d-inline-block float-left text-capitalize"
               :class="$vuetify.breakpoint.smAndUp ? 'mx-2' : 'my-2'"
            >
                Create Placement
            </v-btn>
            <v-text-field
                class="float-left custom_field"
                solo
                depressed
                label="Search / Add Filters"
                prepend-inner-icon="search"
            ></v-text-field>
        </v-flex>
        <!-- Top Content -->
        <v-flex xs12 md7 class="pa-2">
            <v-card class="pa-2" outlined tile v-if="skeleton">
                <v-card-text>
                    <v-skeleton-loader
                        class="mx-auto"
                        type="table"
                    ></v-skeleton-loader>
                </v-card-text>
            </v-card>

            <v-data-table
                :headers="headers"
                :items="campaignPlacement.touch_point"
                :single-expand="singleExpand"
                :expanded.sync="expanded"
                item-key="id"
                show-expand
                :hide-default-footer="true"
                class="elevation-1 table_class"
                v-if="!skeleton && campaignPlacement.length !== 0"
            >
                <template v-slot:top>
                    <v-toolbar flat color="white">
                        <v-toolbar-title>
                            <div class="subtitle-1">
                                <span>Campaign</span><v-icon class="body-1 mx-5 font-weight-bold">keyboard_arrow_right</v-icon>
                                <span>Placement</span><v-icon class="body-1 mx-5 font-weight-bold">keyboard_arrow_right</v-icon>
                                <span>Influencer</span>
                            </div>
                        </v-toolbar-title>
                    </v-toolbar>
                </template>

                <template v-slot:item.title="{ item }">
                    <v-list two-line class=" pa-0 mx-0 hover_class" dense>
                        <v-list-item class="px-0">
                            <v-list-item-content>
                                <v-list-item-title v-html="campaignPlacement.name"></v-list-item-title>
                                <v-list-item-subtitle >
                                    <v-chip-group>
                                        <v-chip class="px-2" color="#E5E5E5" text-color="#71737D" label>
                                            {{(campaignPlacement.objective.name.length > 10) ? campaignPlacement.objective.name.substring(0,10)+"..." : campaignPlacement.objective.name}}
                                        </v-chip>
                                        <v-chip class="px-2" color="#E5E5E5" text-color="#71737D" label>
                                            {{campaignPlacement.payment.payment_type.name}}
                                        </v-chip>
                                    </v-chip-group>
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                </template>

                <template v-slot:item.status="{ item }">
                    <v-switch
                        flat
                        :v-model="(campaignPlacement.status === 'active') ? true : false"
                        inset
                        color="error"
                        hide-details
                        class="switch_class"
                    ></v-switch>
                </template>

                <template v-slot:item.impression="{ item }">
                    <span class="subtitle-1">{{campaignPlacement.impressions}}</span>
                </template>
                <template v-slot:item.actions="{ item }">
                    <span class="subtitle-1">{{campaignPlacement.actions}}</span>
                </template>
                <template v-slot:item.engRate="{ item }">
                    <div class="mb-0">
                        <span class="subtitle-1">{{campaignPlacement.eng_rate}}%</span>
                        <v-btn small color="green accent-4 white--text px-1 ml-6" min-width="20">
                            <v-icon class="body-1">keyboard_arrow_right</v-icon>
                        </v-btn>
                    </div>
                </template>

                <template v-slot:expanded-item="{ item }">
                    <td colspan="6">
                        <v-timeline
                            dense clipped
                            class="ml-n7"
                        >
                            <v-timeline-item
                                v-for="(placementInvite, index) in item.invite"
                                :key="index"
                                :fill-dot="true"
                                icon="mdi-check"
                                icon-color="white"
                                right
                                small
                            >
                                <v-badge class="full_width">
                                    <template v-slot:badge>6</template>
                                    <v-card class="elevation-2 list_cards">
                                    <v-list>
                                        <v-list-item two-line>
                                            <v-list-item-avatar height="50" min-width="50" width="50" class="mr-3">
                                                <img
                                                    src="/images/icons/user_placeholder.png"
                                                />
                                            </v-list-item-avatar>

                                            <v-list-item-content>
                                                <v-row class="mx-auto">
                                                    <v-flex xl3 lg3 md3 sm6 xs12>
                                                        <v-list-item-title>{{placementInvite.influencer_job.user.first_name+' '+placementInvite.influencer_job.user.last_name}}</v-list-item-title>
                                                        <v-list-item-subtitle>
                                                            <v-rating :v-model="placementStatistics(placementInvite.placement_id,placementInvite.influencer_job.user.statistics,'rating')" size="7" small class="d-inline-block"></v-rating>
                                                        </v-list-item-subtitle>
                                                    </v-flex>
                                                    <v-flex xl2 lg2 md2 sm6 xs12>
                                                        <div class="followers body-2">
                                                            <v-icon class="body-1">{{placementIcon(placementInvite.placement_id)}}</v-icon>
                                                            {{placementStatistics(placementInvite.placement_id,placementInvite.influencer_job.user.statistics,'follower_count')}}
                                                            Followers
                                                        </div>
                                                    </v-flex>
                                                    <v-flex xl4 lg4 md4 sm12 xs12>
                                                        <div class="float_class">
                                                            <div class="caption mb-2 integrityColor--text">
                                                                <strong class="custom_font">Eng. Rate</strong>
                                                                <strong class="ml-1 custom_font">Comments</strong>
                                                                <strong class="ml-1 custom_font">Likes</strong>
                                                            </div>
                                                            <div class="followers">
                                                                <p class="d-inline-block mb-0 mx-3 custom_font">
                                                                    {{placementStatistics(placementInvite.placement_id,placementInvite.influencer_job.user.statistics,'eng_rate')}}%
                                                                </p>
                                                                <p class="d-inline-block mb-0 ml-5 mr-3 custom_font">
                                                                    {{placementStatistics(placementInvite.placement_id,placementInvite.influencer_job.user.statistics,'comment_count')}}
                                                                </p>
                                                                <p class="d-inline-block mb-0 ml-3 custom_font">
                                                                    {{placementStatistics(placementInvite.placement_id,placementInvite.influencer_job.user.statistics,'like_count')}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </v-flex>
                                                    <v-flex xl3 lg3 md3 sm6 xs12 class="text-center">
                                                        <v-btn color="info" depressed small class="text-capitalize overline px-3 ml-1 white--text" min-width="30">
                                                            <v-icon class="caption">mdi-chat</v-icon>
                                                            Chat
                                                        </v-btn>
                                                        <v-btn color="success" depressed small class="overline px-1" min-width="20">
                                                            <v-icon>keyboard_arrow_right</v-icon>
                                                        </v-btn>
                                                    </v-flex>
                                                </v-row>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list>

                                </v-card>
                                </v-badge>
                            </v-timeline-item>
                        </v-timeline>
                    </td>
                </template>
            </v-data-table>
        </v-flex>
        <v-flex xs12 md5 class="pa-2 list_cards">
            <v-card class="pa-2" outlined tile v-if="skeleton">
                <v-card-title class="subtitle-1 text-uppercase darken-1 pa-5" ><strong>Proposals</strong></v-card-title>
                <v-card-text v-for="n in 5" :key="n">
                    <v-skeleton-loader
                        class="mx-auto"
                        type="list-item-avatar-three-line"
                    ></v-skeleton-loader>
                </v-card-text>
            </v-card>
                <v-list three-line class="px-5" v-if="!skeleton && campaignProposal.length !== 0">
                    <div class="subtitle-1 text-uppercase darken-1 pa-5" ><strong>Proposals</strong></div>

                    <template v-for="(item, index) in campaignProposal.proposal">
                        <v-card class="mb-2 custom_list">
                        <v-list-item
                            :key="index"
                        >
                            <v-list-item-avatar height="80" min-width="80" width="80">
                                <img src="/images/icons/user_placeholder.png">
                            </v-list-item-avatar>

                            <v-list-item-content>
                                <v-list-item-title>
                                    <v-row justify="space-between">
                                        <v-col md="6" class="py-0 ma-0">
                                            <div class="float-left body-2">
                                                <strong><u>
                                                    {{item.user.first_name+' '+item.user.last_name}}
                                                </u></strong>
                                                <div class="followers overline">
                                                    <v-icon class="caption">{{placementIcon(item.placement_id)}}</v-icon>
                                                    {{placementStatistics(item.placement_id,item.user.statistics,'follower_count')}}
                                                    Followers
                                                </div>
                                            </div>
                                        </v-col>
                                        <v-col md="6" class="py-0 ma-0">
                                            <div class="float-right">
                                                <div class="d_block">
                                                    <v-btn small icon @click="openChatBox(item)">
                                                        <v-icon class="custom_font black--text px-1">mdi-chat</v-icon>
                                                    </v-btn>
                                                    <v-icon class="custom_font black--text px-1">cancel</v-icon>
                                                    <v-icon class="custom_font black--text px-1">mdi-refresh</v-icon>
                                                </div>
                                                <v-btn color="primary list_proposal custom_font text-capitalize" depressed small>
                                                    View Proposal
                                                </v-btn>
                                            </div>
                                        </v-col>
                                    </v-row>
                                </v-list-item-title>
                                <v-list-item-subtitle>
                                    <v-row justify="space-between">
                                        <v-col md="6" class="py-0 ma-0">
                                            <v-rating :v-model="placementStatistics(item.placement_id,item.user.statistics,'rating')" size="7" small background-color="grey"></v-rating>
                                        </v-col>
                                        <v-col md="6" class="py-0 ma-0">
                                            <div class="subtitle-2 mb-2 integrityColor--text float-right ml-n7">
                                                <strong class="custom_font">Eng. Rate</strong>
                                                <strong class="ml-3 custom_font">Comments</strong>
                                                <strong class="ml-3 custom_font">Likes</strong>
                                            </div>
                                        </v-col>
                                    </v-row>
                                    <v-row justify="space-between">
                                        <v-col md="6" class="py-0 ma-0">
                                            <strong>$59.00 for 5 Touch Points</strong>
                                        </v-col>
                                        <v-col md="6" class="py-0 ma-0">
                                            <div class="float-right d-inline-block ml-n7">
                                                <p class="d-inline-block mb-0 mr-n2 custom_font">
                                                    {{placementStatistics(item.placement_id,item.user.statistics,'eng_rate')}}%
                                                </p>
                                                <p class="d-inline-block mb-0 ml-10 mr-6 custom_font">
                                                    {{placementStatistics(item.placement_id,item.user.statistics,'comment_count')}}
                                                </p>
                                                <p class="d-inline-block mb-0 ml-5 custom_font">
                                                    {{placementStatistics(item.placement_id,item.user.statistics,'like_count')}}
                                                </p>
                                            </div>
                                        </v-col>
                                    </v-row>
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        </v-card>

                    </template>
                </v-list>
        </v-flex>
    </v-layout>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        inject: ['theme'],
        data: () => ({
            skeleton:true,
            rating: 3,
            expanded: [],
            singleExpand: true,
            headers: [
                { text: 'Placement', align: 'left', value: 'title', class: 'head_class font-weight-bold text-uppercase',sortable: false,},
                { text: 'Status', value: 'status', class: 'head_class font-weight-bold text-uppercase',sortable: false,},
                { text: 'Impressions', value: 'impression', class: 'head_class font-weight-bold text-uppercase',sortable: false, },
                { text: 'Actions', value: 'actions', class: 'head_class font-weight-bold text-uppercase',sortable: false, },
                { text: 'Eng. Rate', value: 'engRate', class: 'head_class font-weight-bold text-uppercase',sortable: false, },
            ],
            desserts: [
                {
                    title: 'My Awesome Campaign 2019',
                    tags: [
                        'Pro Campaign',
                        'Barter'
                    ],
                    status: true,
                    impression: '125k',
                    actions: '2.7k',
                    engRate: '2.0',
                    id:'1'
                },
                {
                    title: 'My Awesome Campaign 2019',
                    tags: [
                        'Pro Campaign',
                        'Barter'
                    ],
                    status: true,
                    impression: '125k',
                    actions: '2.7k',
                    engRate: '2.0',
                    id:'2'
                },
                {
                    title: 'My Awesome Campaign 2019',
                    tags: [
                        'Pro Campaign',
                        'Barter'
                    ],
                    status: true,
                    impression: '125k',
                    actions: '2.7k',
                    engRate: '2.0',
                    id:'3'
                },
                {
                    title: 'My Awesome Campaign 2019',
                    tags: [
                        'Pro Campaign',
                        'Barter'
                    ],
                    status: true,
                    impression: '125k',
                    actions: '2.7k',
                    engRate: '2.0',
                    id:'4'
                },
                {
                    title: 'My Awesome Campaign 2019',
                    tags: [
                        'Pro Campaign',
                        'Barter'
                    ],
                    status: true,
                    impression: '125k',
                    actions: '2.7k',
                    engRate: '2.0',
                    id:'5'
                },
            ],
            items: [
                {
                    id: 1,
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
                    title: 'Brunch this weekend?',
                },
                { divider: true, inset: true },
                {
                    id: 2,
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
                    title: 'Summer BBQ',
                },
                { divider: true, inset: true },
                {
                    id: 3,
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
                    title: 'Oui oui',
                },
                { divider: true, inset: true },
                {
                    id: 4,
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/4.jpg',
                    title: 'Birthday gift',
                },
                { divider: true, inset: true },
                {
                    id:5,
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/5.jpg',
                    title: 'Recipe to try',
                },
            ],
            campaignPlacement: [],
            campaignProposal: []
        }),
        computed : {
            ...mapGetters({
                chatBox : 'campaign/chatBox'
            })
        },
        methods: {
            ...mapActions({
                saveChatBox         : 'campaign/saveChatBox',
                getCampaignById     : 'campaignManagement/getCampaignById',
                getCampaignProposal : 'campaignManagement/getCampaignProposal',
             }),
            openChatBox(item) {
                let find = _.find(this.chatBox, function (obj) {
                    return obj.id === item.id;
                });
                if (_.isEmpty(find) && _.size(this.chatBox) < 3) {
                    this.saveChatBox(item);
                }
            },
            placementIcon(id){
                return (id === 1) ? 'mdi-instagram' : 'mdi-youtube';
            },
            placementStatistics(id,statistics,field){
                let stat = _.find(statistics, ['platform_id', id]);
                if(_.isNil(stat)){
                    return 0;
                }
                return stat[field];
            }
        },
        async mounted() {
            this.campaignPlacement = await this.getCampaignById({campaign_id:this.$router.history.current.params.slug});
            this.campaignProposal = await this.getCampaignProposal({campaign_id:this.$router.history.current.params.slug});
            console.log(this.campaignPlacement,this.campaignProposal);

        },
        watch: {
            'campaignPlacement' : {
                handler: function(val) {
                    this.skeleton = true;
                    if(!_.isNil(val)){
                        let self = this;
                        setTimeout(function () {
                            self.skeleton = false;
                        } , 1000);
                    }
                },
                immediate: true,
                deep: true
            },
        }
    }
</script>
<style scoped>

    >>>.v-rating .v-icon{
        padding:0px;
    }
    >>>.list_cards .v-avatar {
        border-radius: 10px !important;
    }
    >>>.v-badge__badge{
        margin-right: 16px !important;
    }
    >>>.switch_class .v-input--switch__track{
        height: 17px !important;
        width: 34px !important;
    }
    >>>.switch_class .v-input--switch__thumb{
        width: 10px !important;
        height: 10px !important;
        top: 1px !important;
    }
    >>>.switch_class .v-input--selection-controls__ripple {
        width: 0px !important;
        height: 0px !important;
    }
    >>>.head_class{
        color: #000 !important;
        font-size: 13px !important;
    }
    >>>.table_class table tbody tr td:last-child {
        width: 120px !important;
    }
    >>>.table_class table tbody tr td:first-child {
        width: 40px !important;
    }
    >>>.table_class table thead tr th i {
        display: block !important;
    }
    >>>.table_class .v-toolbar__content{
        border-bottom: 1px solid #cccccc !important;
    }
    >>>.table_class table{
        margin-top:16px !important;
    }
    >>>.list_proposal .v-btn__content{
        font-size: 8px;
    }
    >>>.custom_field .v-input__control{
        min-height: 43px !important;
    }
    >>>tr:hover .hover_class{
        background: #EEEEEE !important;
    }

    .custom_font{
        font-size: 12px !important;
    }
    .followers {
        padding-top: 12px;
    }
    >>>.d_block {
        display: inline-block !important;
    }

    @media only screen
    and (min-device-width: 960px)
    and (max-device-width: 1366px)
    and (-webkit-min-device-pixel-ratio: 1) {
        .custom_font{
            font-size: 10px !important;
        }
        .followers {
            padding-top: 0px;
        }
        >>>.custom_list .v-list-item__avatar{
            margin-right: 5px !important;
            height: 50px !important;
            min-width: 50px !important;
            width: 50px !important;
        }
        >>>.d_block {
            display: block !important;
        }
    }
</style>
