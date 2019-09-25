<template>

    <v-container fluid>
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <v-layout wrap>
            <v-flex xs12 class="pa-2">
                <v-subheader class="pa-0 subtitle-2 black--text">Dashboard</v-subheader>
            </v-flex>
            <!-- Top Content -->
            <v-flex xs12 md7 class="pa-2">
                <v-card class="pa-2"  outlined  tile >
                    <v-card-text>
                        <div class="subtitle-1 mb-2"><strong>Campaign</strong></div>
                        <v-simple-table>
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
                                            color="green  accent-2"
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
                <v-card
                        class="pa-2"
                        outlined
                        tile
                >
                    .col-6 .col-md-4
                </v-card>
            </v-flex>

            <!-- Middle Content -->
            <v-flex xs12 md4 class="pa-2">
                <v-card
                        class="pa-2"
                        outlined
                        tile
                >
                    .col-6 .col-md-4
                </v-card>
            </v-flex>
            <v-flex xs12 md4 class="pa-2">
                <v-card
                        class="pa-2"
                        outlined
                        tile
                >
                    .col-6 .col-md-4
                </v-card>
            </v-flex>
            <v-flex xs12 md4 class="pa-2">
            <v-card
                    class="pa-2"
                    outlined
                    tile
            >
                .col-6 .col-md-4
            </v-card>
        </v-flex>

            <!-- Bottom Content -->
            <v-flex xs12 md7 class="pa-2">
                <v-card class="pa-2"  outlined  tile >
                    .col-12 .col-md-8
                </v-card>
            </v-flex>
            <v-flex xs12 md5 class="pa-2">
                <v-card
                        class="pa-2"
                        outlined
                        tile
                >
                    .col-6 .col-md-4
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
            }
        })
    }
</script>

<style scoped>
    >>>.list_cards .v-avatar{
        border-radius: 10px !important;
    }

</style>
