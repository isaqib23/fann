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

                <v-flex xs12>
                        <v-icon small class="ml-7 pa-2">edit</v-icon>
                        <v-icon small class="ml-1 pa-2">mdi-content-duplicate</v-icon>
                        <v-icon small class="ml-1 pa-2">mdi-trash-can</v-icon>
                </v-flex>
                <v-divider></v-divider>

                <v-flex xs12 class="ma-2 pa-2">
                    <v-card-title>
                        <div class="subtitle-1 text-uppercase black--text" ><strong>Promoting Global Real Estate License</strong></div>
                    </v-card-title>
                    <v-card-text class="pa-0">
                        <div class="d-inline-block ml-4" >
                            <span class="primary--text">Unboxing</span>
                            <span class="ml-2">
                                Campaign Type: <span class="primary--text">Barter</span>
                            </span>
                            <span class="ml-2">
                                Status:
                                <v-switch
                                        class="float-right pa-0 mx-2 my-0"
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

                <v-flex xs12 class="ma-2 pa-2">

                   <v-row>
                       <v-col cols="6" md="4">
                           <v-card color="#EDF2F9" max-height="120" max-width="120" class="pa-2"  outlined tile>
                               .col-6 .col-md-4
                           </v-card>
                       </v-col>
                       <v-col cols="6" md="4">
                           <v-card color="#EDF2F9" max-height="120" max-width="120" class="pa-2"  outlined tile>
                               .col-6 .col-md-4
                           </v-card>
                       </v-col>
                       <v-col cols="6" md="4">
                           <v-card color="#EDF2F9" max-height="120" max-width="120" class="pa-2"  outlined tile>
                               .col-6 .col-md-4
                           </v-card>
                       </v-col>

                   </v-row>

                        <v-card color="#EDF2F9" max-height="120" max-width="120" class="ma-2 pa-2">
                            <v-card-text class="black--text">
                                <div class="subtitle-2 mb-2 text-uppercase text-center">Impressions</div>
                                <span class="headline pa-2">125K</span>
                            </v-card-text>
                        </v-card>
                    <v-card color="#EDF2F9" max-height="120" max-width="120" class="ma-2 pa-2">
                        <v-card-text class="black--text">
                            <div class="subtitle-2 mb-2 text-uppercase text-center">Impressions</div>
                            <span class="headline pa-2">125K</span>
                        </v-card-text>
                    </v-card>
                    <v-col> </v-col>
                    <v-col>
                        <v-card color="#EDF2F9">
                            <v-card-text class="black--text">
                                <div class="subtitle-2 mb-2 text-uppercase">Impressions</div>
                                125K
                            </v-card-text>
                        </v-card>
                    </v-col>

                </v-flex>

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
</style>
