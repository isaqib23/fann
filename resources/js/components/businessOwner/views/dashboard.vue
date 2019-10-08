<template>

    <v-container fluid>
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <v-layout wrap>
            <v-flex xs12 class="pa-2">
                <v-subheader class="pa-0 subtitle-2 black--text">Dashboard</v-subheader>
            </v-flex>
            <!-- Top Content -->
            <v-flex xs12 md7 class="pa-2">
                <v-card class="pa-2" outlined tile >
                    <v-card-text>
                        <div class="subtitle-1 mb-2 text-uppercase"><strong>Campaign</strong></div>
                        <v-simple-table fixed-header height="375px">
                            <thead class="grey lighten-4">
                            <tr>
                                <th class="text-left">Campaign Name</th>
                                <th class="text-left" style="width: 132px">Progress</th>
                                <th class="text-center">
                                    <v-badge overlap color="transparent" >
                                        <template v-slot:badge >
                                            <v-icon color="red">
                                                mdi-circle
                                            </v-icon>
                                        </template>
                                        <v-icon color="grey lighten-1">
                                            mdi-bell
                                        </v-icon>
                                    </v-badge>

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="i in 4" :key="i">
                                <td>
                                    <v-list two-line class="list_cards">
                                        <v-list-item>
                                            <v-list-item-avatar height="50" width="50">
                                                <v-img :src="items.avatar"></v-img>
                                            </v-list-item-avatar>
                                            <v-list-item-content>
                                                <v-list-item-title v-html="items.title"></v-list-item-title>
                                                <v-list-item-subtitle >
                                                    <v-chip-group>
                                                        <v-chip v-for="tag in items.tags" :key="tag">
                                                            {{tag}}
                                                        </v-chip>
                                                    </v-chip-group>
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list>
                                </td>
                                <td>
                                    <p>26% Completed</p>
                                    <v-progress-linear
                                            rounded
                                            value="26"
                                            color="green accent-2"
                                            height="6"
                                            reactive
                                    ></v-progress-linear>
                                </td>
                                <td>You have 13 unread notifications for this campaign</td>
                            </tr>

                            </tbody>
                        </v-simple-table>
                    </v-card-text>
                </v-card>
            </v-flex>
            <v-flex xs12 md5 class="pa-2">
                <v-card class="pa-2" outlined tile>
                    <v-list flat>
                        <v-subheader class="text-uppercase">Notifications</v-subheader>
                        <v-list-item-group color="primary" class="notification-grid-height">
                            <v-list-item
                                    v-for="(notification, i) in notifications"
                                    :key="i"
                            >
                                <v-list-item-content class="pa-2 max-width-13" >
                                    <v-list-item-title v-text="notification.time" class="body-2 text-sm-center text--grey"></v-list-item-title>
                                </v-list-item-content>

                                <v-list-item-icon class="notification-icon-padding grey lighten-4 br-left">
                                    <v-icon v-text="notification.icon"></v-icon>
                                </v-list-item-icon>

                                <v-list-item-content class="grey lighten-4 br-right">
                                    <v-list-item-title v-text="notification.text"></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-card>
            </v-flex>

            <!-- Middle Content -->
            <v-flex xs12 md4 class="pa-2">
                <v-card class="pa-2" outlined tile>
                    <v-card-title class="text-uppercase font-weight-black title">Campaign Reach
                        <v-spacer></v-spacer>
                        <v-select
                                :items="from"
                                label="From"
                                outlined
                                class="float-right max-width-25"
                        ></v-select>
                    </v-card-title>

                    <v-card-text class="pb-0">
                        Analyze the success of your influencer in real time
                    </v-card-text>

                    <v-card-actions class="text-right d-block mr-2 pt-0">
                              <h2 class="font-weight-bold">12K</h2>
                              <span class="error--text">
                                <v-icon color="error" small>mdi-arrow-down</v-icon>13.8%
                             </span>
                    </v-card-actions>
                </v-card>
            </v-flex>
            <v-flex xs12 md4 class="pa-2">
                <v-card class="pa-2" outlined tile>
                    <v-card-title class="text-uppercase font-weight-black title">Social Mentions
                        <v-spacer></v-spacer>
                        <v-select
                                :items="from"
                                label="From"
                                outlined
                                dense
                                height="20px"
                                class="float-right max-width-25"
                        ></v-select>
                    </v-card-title>

                    <v-card-text class="pb-0" max-width="75%">
                        Monitor and engage in conversation happening around your brand
                    </v-card-text>

                    <v-card-actions class="text-right d-block mr-2 pt-0">
                        <h2 class="font-weight-bold">120</h2>
                        <span class="success--text">
                                <v-icon color="success" small>mdi-arrow-up</v-icon>13.8%
                             </span>
                    </v-card-actions>
                </v-card>
            </v-flex>
            <v-flex xs12 md4 class="pa-2">
                <v-card class="pa-2" outlined tile>
                    <v-card-title class="text-uppercase font-weight-black title">Content Pieces
                        <v-spacer></v-spacer>
                        <v-select
                                :items="from"
                                label="From"
                                outlined
                                class="float-right max-width-25"
                        ></v-select>
                    </v-card-title>

                    <v-card-text class="pb-0">
                        Track content curated via your campaigns by influencer
                    </v-card-text>

                    <v-card-actions class="text-right d-block mr-2 pt-0">
                        <h2 class="font-weight-bold">20</h2>
                        <span class="error--text">
                                <v-icon color="error" small>mdi-arrow-down</v-icon>30%
                             </span>
                    </v-card-actions>
                </v-card>
            </v-flex>

            <!-- Bottom Content -->
            <v-flex xs12 md7 class="pa-2">
                <v-card class="pa-2"  outlined  tile >
                    <v-card-text>
                        <div class="subtitle-1 mb-2 text-uppercase"><strong>Payments</strong></div>
                        <v-simple-table>
                            <thead class="grey lighten-4"></thead>
                            <tbody>
                            <tr v-for="i in 4" :key="i">
                                <td width="15%">
                                    <v-list  class="list_cards">
                                        <v-list-item class="px-0">
                                            <v-list-item-avatar height="50" width="50" class="mr-3">
                                                <v-img :src="items.avatar"></v-img>
                                            </v-list-item-avatar>
                                            <v-list-item-content>
                                                <v-list-item-title v-html="items.title"></v-list-item-title>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list>
                                </td>
                                <td>
                                    <p> Laura Miller has marked touch point completed and requested for payemnt $15</p>

                                </td>
                                <td>
                                    <v-btn x-small text class="blue--text overline" >
                                        View Post
                                    </v-btn>
                                    <v-btn x-small text class="blue--text overline" >
                                        Chat
                                    </v-btn>

                                    <v-btn color="primary" rounded class="overline" x-small depressed>
                                        Clear Payment
                                    </v-btn>
                                </td>
                            </tr>

                            </tbody>
                        </v-simple-table>
                    </v-card-text>
                </v-card>
            </v-flex>
            <v-flex xs12 md5 class="pa-2">
                <v-card class="pa-2" outlined tile>
                    <v-card-text>
                        <div class="subtitle-1 mb-2 text-uppercase"><strong>Shipments</strong></div>
                        <v-simple-table>
                            <thead class="grey lighten-4"></thead>
                            <tbody>
                            <tr v-for="i in 3" :key="i" class="grey lighten-4">
                                <td>
                                    <v-list two-line class="list_cards grey lighten-4">
                                        <v-list-item>
                                            <v-list-item-avatar height="50" width="50">
                                                <v-img :src="items.avatar"></v-img>
                                            </v-list-item-avatar>
                                            <v-list-item-content>
                                                <v-list-item-title v-html="items.title"></v-list-item-title>
                                                <v-list-item-subtitle >
                                                   Ship to
                                                    <router-link to="/" color="primary">Velvet Leather Bag </router-link>
                                                   to
                                                    <router-link to="/" color="primary">Umer Dashy </router-link>
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list>
                                </td>
                                <td>
                                    <v-btn  text class="blue--text caption pl-3 pr-3 d-inline-block" >
                                        <v-icon color="green accent-2">
                                            mdi-check
                                        </v-icon>
                                    </v-btn>
                                </td>
                                <td>
                                    <v-btn  text class="blue--text caption pl-3 pr-3 d-inline-block" >
                                        <v-icon color="green accent-2">
                                            mdi-close
                                        </v-icon>
                                    </v-btn>
                                </td>
                            </tr>

                            <tr class="text-left ma-0 pa-0 no-hover" bgcolor="#69F0AE">
                                <td class="ma-0 pa-0"  colspan="3" rowspan="1">
                                    <v-sheet class="px-2" color="green accent-2 white--text">Hello, world! I'm a simple v-sheet -- Hello, world! I'm a simple v-sheet</v-sheet>
                                </td>
                            </tr>

                            </tbody>
                        </v-simple-table>
                    </v-card-text>
                </v-card>
            </v-flex>

        </v-layout>
    </v-container>
