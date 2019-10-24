<template>
    <div>
        <v-flex :class="$vuetify.breakpoint.mdAndUp ? 'ma-12' : 'ma-1'">
            <div class="subtitle-1 mb-2"><strong>Inbox</strong></div>
            <v-card class="mx-auto card_wrapper">
                <v-row class="mx-auto main_wrapper" justify="start">
                    <v-col cols="12" md="2" color="white" class="pa-0 left_border">
                        <div class="compose text-center pa-5">
                            <v-btn class="text-capitalize" color="primary" block :to="{ name: 'message-compose'}">
                                Compose
                            </v-btn>
                        </div>
                        <v-divider></v-divider>
                        <v-list subheader class="mail_lists pl-10">
                            <v-list-item
                                class="pa-0"
                                v-for="(item, index) in items"
                                :key="item.title"
                                @click="goToInbox()"
                            >
                                <v-list-item-content>
                                    <v-list-item-title :class="index ? '' : 'primary--text'" v-text="item.title"></v-list-item-title>
                                </v-list-item-content>

                                <v-list-item-action class="pa-0 ma-0" v-if="item.count > 0">
                                    <v-chip small text-color="primary" color="transparent" class="font-weight-bold">{{item.count}}</v-chip>
                                </v-list-item-action>
                            </v-list-item>

                            <v-divider inset></v-divider>

                            <v-subheader class="ml-0 subtitle-1 font-weight-bold pl-0 black--text">Tag</v-subheader>

                            <v-list-item
                                class="pa-0 ml-n4"
                                v-for="item in items2"
                                :key="item.title"
                                @click=""
                            >
                                <v-list-item-avatar class="ma-0">
                                    <v-icon
                                        class="overline"
                                        color="primary"
                                        v-text="item.icon"
                                    ></v-icon>
                                </v-list-item-avatar>

                                <v-list-item-content>
                                    <v-list-item-title v-text="item.title"></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-col>
                    <router-view></router-view>
                </v-row>
            </v-card>
        </v-flex>
    </div>
</template>

<script>

    export default {
        components: {

        },
        data: () => {
           return  {
               items: [
                   { icon: 'mdi-circle', title: 'Inbox', count: 5, active: true },
                   { icon: 'mdi-circle', title: 'Sent', count: 0, active: true },
                   { icon: 'mdi-circle', title: 'Draft', count: 0, active: true },
                   { icon: 'mdi-circle', title: 'Trash', count: 0, active: true },
                   { icon: 'mdi-circle', title: 'Important', count: 3, active: true },
                   { icon: 'mdi-circle', title: 'Spam', count: 0, active: true },
                   { icon: 'mdi-circle', title: 'Starred', count: 0, active: true },
               ],
               items2: [
                   { icon: 'mdi-circle', title: 'Instagram', count: '0' },
                   { icon: 'mdi-circle', title: 'Facebook', count: '0' },
                   { icon: 'mdi-circle', title: 'Blog', count: '0' },
               ]
            }
        },
        methods: {
            goToInbox(){
                this.$router.push({name:'message-inbox'})
            }
        }
    }
</script>

<style scoped>
    >>>.mail_lists .v-list-item{
        min-height: 35px !important;
    }
    .left_border {
        border-right: 1px solid #EDEDED !important;
    }
</style>
