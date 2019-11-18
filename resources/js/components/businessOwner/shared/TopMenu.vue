<template>
    <v-app-bar elevate-on-scroll app>
        <v-progress-linear
            :active="loading"
            :indeterminate="loading"
            absolute
            bottom
            color="deep-purple accent-4"
        ></v-progress-linear>
        <v-app-bar-nav-icon @click.stop="navToggle"></v-app-bar-nav-icon>
        <v-toolbar-title class="white--text">{{ appName }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <!--<v-btn icon large
               :color="$vuetify.theme.dark ? 'black' : 'white'"
               title="Toggle Night Mode" @click="toggleNight">
            <v-icon>invert_colors</v-icon>
        </v-btn>-->
        <v-toolbar-items>
            <v-btn icon>
                <v-icon>mdi-chat</v-icon>
            </v-btn>
            <v-menu bottom :offset-y="true">
                <template v-slot:activator="{ on }">
                    <v-btn icon v-on="on">
                        <v-badge overlap color="transparent" >
                            <template v-slot:badge >
                                <v-icon color="warning" class="caption mt-n1 mr-n1">
                                    mdi-circle
                                </v-icon>
                            </template>
                            <v-icon>
                                mdi-bell
                            </v-icon>
                        </v-badge>
                    </v-btn>
                </template>
                <v-card>
                    <v-card-title class="border_bottom body-1">David's Activity</v-card-title>
                    <v-card-text>
                        <v-list>
                            <v-list-item
                                v-for="(item, index) in items"
                                :key="index"
                                @click=""
                            >
                                <v-list-item-avatar>
                                    <v-list-item-avatar class="mr-1">
                                        <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg"></v-img>
                                    </v-list-item-avatar>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title class="body-2">
                                        <strong>David Lee</strong> sent you content for review
                                    </v-list-item-title>
                                    <v-list-item-subtitle>4 min ago</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                        <v-card-actions class="pt-12 border_top">
                            <v-btn text class="mx-auto blue--text">View all notifications</v-btn>
                        </v-card-actions>
                    </v-card-text>
                </v-card>
            </v-menu>
            <v-divider class="ml-2 grey--text" inset vertical></v-divider>
            <v-menu offset-y left>
                <template v-slot:activator="{ on }">
                    <v-btn
                        text
                        depressed
                        v-on="on"
                        :class="$vuetify.breakpoint.smAndUp ? '' : 'pr-12'"
                    >
                        {{username}}
                        <v-avatar :size="32" class="mx-2">
                            <v-icon :size="40">account_circle</v-icon>
                        </v-avatar>
                        <i class="material-icons">arrow_drop_down</i>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item @click="changeShop(shop.id)" v-for="(shop, index) in shops" :key="index">
                        <v-list-item-title
                            :class="(selectedShop == shop.id) ? 'primary--text' : ''"
                        >
                            {{ shop.name }}
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="logout">
                        <v-list-item-title>Logout</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-toolbar-items>
    </v-app-bar>
</template>

<script>
    import {settings} from '~/config'
    import {mapGetters} from 'vuex'
    import axios from 'axios'
    import {api} from '~/config'

    export default {
        data: () => ({
            appName: settings.appName,
            avatar: '',
            username: '',
            loading: false,
            shops: [],
            selectedShop:null,
            items: [
                { title: 'Click Me' },
                { title: 'Click Me' },
                { title: 'Click Me' },
                { title: 'Click Me 2' },
            ]
        }),
        computed: mapGetters({
            auth: 'auth/user'
        }),
        methods: {
            toggleNight() {
                this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
            },
            navToggle() {
                this.$emit('nav-toggle')
            },
            async logout() {
                await this.$store.dispatch('auth/logout');
                this.$toast.info('You are logged out.');
                this.$router.push({name: 'login'});
            },
            getLinkedShops: function () {
                let self = this;
                self.busy = true;
                axios
                    .get(api.path('linkedShops'))
                    .then(function (resp) {
                        self.shops = resp.data;
                        self.busy = false;
                        if(self.selectedShop === null){
                            console.log('selectedShop SHop: ',self.selectedShop);
                            self.selectedShop = self.shops[0].id;
                        }
                    });
            },
            changeShop: function (shopId) {
                localStorage.selectedShop = shopId;
                this.selectedShop = shopId;
            }
        },
        mounted() {
            this.username = this.auth.first_name;
            this.getLinkedShops();
            if (localStorage.selectedShop) {
                this.selectedShop = localStorage.selectedShop;
            }
        },
        watch: {
            loading (val) {
                if (!val) return

                setTimeout(() => (this.loading = false), 3000)
            }
        }
    }
</script>
<style scoped>
    .border_bottom{
        border-bottom: 1px solid #EDEDED;
    }
    .border_top{
        border-top: 1px solid #EDEDED;
    }
    >>>.highlighted {
        background: red !important;
    }
</style>
