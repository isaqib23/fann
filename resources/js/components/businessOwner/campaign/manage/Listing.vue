<template>
    <v-layout wrap class="ma-3 pa-2">
        <v-flex xs12 fluid>
                <v-btn color="primary" large class="d-inline-block float-left caption"
                   :class="$vuetify.breakpoint.smAndUp ? 'mx-2' : 'my-2'"
                >
                    Create Campaign
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
        <v-flex xs12 md7 class="pa-2">
            <v-card class="pa-2" outlined tile >
                <v-card-text>
                    <v-simple-table fixed-header height="auto">
                            <thead>
                            <tr class="font-weight-bold title text-uppercase">
                                <th class="text-left black--text">
                                    <v-checkbox value="true"></v-checkbox>
                                </th>
                                <th class="text-left black--text">Campaign</th>
                                <th class="text-left black--text">status</th>
                                <th class="text-left black--text">impressions</th>
                                <th class="text-left black--text">actions</th>
                                <th class="text-left black--text">eng.rate</th>
                                <th class="text-left black--text"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="i in 8" :key="i">
                                <td><v-checkbox value="true"></v-checkbox></td>
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
                                <td>
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
        <v-flex xs12 md5 class="pa-2">
            <v-card class="pa-2" outlined tile>

                <v-flex xs12>
                        <v-icon small class="ml-7 pa-2">edit</v-icon>
                        <v-icon small class="ml-1 pa-2">mdi-content-duplicate</v-icon>
                        <v-icon small class="ml-1 pa-2">mdi-trash-can</v-icon>
                </v-flex>
                <v-divider></v-divider>

                <v-flex xs12 class="ma-2 pa-2">
                    <v-card-title>
                        <div class="subtitle-1 text-uppercase darken-1" ><strong>Promoting Global Real Estate License</strong></div>
                    </v-card-title>
                    <v-card-text class="pa-0">
                        <div class="d-inline-block ml-4" >
                            <span class="primary--text">Unboxing</span>
                            <span class="ml-7">
                                Campaign Type: <span class="primary--text">Barter</span>
                            </span>
                            <span class="ml-7">
                                Status:
                                <v-switch
                                        class="float-right pa-0 mx-2 mb-0 mt-1 switch_class"
                                        flat
                                        v-model="item.status"
                                        inset
                                        color="error"
                                        hide-details
                                ></v-switch>
                            </span>
                        </div>
                    </v-card-text>
                </v-flex>
                <v-divider></v-divider>

                <v-flex xs12 class="ma-2 pa-2">
                    <v-card-text class="pa-0">
                        <div class="ma-2 pa-2" >
                         <div>Objective: <span class="primary--text ml-4"> Brand Awareness</span></div>
                         <div class="mt-2 pt-2">Deliverables: <span class="primary--text ml-4"> 13</span> / 20</div>
                         <div class="mt-2 pt-2">Influencers: <span class="ml-4"> 09/20</span></div>

                        </div>
                    </v-card-text>
                </v-flex>
                <v-divider></v-divider>

                <v-row>

                   <v-col cols="12" xl="4" lg="4" md="4" sm="4" xs="6">
                       <v-card color="#EDF2F9" max-height="120" max-width="120" class="my-2 pa-2 mx-auto">
                           <v-card-text class="black--text">
                               <div class="subtitle-2 mb-2 text-uppercase text-center">Impressions</div>
                               <span class="headline pa-2">125K</span>
                           </v-card-text>
                       </v-card>
                   </v-col>
                    <v-col cols="12" xl="4" lg="4" md="4" sm="4" xs="6">
                       <v-card color="#EDF2F9" max-height="120" max-width="120" class="my-2 pa-2 mx-auto">
                           <v-card-text class="black--text">
                               <div class="subtitle-2 mb-2 text-uppercase text-center">Actions</div>
                               <span class="headline pa-2">2.7K</span>
                           </v-card-text>
                       </v-card>
                    </v-col>
                    <v-col cols="12" xl="4" lg="4" md="4" sm="4" xs="6">
                       <v-card color="#EDF2F9" max-height="120" max-width="120" class="my-2 pa-2 mx-auto">
                           <v-card-text class="black--text">
                               <div class="subtitle-2 mb-2 text-uppercase text-center">Eng. rate</div>
                               <span class="headline pa-2">2.0%</span>
                           </v-card-text>
                       </v-card>
                   </v-col>

                   <v-spacer></v-spacer>

                </v-row>

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
            },
        })
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
