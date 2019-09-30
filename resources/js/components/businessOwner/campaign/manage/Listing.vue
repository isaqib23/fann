<template>
    <v-layout wrap class="ma-3 pa-2">
        <v-flex xs12 fluid>
                <v-btn color="primary" large class="ma-2 d-inline-block float-left">
                    Create Campaign
                </v-btn>
                <v-text-field
                        class="float-left"
                        solo
                        depressed
                        label="Search / Add Filters"
                        prepend-inner-icon="search"
                ></v-text-field>
        </v-flex>
        <!-- Top Content -->
        <v-flex xs12 md7 class="pa-2">
            <v-card class="pa-2" outlined tile >
                <v-card-text>
                    <v-simple-table fixed-header height="auto">
                            <thead>
                            <tr class="font-weight-black text-uppercase">
                                <th class="text-left black--text">
                                    <v-checkbox value="true"></v-checkbox>
                                </th>
                                <th class="text-left black--text">Campaign</th>
                                <th class="text-left black--text">status</th>
                                <th class="text-left black--text">impressions</th>
                                <th class="text-left black--text">actions</th>
                                <th class="text-left black--text">eng.rate</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="i in 8" :key="i">
                                <td><v-checkbox value="true"></v-checkbox></td>
                                <td>
                                    <v-list two-line class="list_cards">
                                        <v-list-item>
                                            <v-list-item-content>
                                                <v-list-item-title v-html="item.title"></v-list-item-title>
                                                <v-list-item-subtitle >
                                                    <v-chip-group>
                                                        <v-chip v-for="tag in item.tags" :key="tag">
                                                            {{tag}}
                                                        </v-chip>
                                                    </v-chip-group>
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list>
                                </td>
                                <td>
                                    <v-switch
                                            flat
                                            v-model="item.status"
                                            inset
                                            color="error"
                                            hide-details
                                    ></v-switch>
                                </td>
                                <td>{{ item.impression }}</td>
                                <td>{{ item.actions }}</td>
                                <td>{{ item.engRate }}</td>
                                <td>
                                    <v-btn small color="green accent-4 white--text">
                                        <v-icon class="body-1">keyboard_arrow_right</v-icon>
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
                Right Page
            </v-card>
        </v-flex>
    </v-layout>

</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        data: () => ({
            item: {
                title: 'My Awesome Campaign 2019',
                tags: [
                    'Pro Campaign',
                    'Barter'
                ],
                status: true,
                impression: '125k',
                actions: '2.7k',
                engRate: '2.0'
            },
        })
    }
</script>
<style scoped>
    .card_wrapper{
        width: 90%;
    }
</style>
