<template>
    <v-layout wrap class="ma-3 pa-2">
        <v-flex xs12 fluid>
            <v-btn color="primary" large class="ma-2 d-inline-block float-left">
                Create Campaign
            </v-btn>
            <v-text-field
                class="float-left mt-1"
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
                :items="desserts"
                :single-expand="singleExpand"
                :expanded.sync="expanded"
                item-key="id"
                show-expand
                class="elevation-1 table_class"
            >
                <template v-slot:top>
                    <v-toolbar flat color="white">
                        <v-toolbar-title>
                            <div class="subtitle-1 font-weight-bold">
                                <span>Campaign</span><v-icon class="body-1 mx-5 font-weight-bold">keyboard_arrow_right</v-icon>
                                <span>Placement</span><v-icon class="body-1 mx-5 font-weight-bold">keyboard_arrow_right</v-icon>
                                <span>influencer</span>
                            </div>
                        </v-toolbar-title>
                    </v-toolbar>
                </template>

                <template v-slot:item.title="{ item }">
                    <v-list two-line class="py-0" dense>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title v-html="item.title"></v-list-item-title>
                                <v-list-item-subtitle >
                                    <v-chip-group>
                                        <v-chip v-for="tag in item.tags" :key="tag">
                                            {{tag}}
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
                        v-model="item.status"
                        inset
                        color="error"
                        hide-details
                        class="swtich_class"
                    ></v-switch>
                </template>
                <template v-slot:item.engRate="{ item }">
                    <div class="mb-0">
                        <span>{{item.engRate}}</span>
                        <v-btn small color="green accent-4 white--text px-1 ml-6" min-width="20">
                            <v-icon class="body-1">keyboard_arrow_right</v-icon>
                        </v-btn>
                    </div>
                </template>

                <template v-slot:expanded-item="{ headers }">
                    <td :colspan="headers.length">
                        <v-timeline
                            dense clipped
                        >
                            <v-timeline-item
                                v-for="n in 3"
                                :key="n"
                                :fill-dot="true"
                                icon="mdi-check"
                                icon-color="white"
                                right
                                small
                            >
                                <v-badge>
                                    <template v-slot:badge>6</template>
                                    <v-card class="elevation-2 list_cards">
                                    <v-list-item>
                                        <v-list-item-avatar height="30" min-width="30" width="30" class="mr-3">
                                            <v-img src="/images/avtar.png"></v-img>
                                        </v-list-item-avatar>

                                        <v-list-item-content>
                                            <v-row class="mx-auto">
                                                <v-flex xl3 lg3 md3 sm6 xs12>
                                                    <div class="float_class">
                                                        <div class="body-2 mb-2"><strong>Amanda Nash</strong>
                                                            <v-rating v-model="rating" size="7" small class="d-inline-block"></v-rating>
                                                        </div>
                                                    </div>
                                                </v-flex>
                                                <v-flex xl2 lg2 md2 sm6 xs12>
                                                    <div class="followers caption">
                                                        <v-icon class="body-1">mdi-instagram</v-icon>
                                                        50.5K Followers
                                                    </div>
                                                </v-flex>
                                                <v-flex xl4 lg4 md4 sm12 xs12>
                                                    <div class="float_class">
                                                        <div class="caption mb-2 integrityColor--text">
                                                            <strong class="caption">Eng. Rate</strong>
                                                            <strong class="ml-1 caption">Comments</strong>
                                                            <strong class="ml-1 caption">Likes</strong>
                                                        </div>
                                                        <div class="followers">
                                                            <p class="d-inline-block mb-0 mx-3">43%</p>
                                                            <p class="d-inline-block mb-0 ml-5 mr-3">2.2K</p>
                                                            <p class="d-inline-block mb-0 ml-3">5.5K</p>
                                                        </div>
                                                    </div>
                                                </v-flex>
                                                <v-flex xl3 lg3 md3 sm6 xs12>
                                                    <v-btn color="primary" depressed small class="overline px-1 ml-1" min-width="30">
                                                        <v-icon class="caption">mdi-instagram</v-icon>
                                                        Chat
                                                    </v-btn>
                                                    <v-btn color="success" depressed small class="overline px-1" min-width="20">
                                                        <v-icon>keyboard_arrow_right</v-icon>
                                                    </v-btn>
                                                </v-flex>
                                            </v-row>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-card>
                                </v-badge>
                            </v-timeline-item>
                        </v-timeline>
                    </td>
                </template>
            </v-data-table>
        </v-flex>
        <v-flex xs12 md5 class="pa-2">
            <v-card class="list_cards">
                <v-list three-line>
                    <template v-for="(item, index) in items">
                        <v-divider
                            v-if="item.divider"
                            :key="index"
                            :inset="item.inset"
                        ></v-divider>

                        <v-list-item
                            v-else
                            :key="item.title"
                            @click=""
                        >
                            <v-list-item-avatar height="80" min-width="80" width="80">
                                <v-img :src="item.avatar"></v-img>
                            </v-list-item-avatar>

                            <v-list-item-content>
                                <v-list-item-title>
                                    <div>
                                        <div class="d-inline-block float-left body-2">
                                            {{item.title}}
                                            <div class="followers overline">
                                                <v-icon class="caption">mdi-instagram</v-icon>
                                                50.5K Followers
                                            </div>
                                        </div>
                                        <div class="d-inline-block float-right">
                                            <v-icon class="body-1 black--text">mdi-chat</v-icon>
                                            <v-icon class="body-1 black--text">cancel</v-icon>
                                            <v-icon class="body-1 black--text">mdi-refresh</v-icon>
                                            <v-btn color="primary list_proposal" depressed small class="overline">
                                                View Proposal
                                            </v-btn>
                                        </div>
                                    </div>
                                </v-list-item-title>
                                <v-list-item-subtitle>
                                    <v-rating v-model="rating" size="7" small class="d-inline-block"></v-rating>
                                    <div class="subtitle-2 mb-2 integrityColor--text d-inline-block float-right">
                                        <strong class="caption">Eng. Rate</strong>
                                        <strong class="ml-3 caption">Comments</strong>
                                        <strong class="ml-3 caption">Likes</strong>
                                    </div>
                                    <div class="followers">
                                        <div class="text-start d-inline-block">
                                            <strong class="ml-2">$59.00 for 5 Touch Points</strong>
                                        </div>
                                        <div class="float-right d-inline-block">
                                            <p class="d-inline-block mb-0 mr-n2">43%</p>
                                            <p class="d-inline-block mb-0 ml-10 mr-6">2.2K</p>
                                            <p class="d-inline-block mb-0 ml-5">5.5K</p>
                                        </div>
                                    </div>
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-list>
            </v-card>
        </v-flex>
    </v-layout>

</template>

<script>

    export default {
        data: () => ({
            rating: 3,
            expanded: [],
            singleExpand: false,
            headers: [
                { text: 'Placement', align: 'left', value: 'title', class: 'head_class'},
                { text: 'Status', value: 'status', class: 'head_class'},
                { text: 'Impressions', value: 'impression', class: 'head_class' },
                { text: 'Actions', value: 'actions', class: 'head_class' },
                { text: 'Eng. Rate', value: 'engRate', class: 'head_class' },
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
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
                    title: 'Brunch this weekend?',
                },
                { divider: true, inset: true },
                {
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
                    title: 'Summer BBQ',
                },
                { divider: true, inset: true },
                {
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
                    title: 'Oui oui',
                },
                { divider: true, inset: true },
                {
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/4.jpg',
                    title: 'Birthday gift',
                },
                { divider: true, inset: true },
                {
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/5.jpg',
                    title: 'Recipe to try',
                },
            ]
        })
    }
</script>
<style scoped>
    >>>.v-rating .v-icon{
        padding:0px;
    }
    >>>.list_cards .v-avatar{
        border-radius: 10px !important;
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
    >>>.list_proposal .v-btn__content{
        font-size: 8px;
    }
</style>
