<template>
    <v-row justify="start">
        <v-col class="px-0" cols="12" sm="6" md="4" v-for="(platform, index) in userPlatforms">
            <v-card max-width="285">
                <v-list-item>
                    <v-list-item-avatar
                        :color="platform.provider != 'instagram' ? 'red' : 'primary'"
                        class="mr-2"
                    >
                        <v-icon color="white">mdi-{{platform.provider}}</v-icon>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title class="headline text-capitalize">{{platform.provider}}</v-list-item-title>
                        <v-list-item-subtitle>
                            Connected
                        </v-list-item-subtitle>
                    </v-list-item-content>
                    <v-icon
                        :color="platform.provider != 'instagram' ? 'success' : 'primary'"
                        class="mt-n5"
                    >mdi-check-circle</v-icon>
                </v-list-item>

                <v-card-actions class="px-5">
                    <p class="mb-0 text-center">
                        Followers<br><span class="title">{{platform.followers}}</span>
                    </p>

                    <v-spacer></v-spacer>
                    <p class="mb-0 text-center">
                        Following<br><span class="title">{{platform.followings}}</span>
                    </p>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
    import { api } from '~/config'
    export default {
        props: ['userPlatforms'],
        methods:{
            goToSocialLogin(provider){
                NProgress.start();
                axios.post(api.path('setting.socialLogin'),{"provider":provider})
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
            }
        },
    }
</script>
<style scoped>

</style>
