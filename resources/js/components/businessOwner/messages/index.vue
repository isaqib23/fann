<template>
    <div>
        <v-flex class="ma-12">
            <div class="subtitle-1 mb-2"><strong>Inbox</strong></div>
            <v-card class="mx-auto card_wrapper pa-3">
                <v-row class="mx-auto main_wrapper" justify="start">
                    <v-col cols="12" md="2" color="white">
                        <div class="compose pb-5">
                            <v-btn block color="primary">
                                Compose
                            </v-btn>
                        </div>
                        <v-divider></v-divider>
                        <v-list subheader class="mail_lists py-3">
                            <v-list-item
                                class="pa-0"
                                v-for="item in items"
                                :key="item.title"
                                @click=""
                            >
                                <v-list-item-content>
                                    <v-list-item-title v-text="item.title"></v-list-item-title>
                                </v-list-item-content>

                                <v-list-item-action class="pa-0 ma-0" v-if="item.count > 0">
                                    <v-chip small text-color="primary" color="transparent" class="font-weight-bold">{{item.count}}</v-chip>
                                </v-list-item-action>
                            </v-list-item>

                            <v-divider inset></v-divider>

                            <v-subheader inset>Tag</v-subheader>

                            <v-list-item
                                class="pa-0"
                                v-for="item in items2"
                                :key="item.title"
                                @click=""
                            >
                                <v-list-item-avatar>
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
import Proposal from '../popups/Proposal'
import TouchPoint from '../popups/TouchPoint'

    export default {
        components: {
            Proposal:Proposal,
            TouchPoint:TouchPoint
        },
        data: () => {
           return  {
               items: [
                   { icon: 'mdi-circle', title: 'Inbox', count: 5 },
                   { icon: 'mdi-circle', title: 'Sent', count: 0 },
                   { icon: 'mdi-circle', title: 'Draft', count: 0 },
                   { icon: 'mdi-circle', title: 'Trash', count: 0 },
                   { icon: 'mdi-circle', title: 'Important', count: 3 },
                   { icon: 'mdi-circle', title: 'Spam', count: 0 },
                   { icon: 'mdi-circle', title: 'Starred', count: 0 },
               ],
               items2: [
                   { icon: 'mdi-circle', title: 'Instagram', count: '0' },
                   { icon: 'mdi-circle', title: 'Facebook', count: '0' },
                   { icon: 'mdi-circle', title: 'Blog', count: '0' },
               ]
            }
        },
        methods: {}
    }
</script>

<style scoped>
    >>>.mail_lists .v-list-item{
        min-height: 35px !important;
    }
</style>
