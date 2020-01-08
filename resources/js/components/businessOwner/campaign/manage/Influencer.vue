<template>
    <v-layout wrap class="ma-3 pa-2">
        <v-flex xs12 fluid>
            <v-btn color="primary" large class="d-inline-block float-left text-capitalize"
               :class="$vuetify.breakpoint.smAndUp ? 'mx-2' : 'my-2'"
            >
                Create Campaign
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
            <v-data-table
                :headers="headers"
                :items="influencerTouchPoint"
                :single-expand="singleExpand"
                :expanded.sync="expanded"
                item-key="id"
                show-expand
                :hide-default-footer="true"
                class="elevation-1 table_class"
            >
                <template v-slot:top>
                    <v-toolbar flat color="white">
                        <v-toolbar-title>
                            <div class="subtitle-1 font-weight-bold">
                                <span>Campaign</span><v-icon class="body-1 mx-5">keyboard_arrow_right</v-icon>
                                <span>Placement</span><v-icon class="body-1 mx-5">keyboard_arrow_right</v-icon>
                                <span>Influencer</span><v-icon class="body-1 mx-5">keyboard_arrow_right</v-icon>
                                <span>Touch Points</span>
                            </div>
                        </v-toolbar-title>
                    </v-toolbar>
                </template>

                <template v-slot:item.title="{ item }">
                    <v-list-item class="list_cards mx-0 px-0">
                    <v-list-item-avatar height="50" min-width="50" width="50" class="mr-3">
                        <v-img src="/images/icons/user_placeholder.png"></v-img>
                    </v-list-item-avatar>
                        <v-list-item-content>
                        <div class="float_class">
                            <div class="body-2 mb-2"><strong>{{item.assign_to.first_name+ ' '+item.assign_to.last_name}}</strong>
                                <v-rating v-model="rating" size="7" small class="d-inline-block"></v-rating>
                            </div>
                        </div>
                        </v-list-item-content>
                    </v-list-item>
                </template>

                <template v-slot:item.status="{ item }">
                    Active
                    <v-icon class="overline ml-2" color="success">mdi-circle</v-icon>
                </template>
                <template v-slot:item.engRate="{ item }">
                    <div class="mb-0">
                        <span>
                            {{
                            placementStatistics(
                                item.placement_id,
                                item.assign_to.statistics,
                                'eng_rate')
                            }}%
                        </span>
                    </div>
                </template>

                <template v-slot:item.comments="{ item }">
                    <div class="mb-0">
                        <span>
                            {{
                            placementStatistics(
                                item.placement_id,
                                item.assign_to.statistics,
                                'comment_count')
                            }}
                        </span>
                    </div>
                </template>

                <template v-slot:item.likes="{ item }">
                    <div class="mb-0">
                        <span>
                            {{
                            placementStatistics(
                                item.placement_id,
                                item.assign_to.statistics,
                                'like_count')
                            }}
                        </span>
                    </div>
                </template>

                <template v-slot:expanded-item="{ headers, item }">
                    <td :colspan="headers.length">
                        <v-timeline
                            dense clipped
                            class="ml-n7"
                        >
                            <v-timeline-item
                                v-for="(touchPoint, index) in item.touch_points"
                                :key="index"
                                :fill-dot="true"
                                icon="mdi-check"
                                icon-color="white"
                                right
                                small
                            >
                                <v-card class="elevation-2 list_card" id="dropdown-example">
                                    <v-row class="mx-auto">
                                        <v-col cols="12" md="6">
                                            <v-row class="mx-auto">
                                                <v-flex xl2 lg2 md2 sm2 xs2>
                                                    <v-list-item-avatar height="56" min-width="100%" width="100%" class="ma-0 number_avatar" color="primary">
                                                        <span class="white--text">{{index+1}}</span>
                                                    </v-list-item-avatar>
                                                </v-flex>
                                                <v-flex xl8 lg8 md8 sm8 xs8>
                                                    <v-text-field
                                                        outlined
                                                        :label="touchPoint.touch_point.name"
                                                        class="touch_field"
                                                        readonly
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xl2 lg2 md2 sm2 xs2>
                                                    <v-list-item-avatar height="56" min-width="45" width="45" class="ma-0 amount_avatar" color="grayLight">
                                                        <span>${{touchPoint.touch_point.amount}}</span>
                                                    </v-list-item-avatar>
                                                </v-flex>
                                            </v-row>
                                        </v-col>
                                        <v-col cols="12" md="4" class="px-1">
                                            <p class="mb-0 caption">
                                                Start Date: <span class="float-right mr-5">Status:</span>
                                            </p>
                                            <p class="mb-0 caption">
                                                <span class="primary--text">12-09-2019</span> <span class="float-right primary--text mr-5">Draft</span>
                                            </p>
                                        </v-col>
                                        <v-col cols="12" md="2" class="px-1">
                                            <p class="mb-0 primary--text caption pt-3">View Details
                                                <v-menu offset-y>
                                                    <template v-slot:activator="{ on }">
                                                        <v-btn v-on="on" small color="gray" min-width="20" depressed class="px-1 ml-3">
                                                            <v-icon>mdi-dots-horizontal</v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <v-list class="menu_list">
                                                        <v-list-item
                                                            v-for="(drop, index) in dropdown"
                                                            :key="index"
                                                            @click=""
                                                            class="bottom_border"
                                                        >
                                                            <v-list-item-title v-html="drop.title" class="text-center"></v-list-item-title>
                                                        </v-list-item>
                                                    </v-list>
                                                </v-menu>
                                            </p>
                                        </v-col>
                                    </v-row>
                                </v-card>
                            </v-timeline-item>
                        </v-timeline>
                    </td>
                </template>
            </v-data-table>
        </v-flex>
        <v-flex xs12 md5 class="pa-2">
            <campaign-chat-box></campaign-chat-box>
        </v-flex>
    </v-layout>

