<template>
    <v-layout wrap class="ma-3 pa-2">
        <v-flex xs12 fluid>
                <v-btn color="primary" large class="d-inline-block float-left caption text-capitalize"
                       @click="goToInfluencer()"
                   :class="$vuetify.breakpoint.smAndUp ? 'mx-2' : 'my-2'"
                >
                    Go To Placement
                </v-btn>
                <v-text-field
                        class="float-left custom_field"
                        solo
                        depressed
                        label="Search / Add Filters"
                        prepend-inner-icon="search"
                ></v-text-field>
        </v-flex>
        <!-- Top Content -->
        <v-flex xs12 md12 class="pa-2">
            <v-card class="pa-2" outlined tile >
                <v-card-text>
                    <v-simple-table fixed-header height="auto">
                            <thead>
                            <tr class="font-weight-bold title text-uppercase">
                                <th class="text-left black--text px-1">
                                    <v-checkbox value="true" color="primary"></v-checkbox>
                                </th>
                                <th class="text-left black--text">Campaign</th>
                                <th class="text-left black--text">status</th>
                                <th class="text-left black--text">impressions</th>
                                <th class="text-left black--text">actions</th>
                                <th class="text-left black--text">eng.rate</th>
                                <th class="text-left black--text">Placements</th>
                                <th class="text-left black--text"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="i in 8" :key="i">
                                <td class="px-1"><v-checkbox value="true" color="primary"></v-checkbox></td>
                                <td>
                                    <v-list two-line class="list_cards pa-0 mx-0 hover_class" dense>
                                        <v-list-item class="px-0">
                                            <v-list-item-content>
                                                <v-list-item-title v-html="item.title"></v-list-item-title>
                                                <v-list-item-subtitle >
                                                    <v-chip-group>
                                                        <v-chip v-for="tag in item.tags"
                                                                :key="tag"
                                                                class="px-2"
                                                                color="#E5E5E5"
                                                                text-color="#71737D"
                                                                label
                                                        >
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
                                            class="switch_class"
                                    ></v-switch>
                                </td>
                                <td class="subtitle-1">{{ item.impression }}</td>
                                <td class="subtitle-1">{{ item.actions }}</td>
                                <td class="subtitle-1">{{ item.engRate }}%</td>
                                <td class="subtitle-1">
                                    <v-btn color="accent" small height="45" class="mr-2">
                                        <v-icon>mdi-instagram</v-icon>
                                    </v-btn>
                                    <v-btn color="white" small height="45">
                                        <v-icon color="primary">mdi-youtube</v-icon>
                                    </v-btn>
                                </td>
                                <td class="px-1">
                                    <v-btn small color="green accent-4 white--text" min-width="20" class="px-1">
                                        <v-icon class="body-1">keyboard_arrow_right</v-icon>
                                    </v-btn>
                                </td>
                            </tr>
                            </tbody>
                    </v-simple-table>

                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>

</template>

<script>

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
            }
        }),
        methods: {
            goToInfluencer(){
                this.$router.push({ name: 'influencer-manage-influencers' })
            }
        }
    }
</script>
<style scoped>
    .card_wrapper{
        width: 90%;
    }
    >>>.switch_class .v-input--switch__track{
        height: 17px !important;
        width: 34px !important;
    }
    >>>.switch_class .v-input--switch__thumb{
        width: 10px !important;
        height: 10px !important;
        top: 1px !important;
    }
    >>>.switch_class .v-input--selection-controls__ripple {
        width: 0px !important;
        height: 0px !important;
    }

    >>>.custom_field .v-input__control{
        min-height: 43px !important;
    }
    >>>tr:hover .hover_class{
        background: #EEEEEE !important;
    }
</style>
