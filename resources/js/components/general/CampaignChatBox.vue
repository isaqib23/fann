<template>
    <v-card>
        <div class="mail_header pa-5">
            <div class="subtitle-1 mb-2">
                Brunch this weekend?
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
                        <span class="float-right caption">25 August</span>
                    </v-list-item-title>
                    <v-list-item-subtitle>to <strong class="black--text">me</strong></v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </div>

        <v-card-text>
            <v-container class="pa-0 full_height" v-chat-scroll>
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
                                            <v-btn color="primary list_proposal" depressed small class="text-capitalize overline pa-2" min-height="20">
                                                Request Change
                                            </v-btn>
                                            <v-btn color="success list_proposal" depressed small class="text-capitalize overline  pa-2"  min-height="20">
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
                                                    <v-btn color="success list_proposal" depressed small class="text-capitalize overline pa-2 float-right"  min-height="20">
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

            <v-row class="mx-auto ma-0 pa-0">
                <v-flex md12>
                    <span class="primary--text mr-2">Reply</span>
                    <span class="grey--text">Note</span>
                </v-flex>
            </v-row>
            <v-row class="mx-auto mt-3">
                <v-flex xl10 lg10 md10 sm10 xs10>
                    <v-textarea
                        v-model="input"
                        outlined
                        name="input-7-4"
                        label="Outlined textarea"
                    ></v-textarea>
                </v-flex>
                <v-flex xl2 lg2 md2 sm2 xs2>
                    <v-btn color="primary" depressed class="text-capitalize px-1 ml-3">
                        Send
                    </v-btn>
                    <v-btn color="grayLighten" depressed class="px-1 ml-3 mt-3">
                        <v-icon>mdi-attachment</v-icon>
                    </v-btn>
                    <emoji-picker @emoji="insert" :search="emojiSearch" class="d-inline">
                        <div
                            class="emoji-invoker d-inline"
                            slot="emoji-invoker"
                            slot-scope="{ events: { click: clickEvent } }"
                            @click.stop="clickEvent"
                        >
                            <v-btn color="grayLighten" depressed class="px-1 ml-3 mt-3">
                                <v-icon>tag_faces</v-icon>
                            </v-btn>

                        </div>
                        <div slot="emoji-picker" slot-scope="{ emojis, insert, display }">
                            <div class="emoji-picker">
                                <div class="emoji-picker__search">
                                    <input type="text" v-model="emojiSearch">
                                </div>
                                <div>
                                    <div :key="category" v-for="(emojiGroup, category) in emojis">
                                        <h5>{{ category }}</h5>
                                        <div class="emojis">
                                                    <span
                                                        :key="emojiName"
                                                        :title="emojiName"
                                                        @click="insert(emoji)"
                                                        v-for="(emoji, emojiName) in emojiGroup"
                                                    >
                                                        {{ emoji }}
                                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </emoji-picker>
                </v-flex>
            </v-row>
        </v-card-text>
    </v-card>
</template>

<script>
    import Vue from 'vue';
    import EmojiPicker from 'vue-emoji-picker';
    import VueChatScroll from 'vue-chat-scroll';
    import { mapGetters, mapActions } from 'vuex';
    Vue.use(VueChatScroll)
    export default {
        name: "CampaignChatBox",
        components: {
            EmojiPicker,
            VueChatScroll
        },
        data: () => ({
            input:'',
            rating: 3,
            emojiSearch : "",
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
        }),
        methods: {
            ...mapActions({
                initiateCampaignChat : 'campaignManagement/initiateCampaignChat'
            }),
            insert(emoji) {
                this.input += emoji
            },
        },
        created() {
            Echo.channel('campaignChat').listen('CampaignChatEvent', event => {
                console.log(event, "its listening");
            })
        },
        mounted() {
            let arr = [];
            arr.push({chatTo:8, chatBy: 7});
            this.initiateCampaignChat(arr);

        }
    }
</script>
<style scoped>
    >>>.emoji-picker {
        position: absolute !important;
        z-index: 1 !important;
        font-family: Montserrat !important;
        border: 1px solid #ccc !important;
        width: 15rem !important;
        height: 20rem ;
        overflow: scroll !important;
        padding: 1rem !important;
        box-sizing: border-box !important;
        border-radius: 0.5rem !important;
        background: #fff !important;
        box-shadow: 1px 1px 8px #c7dbe6 !important;
        bottom:65px !important;
        right:0;
    }
    >>>.emoji-picker__search {
        display: flex;
    }
    >>>.emoji-picker__search > input {
        flex: 1;
        border-radius: 10rem;
        border: 1px solid #ccc;
        padding: 0.5rem 1rem;
        outline: none;
    }
    >>>.emoji-picker h5 {
        margin-bottom: 0;
        color: #b1b1b1;
        text-transform: uppercase;
        font-size: 0.8rem;
        cursor: default;
    }
    >>>.emoji-picker .emojis {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    >>>.emoji-picker .emojis:after {
        content: "";
        flex: auto;
    }
    >>>.emoji-picker .emojis span {
        padding: 0.2rem;
        cursor: pointer;
        border-radius: 5px;
    }
    >>>.emoji-picker .emojis span:hover {
        background: #ececec;
        cursor: pointer;
    }

    .mail_header {
        border-bottom: 1px solid #cccccc;
    }
    .full_height{
        max-height: 400px !important;
        min-height: 400px !important;
        overflow-y: scroll !important;
    }

</style>
