<template>
    <v-row justify="start">
        <v-col class="px-0" cols="12" sm="6" md="4">
            <v-card max-width="285" @click="goToSocialLogin('instagram')">
                <v-list-item>
                    <v-list-item-avatar color="grey" class="mr-2">
                        <v-icon color="white">mdi-instagram</v-icon>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title class="headline">Instagram</v-list-item-title>
                        <v-list-item-subtitle>Not Connected</v-list-item-subtitle>
                    </v-list-item-content>
                    <v-icon color="grey" class="mt-n5">mdi-check-circle</v-icon>
                </v-list-item>

                <v-card-actions class="px-5">
                    <p class="mb-0 text-center">
                        Followers<br><span class="title">-</span>
                    </p>

                    <v-spacer></v-spacer>
                    <p class="mb-0 text-center">
                        Following<br><span class="title">-</span>
                    </p>
                </v-card-actions>
            </v-card>
        </v-col>
        <v-col class="px-0 ml-n10" cols="12" sm="6" md="4">
            <v-card max-width="285" @click="goToSocialLogin('youtube')">
                <v-list-item>
                    <v-list-item-avatar color="grey" class="mr-2">
                        <v-icon color="white">mdi-youtube</v-icon>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title class="headline">Youtube</v-list-item-title>
                        <v-list-item-subtitle>Not Connected</v-list-item-subtitle>
                    </v-list-item-content>

                    <v-icon color="grey" class="mt-n5">mdi-check-circle</v-icon>
                </v-list-item>

                <v-card-actions class="px-5">
                    <p class="mb-0 text-center">
                        Followers<br><span class="title">-</span>
                    </p>

                    <v-spacer></v-spacer>
                    <p class="mb-0 text-center">
                        Following<br><span class="title">-</span>
                    </p>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
    import { api } from '~/config'
    import NProgress from 'nprogress';
    export default {
        methods:{
            goToSocialLogin(provider){
                console.log(provider);
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
