<template>
    <v-layout wrap class="ma-3 pa-2">
        <v-flex xs12 fluid>
            <v-btn color="primary" large class="d-inline-block float-left"
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
                                <span>Influencer</span><v-icon class="body-1 mx-5 font-weight-bold">keyboard_arrow_right</v-icon>
                                <span>Touch Points</span>
                            </div>
                        </v-toolbar-title>
                    </v-toolbar>
                </template>

                <template v-slot:item.title="{ item }">
                    <v-list-item class="list_cards mx-0 px-0">
                    <v-list-item-avatar height="50" min-width="50" width="50" class="mr-3">
                        <v-img :src="item.avatar"></v-img>
                    </v-list-item-avatar>
                        <v-list-item-content>
                        <div class="float_class">
                            <div class="body-2 mb-2"><strong>{{item.title}}</strong>
                                <v-rating v-model="rating" size="7" small class="d-inline-block"></v-rating>
                            </div>
                        </div>
                        </v-list-item-content>
                    </v-list-item>
                </template>

                <template v-slot:item.status="{ item }">
                    {{item.status}}
                    <v-icon class="overline ml-2" color="success">mdi-circle</v-icon>
                </template>
                <template v-slot:item.engRate="{ item }">
                    <div class="mb-0">
                        <span>{{item.engRate}}</span>
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
                                <v-card class="elevation-2 list_card" id="dropdown-example">
                                    <v-row class="mx-auto">
                                        <v-col cols="12" md="6">
                                            <v-row class="mx-auto">
                                                <v-flex xl2 lg2 md2 sm2 xs2>
                                                    <v-list-item-avatar height="56" min-width="45" width="45" class="ma-0 number_avatar" color="primary">
                                                        <span class="white--text">1</span>
                                                    </v-list-item-avatar>
                                                </v-flex>
                                                <v-flex xl8 lg8 md8 sm8 xs8>
                                                    <v-text-field
                                                        outlined
                                                        label="Instagram post"
                                                        class="touch_field"
                                                        readonly
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xl2 lg2 md2 sm2 xs2>
                                                    <v-list-item-avatar height="56" min-width="45" width="45" class="ma-0 amount_avatar" color="grayLight">
                                                        <span>$15</span>
                                                    </v-list-item-avatar>
                                                </v-flex>
                                            </v-row>
                                        </v-col>
                                        <v-col cols="12" md="3" class="px-1">
                                            <p class="mb-0 caption">
                                                Start Date: <span class="float-right mr-5">Status</span>
                                            </p>
                                            <p class="mb-0 caption">
                                                <span class="primary--text">12-09-2019</span> <span class="float-right primary--text mr-5">Draft</span>
                                            </p>
                                        </v-col>
                                        <v-col cols="12" md="3" class="px-1">
                                            <p class="mb-0 text--primary caption pt-3">View Details
                                                <v-menu offset-y>
                                                    <template v-slot:activator="{ on }">
                                                        <v-btn v-on="on" small color="gray" min-width="20" depressed class="px-1 ml-3">
                                                            <v-icon color="primary">mdi-dots-horizontal</v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <v-list>
                                                        <v-list-item
                                                            v-for="(drop, index) in dropdown"
                                                            :key="index"
                                                            @click=""
                                                        >
                                                            <v-list-item-title>{{ drop.title }}</v-list-item-title>
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
            <v-card>
                <div class="mail_header bottom_border pa-5">
                    <div class="subtitle-1 mb-2">
                        <strong>Brunch this weekend?</strong>
                        <v-icon class="float-right">keyboard_arrow_down</v-icon>
                    </div>
                    <v-list-item>
                        <v-list-item-avatar>
                            <v-list-item-avatar class="mr-1">
                                <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg"></v-img>
                            </v-list-item-avatar>
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title class="body-2 font-weight-bold">Our Changing Planet
                                <span class="float-right caption font-weight-bold">25 August</span>
                            </v-list-item-title>
                            <v-list-item-subtitle>to <strong class="black--text">me</strong></v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </div>

                <v-card-text>
                    <v-container class="pa-0 full_height">
                        <v-row justify="center" class="full_width">
                            <v-col cols="12" md="5" align-self="center" class="pa-0 text-center">
                                <span class="grey--text">7-19-2019 (3w ago)</span>
                            </v-col>
                        </v-row>

                        <!-- Word File Row -->
                        <v-row justify="start" class="full_width">
                            <v-col cols="12" md="11" class="pa-0">
                                <v-list class="pa-0 list_card">
                                    <v-list-item>
                                        <v-list-item-avatar class="mr-2 mt-n4">
                                            <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg"></v-img>
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-sheet class="pa-3" color="grey lighten-2">
                                                <v-icon>mdi-notebook-outline</v-icon> Thanks, but I don't understand. I don't know
                                                <v-row class="mx-auto">
                                                    <v-flex xl2 lg2 md2 sm2 xs2>
                                                        <v-list-item-avatar height="49" min-width="45" width="45" class="ma-0 number_avatar display-2" color="transparent">
                                                            <v-icon color="blue">mdi-file-word</v-icon>
                                                        </v-list-item-avatar>
                                                    </v-flex>
                                                    <v-flex xl8 lg8 md8 sm8 xs8>
                                                        <v-text-field
                                                            label="https://www.google.com/"
                                                            solo
                                                        ></v-text-field>
                                                    </v-flex>
                                                    <v-flex xl2 lg2 md2 sm2 xs2>
                                                        <v-list-item-avatar height="48" min-width="45" width="45" class="ma-0 amount_avatar" color="primary">
                                                            <v-icon color="white">mdi-content-copy</v-icon>
                                                        </v-list-item-avatar>
                                                    </v-flex>
                                                </v-row>
                                                <div class="float-right">
                                                    <v-btn color="primary list_proposal" depressed small class="overline pa-2" min-height="20">
                                                        Request Change
                                                    </v-btn>
                                                    <v-btn color="success list_proposal" depressed small class="overline  pa-2"  min-height="20">
                                                        Approve
                                                    </v-btn>
                                                </div>
                                            </v-sheet>
                                            <span class="grey--text caption">7-19-2019 (3w ago)</span>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </v-col>
                        </v-row>

                        <!-- Alert Row -->
                        <v-row justify="end" class="full_width">
                            <v-col cols="12" md="11" class="pa-0">
                                <v-list class="pa-0 ">
                                    <v-list-item>
                                        <v-list-item-content>
                                            <v-sheet class="pa-3" color="grey lighten-2">
                                                <v-icon>mdi-bell</v-icon> Thanks, but I don't understand. I don't know
                                            </v-sheet>

                                            <v-row class="mx-auto nested_list px-3 pt-2">
                                                <v-flex xl2 lg2 md2 sm2 xs2>
                                                    <v-list-item-avatar height="49" min-width="45" width="45" class="ma-0 display-2" color="transparent">
                                                        <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg"></v-img>
                                                    </v-list-item-avatar>
                                                </v-flex>
                                                <v-flex xl10 lg10 md10 sm10 xs10>
                                                    <v-list-item-content>
                                                        <v-list-item-title class="body-2 font-weight-bold">The filled style is still too big</v-list-item-title>
                                                        <v-list-item-subtitle>
                                                            <span class="primary--text">$15</span>
                                                            <v-btn color="success list_proposal" depressed small class="overline pa-2 float-right"  min-height="20">
                                                                Ship Now
                                                            </v-btn>
                                                        </v-list-item-subtitle>
                                                    </v-list-item-content>
                                                </v-flex>
                                            </v-row>
                                            <span class="grey--text caption text-right">7-19-2019 (3w ago)</span>
                                        </v-list-item-content>
                                        <v-list-item-avatar class="mr-2 mt-n4">
                                            <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg"></v-img>
                                        </v-list-item-avatar>
                                    </v-list-item>
                                </v-list>
                            </v-col>
                        </v-row>

                        <v-row :justify="chat.align" class="full_width" v-for="chat in chats" :key="chat.id">
                            <v-col cols="12" md="10" class="pa-0">
                                <v-list class="pa-0">
                                    <v-list-item>
                                        <v-list-item-avatar class="mr-2 mt-n4" v-if="chat.align == 'start'">
                                            <v-img :src="chat.img"></v-img>
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-sheet class="pa-3" color="grey lighten-2">{{chat.text}}</v-sheet>
                                            <span class="grey--text caption" :class="chat.align == 'end' ? 'text-right' : ''">{{chat.time}}</span>
                                        </v-list-item-content>
                                        <v-list-item-avatar class="mr-2 mt-n4" v-if="chat.align == 'end'">
                                            <v-img :src="chat.img"></v-img>
                                        </v-list-item-avatar>
                                    </v-list-item>
                                </v-list>
                            </v-col>
                        </v-row>
                    </v-container>

                    <v-row class="mx-auto mt-3">
                        <v-flex xl10 lg10 md10 sm10 xs10>
                            <v-textarea
                                outlined
                                name="input-7-4"
                                label="Outlined textarea"
                            ></v-textarea>
                        </v-flex>
                        <v-flex xl2 lg2 md2 sm2 xs2>
                            <v-btn color="primary" depressed class="px-1 ml-3">
                                Send
                            </v-btn>
                            <v-btn color="grayLighten" depressed class="px-1 ml-3 mt-3">
                                <v-icon>mdi-attachment</v-icon>
                            </v-btn>
                        </v-flex>
                    </v-row>
                </v-card-text>
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
            dropdown: [
                { title: 'Click Me' },
                { title: 'Click Me' },
                { title: 'Click Me' },
                { title: 'Click Me 2' },
            ],
            headers: [
                { text: 'Placement', align: 'left', value: 'title', class: 'head_class'},
                { text: 'Status', value: 'status', class: 'head_class'},
                { text: 'Eng. Rate', value: 'engRate', class: 'head_class' },
                { text: 'Comments', value: 'comments', class: 'head_class' },
                { text: 'Like', value: 'likes', class: 'head_class' },
            ],
            desserts: [
                {
                    title: 'My Awesome Campaign 2019',
                    tags: [
                        'Pro Campaign',
                        'Barter'
                    ],
                    status: "Active",
                    comments: '125k',
                    likes: '2.7k',
                    engRate: '2.0',
                    id:'1',
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg'
                },
                {
                    title: 'My Awesome Campaign 2019',
                    tags: [
                        'Pro Campaign',
                        'Barter'
                    ],
                    status: "Active",
                    comments: '125k',
                    likes: '2.7k',
                    engRate: '2.0',
                    id:'2',
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg'
                },
                {
                    title: 'My Awesome Campaign 2019',
                    tags: [
                        'Pro Campaign',
                        'Barter'
                    ],
                    status: "Active",
                    comments: '125k',
                    likes: '2.7k',
                    engRate: '2.0',
                    id:'3',
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg'
                },
                {
                    title: 'My Awesome Campaign 2019',
                    tags: [
                        'Pro Campaign',
                        'Barter'
                    ],
                    status: "Active",
                    comments: '125k',
                    likes: '2.7k',
                    engRate: '2.0',
                    id:'4',
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg'
                },
                {
                    title: 'My Awesome Campaign 2019',
                    tags: [
                        'Pro Campaign',
                        'Barter'
                    ],
                    status: "Active",
                    comments: '125k',
                    likes: '2.7k',
                    engRate: '2.0',
                    id:'5',
                    avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg'
                },
            ],
            chats: [
                { id:'1', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'2', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'3', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'4', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'5', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'6', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'7', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'8', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'9', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'10', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'11', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'12', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'13', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'14', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'15', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'16', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'17', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'18', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'19', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'20', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'21', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'22', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'23', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'24', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'25', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'26', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' },
                { id:'27', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'start' },
                { id:'28', text: 'Lorem Ipsum is simply dummy text of the printing and typesetting', time:'7-19-2019 (3w ago)', img:'https://cdn.vuetifyjs.com/images/lists/1.jpg', align:'end' }

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
    .mail_header {
        border-bottom: 1px solid #cccccc;
    }
    .full_height{
        max-height: 400px !important;
        min-height: 400px !important;
        overflow-y: scroll !important;
    }
    >>>.custom_field .v-input__control{
        min-height: 43px !important;
    }
</style>