</template>

<script>

    export default {
        data: () => ({
            items: {
                avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
                title: 'Brunch this weekend?',
                tags: [
                    'Work',
                    'Art',
                    'Tech'
                ]
            },
            notifications: [
                { text: 'Your Shipment is pending', icon: 'mdi-clock', time: '4 hours'},
                { text: 'Touch point completed', icon: 'mdi-account', time: '3 hours'},
                { text: 'Laura Started Chat', icon: 'mdi-flag', time: '2 hours'},
                { text: 'Your Shipment is pending', icon: 'mdi-clock', time: '4 hours'},
                { text: 'Touch point completed', icon: 'mdi-account', time: '3 hours'},
                { text: 'Laura Started Chat', icon: 'mdi-flag', time: '2 hours'}
            ],
            from: ['Foo', 'Bar', 'Fizz', 'Buzz']
        })
    }
</script>

<style scoped>
    >>>.list_cards .v-avatar {
        border-radius: 10px !important;
    }

    >>>.max-width-25 .v-text-field__details{
        display: none !important;
    }

    >>>.theme--light.v-data-table tbody tr:not(:last-child) {
        border-bottom: 1px solid rgba(0, 0, 0, 0.12) !important;
    }

    .notification-icon-padding {
        padding: 9px;
    }
    .notification-grid-height {
        height: 378px;
        overflow-y: auto;
    }

    .br-left {
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .br-right {
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }
    .max-width-25 {
        max-width: 25%;
    }

    .max-width-13 {
        max-width: 13%;
    }
</style>
