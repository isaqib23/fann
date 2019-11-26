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
                            <v-col class="px-0" cols="12" sm="6" md="4">
                                <v-card max-width="285" @click="goToLogin('instagram')">
                                    <v-list-item>
                                        <v-list-item-avatar color="primary" class="mr-2">
                                            <v-icon color="white">mdi-instagram</v-icon>
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-list-item-title class="headline">Instagram</v-list-item-title>
                                            <v-list-item-subtitle>Connected account</v-list-item-subtitle>
                                        </v-list-item-content>
                                        <v-icon color="success" class="mt-n5">mdi-check-circle</v-icon>
                                    </v-list-item>

                                    <v-card-actions class="px-5">
                                        <p class="mb-0 text-center">
                                            Followers<br><span class="title">47.5K</span>
                                        </p>

                                        <v-spacer></v-spacer>
                                        <p class="mb-0 text-center">
                                            Following<br><span class="title">652</span>
                                        </p>
                                    </v-card-actions>
                                </v-card>
                            </v-col>
                            <v-col class="px-0 ml-n10" cols="12" sm="6" md="4">
                                <v-card max-width="285" @click="goToLogin('youtube')">
                                    <v-list-item>
                                        <v-list-item-avatar color="red" class="mr-2">
                                            <v-icon color="white">mdi-youtube</v-icon>
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-list-item-title class="headline">Youtube</v-list-item-title>
                                            <v-list-item-subtitle>Connected account</v-list-item-subtitle>
                                        </v-list-item-content>

                                        <v-icon color="success" class="mt-n5">mdi-check-circle</v-icon>
                                    </v-list-item>

                                    <v-card-actions class="px-5">
                                        <p class="mb-0 text-center">
                                            Followers<br><span class="title">47.5K</span>
                                        </p>

                                        <v-spacer></v-spacer>
                                        <p class="mb-0 text-center">
                                            Following<br><span class="title">652</span>
                                        </p>
                                    </v-card-actions>
                                </v-card>
                            </v-col>
                        </v-row>
                        <v-card-actions class="px-0 ml-n3">
                            <v-btn color="primary" class="caption text-capitalize" large height="40" depressed>Add another social account</v-btn>
                        </v-card-actions>
                    </v-card-text>

                    <v-card-actions class="text-right float-right">
                        <v-btn class="caption mr-3 text-capitalize" large height="40" depressed>Back</v-btn>
                        <v-btn color="primary" class="caption text-capitalize" large height="40" depressed>Submit</v-btn>
                    </v-card-actions>
                </v-flex>
            </v-row>
        </v-card>
    </v-flex>
</template>

<script>
    import {mapGetters} from 'vuex'
    import { api } from '~/config'
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
            },
            route: { type: '/dfdsfdsf', required: true }
        }),

        computed: mapGetters({
            auth: 'auth/user'
        }),
        methods:{
            goToLogin(provider){
                NProgress.start();
                console.log(provider);
                axios.post(api.path('setting.socialLogin'),{"provider":provider})
                    .then(res => {
                        //window.location.href = res.data.url;
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

        mounted() {
            this.user = Object.assign(this.user, this.auth)
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