</template>

<script>

    import CampaignChatBox from "../../../general/CampaignChatBox";
    import {mapActions, mapGetters} from 'vuex';

    export default {
        components: {
            CampaignChatBox
        },
        data: () => ({
            input: '',
            rating: 3,
            expanded: [],
            singleExpand: true,
            dropdown: [
                {title: '<strong>Status</strong> : In Progress'},
                {title: 'Clone this Touchpoint'},
                {title: 'Add new Touchpoint'},
                {title: 'Pause This Touchpoint'},
                {title: 'Delete'},
            ],
            headers: [
                {
                    text: 'Influencers',
                    align: 'left',
                    value: 'title',
                    class: 'head_class text-uppercase',
                    sortable: false,
                },
                {text: 'Status', value: 'status', class: 'head_class text-uppercase', sortable: false,},
                {text: 'Eng. Rate', value: 'engRate', class: 'head_class text-uppercase', sortable: false,},
                {text: 'Comments', value: 'comments', class: 'head_class text-uppercase', sortable: false,},
                {text: 'Likes', value: 'likes', class: 'head_class text-uppercase', sortable: false,},
            ],
            influencerTouchPoint:[]
        }),
        methods: {
            ...mapActions({
                getInfluencerAssignTouchPoint: 'campaignManagement/getInfluencerAssignTouchPoint'
            }),
            placementStatistics(id,statistics,field) {
                let stat = _.find(statistics, ['placement_id', id]);
                if (_.isNil(stat)) {
                    return 0;
                }
                return stat[field];
            }
        },
        async mounted() {
            this.influencerTouchPoint = await this.getInfluencerAssignTouchPoint({
                campaign_invite_id: this.$router.history.current.params.slug,
                user_id: this.$router.history.current.params.user
            });
        }
    }
</script>
<style scoped>
     >>>.v-rating .v-icon{
        padding:0px;
    }
    >>>.list_cards .v-avatar{
        border-radius: 10px !important;
    }
    >>>.nested_list{
        border: 1px solid #ccc;
        margin-top: -4px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }
    >>>.list_card .v-avatar{
        border-radius: 0px !important;
    }
    >>>.list_card .v-input__slot{
        border-radius: 0px !important;
    }
    >>>.list_card .number_avatar{
        border-top-left-radius: 5px !important;
        border-bottom-left-radius: 5px !important;
    }
    >>>.list_card .amount_avatar{
        border-top-right-radius: 5px !important;
        border-bottom-right-radius: 5px !important;
    }
    >>>.v-badge__badge{
        margin-right: 16px !important;
    }
    >>>.swtich_class .v-input--switch__track{
        height: 20px !important;
        width: 40px !important;
    }
    >>>.swtich_class .v-input--switch__thumb{
        width: 12px !important;
        height: 12px !important;
        top:2px !important;
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
    >>>.table_class table tbody tr td:nth-child(3) {
        width: 100px !important;
    }
    >>>.upload_filed .v-text-field--outlined > .v-input__control > .v-input__slot{
        min-height: 40px !important;
    }
    >>>.upload_filed .v-input .v-label{
        line-height: 2px !important;
        overflow: visible !important;
    }
    >>>.touch_field .v-text-field__details{
        display: none !important;
    }

    >>>.custom_field .v-input__control{
        min-height: 43px !important;
    }
    .bottom_border{
        border-bottom: 1px solid #cccccc;
    }
    .bottom_border:last-child{
        border-bottom: none;
    }
</style>
