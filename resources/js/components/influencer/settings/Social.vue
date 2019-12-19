<template>
    <v-flex class="my-12 mx-auto card_wrapper">
        <div class="subtitle-2 mb-2 text-uppercase"><strong>Social Accounts</strong></div>
        <v-card class="pa-6">
            <v-row class="mx-auto">
                <v-flex xl12 lg12 md12 sm12 sx12 class="mr-12">
                    <v-card-text class="mb-10">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum maiores modi quidem veniam, expedita quis laboriosam, ullam facere adipisci, iusto, voluptate sapiente corrupti asperiores rem nemo numquam fuga ab at.</p>

                        <div class="subtitle-1 mb-2 black--text"><strong>Connected Social Accounts</strong></div>

                        <v-row justify="start">
                            <v-col class="px-0" cols="12" sm="6" md="4"
                                   v-for="(platform, index) in platforms"
                                   :key="index"
                            >
                                <v-card
                                    max-width="285"
                                    v-on="platform.user_platforms == null? { click: () => goToSocialLogin(platform.slug) } : {}"
                                >
                                    <v-list-item>
                                        <v-list-item-avatar
                                            :color="platform.user_platforms == null ? 'grey' : platform.slug != 'instagram' ? 'red' : 'primary'"
                                            class="mr-2"
                                        >
                                            <v-icon color="white">mdi-{{platform.slug}}</v-icon>
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-list-item-title class="headline text-capitalize">{{platform.slug}}</v-list-item-title>
                                            <v-list-item-subtitle>
                                                {{(platform.user_platforms == null) ? 'Not Connected' : 'Connected'}}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                        <v-icon
                                            :color="platform.user_platforms == null ? 'grey' : platform.slug != 'instagram' ? 'success' : 'primary'"
                                            class="mt-n5"
                                        >mdi-check-circle</v-icon>
                                    </v-list-item>

                                    <v-card-actions class="px-5">
                                        <p class="mb-0 text-center">
                                            Followers<br><span class="title">
                                            {{getFollowerCount(platform.user_platforms, platform.slug)}}

                                        </span>
                                        </p>

                                        <v-spacer></v-spacer>
                                        <p class="mb-0 text-center">
                                            Following<br><span class="title">
                                            {{getFollowingCount(platform.user_platforms, platform.slug)}}
                                        </span>
                                        </p>
                                    </v-card-actions>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-flex>
            </v-row>
        </v-card>
    </v-flex>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    import NProgress from 'nprogress';

    export default {
        data: () => ({
            rules: [
                value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
            ],
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            user: {
                name: null,
                email: null,
            }
        }),
        computed: mapGetters({
            auth        : 'auth/user',
            platforms   : 'settings/userPlatforms'
        }),
        methods:{
            ...mapActions({
                getUserPlatforms: 'settings/getUserPlatforms'
            }),
            goToSocialLogin(provider) {
                NProgress.start();
                axios.post(api.path('setting.socialLogin'), {"provider": provider})
                    .then(res => {
                        window.location.href = res.data.url;
                    })
                    .catch(err => {
                        NProgress.done();
                        this.handleErrors(err.response.data.errors)
                    })
                    .then(() => {
                        NProgress.done();
                    })
            },
            getFollowerCount(platforms, provider){

                let result = _.find(platforms, ['provider', provider]);
                return (_.isNil(result) ? '-' : result.user_platform_meta.follower_count);
            },
            getFollowingCount(platforms, provider){

                let result = _.find(platforms, ['provider', provider]);
                return (_.isNil(result) ? '-' : result.user_platform_meta.following_count);
            }
        },
        async mounted() {
            this.user = Object.assign(this.user, this.auth);
            await this.getUserPlatforms();
        }
    }
</script>
<style scoped>
    .card_wrapper{
        width: 90%;
    }
    >>>.table_card .v-card__title{
        background: #dcdcdc !important;
    }
    >>>.table_card .v-list-item__icon .v-icon.v-icon{
        font-size: 48px !important;
    }
</style>
