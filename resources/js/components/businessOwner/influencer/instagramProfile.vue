<template>
    <div>
         <v-card class="mx-auto card_wrapper" color="gutterDark">
                <v-row class="py-12 mx-auto main_wrapper">
                    <v-row align="center" class="full_width">
                        <v-col class="d-flex" cols="4">
                            <div class="subtitle-1 mb-2"><strong>Instagram Stats Overview</strong></div>
                        </v-col>
                        <v-spacer></v-spacer>
                        <v-col class="d-flex" cols="2">
                            <v-select :items="items" label="Platform" solo class="custom_dropdown" append-icon="keyboard_arrow_down"></v-select>
                        </v-col>
                        <v-col class="d-flex" cols="2">
                            <v-select :items="items" label="From" solo class="custom_dropdown" append-icon="keyboard_arrow_down"></v-select>
                        </v-col>
                    </v-row>

                    <v-row class="full_width" align="center">
                        <v-col class="d-flex" cols="3">
                            <v-card min-width="100%">
                                <v-card-title class="overline1">
                                    Media Posts (last 30 days)
                                    <v-spacer></v-spacer>
                                    <div class="icons text-end">
                                        <span class="custom_icon bg1"><v-icon class="title" color="#C73EA9">mdi-instagram</v-icon></span>
                                    </div>
                                </v-card-title>
                                <v-card-text class="display-1 pb-0"><strong color="darkSecondary">{{ data.countLatestPosts}}</strong></v-card-text>
                                <v-card-actions class="pl-5">
                                    <span class="error--text mr-2">
                                        <v-icon color="error" small>mdi-arrow-down</v-icon>13.8%
                                    </span>
                                    <span class="overline1">Less post then ussual.</span>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                        <v-col class="d-flex" cols="3">
                            <v-card min-width="100%">
                                <v-card-title class="overline1">
                                    Followers (last 30 days)
                                    <v-spacer></v-spacer>
                                    <div class="icons text-end">
                                        <span class="custom_icon bg2"><v-icon class="title" color="#1788F9">mdi-account-clock-outline</v-icon></span>
                                    </div>
                                </v-card-title>
                                <v-card-text class="display-1 pb-0"><strong color="darkSecondary">{{ userProfile.user_platform_meta.follower_count }}</strong></v-card-text>
                                <v-card-actions class="pl-5">
                                    <span class="success--text mr-2">
                                        <v-icon color="success" small>mdi-arrow-up</v-icon>13.8%
                                    </span>
                                    <span class="overline1">Less post then ussual.</span>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                        <v-col class="d-flex" cols="3">
                            <v-card min-width="100%">
                                <v-card-title class="overline1">
                                    Total Likes (last 30 days)
                                    <v-spacer></v-spacer>
                                    <div class="icons text-end">
                                        <span class="custom_icon bg3"><v-icon class="title" color="primary">mdi-heart</v-icon></span>
                                    </div>
                                </v-card-title>
                                <v-card-text class="display-1 pb-0"><strong color="darkSecondary">{{ data.countLastLikes}}</strong></v-card-text>
                                <v-card-actions class="pl-5">
                                    <span class="success--text mr-2">
                                        <v-icon color="success" small>mdi-arrow-down</v-icon>13.8%
                                    </span>
                                    <span class="overline1">Less post then ussual.</span>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                        <v-col class="d-flex" cols="3">
                            <v-card min-width="100%">
                                <v-card-title class="overline1">
                                    Total Comments (last 30 days)
                                    <v-spacer></v-spacer>
                                    <div class="icons text-end">
                                        <span class="custom_icon bg4"><v-icon color="#FDBA2C" class="title">mdi-tooltip</v-icon></span>
                                    </div>
                                </v-card-title>
                                <v-card-text class="display-1 pb-0"><strong color="darkSecondary">{{ data.countLastComments }}</strong></v-card-text>
                                <v-card-actions class="pl-5">
                                    <span class="error--text mr-2">
                                        <v-icon color="error" small>mdi-arrow-down</v-icon>13.8%
                                    </span>
                                    <span class="overline1">Less post then ussual.</span>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                    </v-row>

                    <div class="subtitle-1 mb-3 mt-3"><strong>Featured Posts</strong></div>

                    <v-row class="full_width" align="center">
                        <v-col class="d-flex" cols="4" v-for="(post,index) in  posts " :key="index">
                            <v-card
                                max-width="344"
                                class="mx-auto"
                            >
                                <v-list-item>
                                    <v-list-item-avatar color="grey">
                                        <img :src="userProfile.provider_photo"></img>
                                    </v-list-item-avatar>
                                    <v-list-item-content>
                                        <v-list-item-title class="subtitle-2">{{ userProfile.provider_name}}</v-list-item-title>
                                        <v-list-item-subtitle class="caption">{{ userProfile.user_platform_meta.follower_count }} Followers</v-list-item-subtitle>
                                    </v-list-item-content>

                                    <v-btn color="primary" class="text-capitalize" depressed height="30">
                                        View Profile
                                    </v-btn>
                                </v-list-item>

                                <v-img
                                    :src="post.images.standard_resolution.url"
                                    height="194"
                                ></v-img>

                                <v-card-text class="py-2">
                                    <strong class="primary--text">View more on instagram</strong>
                                </v-card-text>

                                <v-card-actions class="action_class">
                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on }">
                                            <v-icon v-on="on" class="mr-2">mdi-heart-outline</v-icon>
                                        </template>
                                        <span>{{post.likes.count}}</span>
                                    </v-tooltip>
                                    <v-icon class="mr-2">mdi-tooltip-outline</v-icon>
                                    <v-icon>mdi-briefcase-upload-outline</v-icon>
                                    <div class="flex-grow-1"></div>
                                    <v-btn icon>
                                        <v-icon>mdi-share-variant</v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                    </v-row>
                    <div class="full_width text-end"><v-btn large text>Back</v-btn></div>
                </v-row>
            </v-card>
    </div>
