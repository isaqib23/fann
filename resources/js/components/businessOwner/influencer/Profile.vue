<template>
    <div>
        <v-flex class="ma-12">
            <div class="subtitle-1 mb-2"><strong>{{ profile.provider_name }}</strong></div>
            <v-card class="mx-auto card_wrapper">
                <span class="primary--text pl-8 pt-8" style="position: absolute"><u>Back</u></span>
                <v-row class="py-12 mx-auto main_wrapper">
                    <v-badge color="primary">
                        <template v-slot:badge>
                            <v-icon dark>
                                mdi-chat
                            </v-icon>
                        </template>
                        <div class="top_wrapper">
                            <v-col class="image_wrapper">
                                <v-avatar height="150" width="150">
                                    <img
                                        :src="profile.provider_photo"
                                    ></img>
                                </v-avatar>
                            </v-col>
                            <v-col class="text-center inner_wrapper">
                                <v-container class="pa-0">
                                    <v-card-title class="my-0 py-0">
                                        <div class="headline mb-2 mr-4"><strong>{{ profile.provider_name }}</strong></div>
                                        <v-rating v-model="rating" color="warning" class="mt-n4"></v-rating>
                                        <v-btn color="grayLighten pl-2 pr-2 ml-4 mr-2 text-capitalize" depressed height="30">
                                            Lifestyle
                                        </v-btn>
                                        <v-btn color="grayLighten pl-2 pr-2 ml-1 text-capitalize" depressed height="30">
                                            Fashion
                                        </v-btn>
                                    </v-card-title>
                                    <div class="text-start ml-4 mt-n2">
                                        <p class="overline integrityColor--text text-capitalize" color="grayLighten">{{ profile.provider_name }}</p>
                                    </div>
                                    <div class="icons text-start ml-4">
                                        <v-icon
                                            :color="selectedPlatform === 1 ? 'primary' : 'integrityColor'"
                                            large
                                            class="mr-3"
                                            v-if="instagram!=null"
                                            @click="changePlatform(1)"

                                        >mdi-instagram</v-icon>
                                        <v-icon
                                            :color="selectedPlatform === 2 ? 'primary' : 'integrityColor'"
                                            large
                                            v-if="youtube!=null"
                                            @click="changePlatform(2)"
                                        >mdi-youtube</v-icon>
                                    </div>
                                    <div class="followers text-start ml-4 mt-3 body-2">
                                        <span class="mr-3 integrityColor--text">
                                            <strong class="mr-2 black--text">{{ profile.user_platform_meta.follower_count }}</strong>Followers
                                        </span>
                                        <span class="mr-3 integrityColor--text">
                                            <strong class="mr-2 black--text">{{ profile.user_platform_meta.following_count }}</strong>Following
                                        </span>
                                        <span class="mr-3 integrityColor--text">
                                            <strong class="mr-2 black--text">{{ profile.user_platform_meta.post_count}}</strong>Posts
                                        </span>
                                    </div>
                                    <div class="text-start ml-4 mt-2">
                                        <p class="text-justify integrityColor--text caption">
                                            {{ bio }}
                                        </p>
                                    </div>
                                    <div class="icons text-start ml-4">
                                        <span class="custom_icon"><v-icon color="red">mdi-fire</v-icon></span>
                                        <span class="custom_icon"><v-icon color="indigo">mdi-shield-half-full</v-icon></span>
                                        <span class="custom_icon"><v-icon color="warning">mdi-wifi-strength-4</v-icon></span>
                                    </div>
                                    <div class="buttons text-right mt-n6">
                                        <v-spacer></v-spacer>
                                        <v-dialog v-model="proposal" max-width="70%" transition="slide-y-reverse-transition">
                                            <template v-slot:activator="{ on }">
                                                <v-btn color="grayLighten ml-4 mr-2 text-capitalize" depressed height="32" v-on="on">
                                                    Invite to campaign
                                                </v-btn>
                                            </template>
                                            <Proposal></Proposal>
                                        </v-dialog>
                                        <v-dialog v-model="touchPoint" max-width="50%" transition="slide-y-reverse-transition">
                                            <template v-slot:activator="{ on }">
                                                <v-btn color="primary ml-1 text-capitalize" depressed height="32" v-on="on">
                                                    Make Offer
                                                </v-btn>
                                            </template>
                                            <TouchPoint></TouchPoint>
                                        </v-dialog>
                                    </div>
                                </v-container>
                            </v-col>
                        </div>
                    </v-badge>
                </v-row>
            </v-card>

           <InstagramProfile v-if="selectedPlatform === 1" platform="1" :userProfile="profile"></InstagramProfile>
            <YoutubeProfile v-if="selectedPlatform === 2" platform="2" :userProfile="profile"></YoutubeProfile>
        </v-flex>
    </div>
</template>

<script>
    import Proposal from '../popups/Proposal'
    import TouchPoint from '../popups/TouchPoint'
    import { mapGetters, mapActions} from  'vuex'
    import InstagramProfile from "./instagramProfile";
    import YoutubeProfile from "./youtubeProfile";

    export default {
        components: {
            YoutubeProfile,
            InstagramProfile,
            Proposal:Proposal,
            TouchPoint:TouchPoint
        },
        props: {
            platform : ''
        },
        data: () => {
            return  {
                youtube : null,
                instagram : null,
                selectedPlatform : 2,
                rating: 3,
                items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
                show: true,
                proposal: false,
                touchPoint: false,
                profile : {
                    provider_name : null,
                    provider_photo : null,
                    user_id : null,
                    provider :null,
                    meta_json : null,
                },

            }
        },
        computed:{
            ...mapGetters({
                campaignPlacement : 'campaign/campaignPlacement'
            }),
            bio() {

                let meta = JSON.parse(this.profile.meta_json);
                if(meta.bio) {

                         return meta.user.bio;
                 }
                 return null;
            }
        },
        mounted() {
            // this.platform = this.campaignPlacement['platform'];
           this.profileData();

        },
        methods: {
            ...mapActions({
                getProfile : 'influencer/getProfile',
            }),
            async profileData() {
                let self = this;
                let pros = await this.getProfile(16);

                _.forEach(pros, function(value) {
                    if(value.provider === 'instagram'){
                        self.instagram  = value;
                    }else{
                        self.youtube  = value;
                    }
                });
                this.changePlatform(this.selectedPlatform);
            },

            changePlatform(val) {
                this.selectedPlatform = val;

                if(this.selectedPlatform === 1){
                    this.profile = '';
                    this.profile = this.instagram;
                }else if(this.selectedPlatform === 2){
                    this.profile = '';
                    this.profile = this.youtube;
                }


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
        /*max-width: 55% !important;*/
        max-width: 700px !important;
        min-width: 700px !important;
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