</template>

<script>
    import Proposal from '../popups/Proposal'
    import TouchPoint from '../popups/TouchPoint'
    import { mapGetters, mapActions} from  'vuex'

    export default {
        components: {
            Proposal:Proposal,
            TouchPoint:TouchPoint
        },
        props: {
            platform : null,
            userProfile : null,
        },
        data: () => {
            return  {
                rating: 3,
                items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
                show: true,
                proposal: false,
                touchPoint: false,
                posts : [],
                data : []

            }
        },
        computed:{

        },
        mounted() {
            this.postsData();
        },
        methods: {
            ...mapActions({
                getPost : 'influencer/getPost',

            }),
           async postsData() {
                this.data = await this.getPost(this.userProfile.id);

                this.posts = this.data.posts;
                console.log(this.posts,"posts");

            }
        }
    }
</script>

<style scoped>
    .main_wrapper{
        width: 85%;
    }
    >>>.card_wrapper .v-badge__badge{
        margin-top: 20px !important;
        padding: 15px;
        border-radius: 50px;
        height:auto !important;
    }
    >>>.v-sheet{
        border-bottom-left-radius: 0px !important;
        border-bottom-right-radius: 0px !important;
    }
    >>>.gutterDark.v-sheet{
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
    >>>.v-rating .v-icon{
        padding:0px;
    }
    .inner_wrapper{
        max-width: 55% !important;
        float: left !important;
    }
    .image_wrapper{
        max-width: 17% !important;
        float: left !important;
    }
    .icons .custom_icon{
        padding: 4px 2px;
        border-radius: 50px;
        height: auto !important;
        background: #FDE0E1;
        border: 3px solid #fff;
        -webkit-box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.2);
        -moz-box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.2);
        box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.2);
    }
    .icons .custom_icon:nth-child(2) {
        background: #D8CEFD;
    }
    .icons .custom_icon:nth-child(3) {
        background: #FEF7DA;
    }
    .overline1{
        font-size: 11px;
    }
    .overline1 .custom_icon{
        padding: 8px 6px !important;
        border-radius: 50px;
        height: auto !important;
        border: none;
        box-shadow: none;
    }
    >>>.v-btn {
        font-size: 10px !important;
    }
    .action_class {
        border-top: 1px solid #ccc;
    }
    >>>.custom_dropdown .v-input__control{
        min-height: 45px !important;
    }
    >>>.custom_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    .bg1{
        background: #F7E1F2 !important;
    }
    .bg2{
        background: #DCECFC !important;
    }
    .bg3{
        background: #FBDFE0 !important;
    }
    .bg4{
        background: #FFF6DA !important;
    }
</style>
