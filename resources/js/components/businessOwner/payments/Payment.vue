<template>
    <div>
        <v-flex :class="$vuetify.breakpoint.smAndUp ? 'ma-12' : 'pa-2'">
            <v-row justify="start">
                <v-col cols="12" md="6" class="py-0">
                    <v-row class="search_fields">
                        <v-col cols="12" md="6" :class="$vuetify.breakpoint.mdAndUp ? '' : 'pa-0'">
                            <v-text-field
                                outlined
                                label="Search by date"
                                prepend-inner-icon="search"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" md="2" class="pr-0" :class="$vuetify.breakpoint.mdAndUp ? '' : 'pa-0'">
                            <v-select
                                :items="items"
                                label="To"
                                solo
                                append-icon="keyboard_arrow_down"
                            >
                            </v-select>
                        </v-col>
                        <v-col cols="12" md="1" class="px-0 text-center hidden-sm-and-down">
                            <v-icon class="pt-3" color="dark">mdi-minus</v-icon>
                        </v-col>
                        <v-col cols="12" md="3" class="pl-0" :class="$vuetify.breakpoint.mdAndUp ? '' : 'pa-0'">
                            <v-select
                                :items="items"
                                label="From"
                                solo
                                append-icon="keyboard_arrow_down"
                            >
                            </v-select>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12" md="12">
                    <v-card class="mx-auto pa-8">
                        <v-card-title>
                            <v-row justify="space-between">
                                <v-col cols="12" md="6">
                                    <div class="subtitle-2 mb-2 text-uppercase"><strong>Payment Overview</strong></div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="subtitle-2 mb-2 text-uppercase text-right"><strong>Your Remaining Budget:<span class="success--text">$99.00</span></strong></div>
                                </v-col>
                            </v-row>
                        </v-card-title>
                        <v-simple-table class="shipping_table">
                            <thead class="gutter">
                            <tr>
                                <th class="bg-grey table_col_width subtitle-2 black--text text-uppercase text-center" style="width: 8%">Date</th>
                                <th class="bg-grey table_col_width subtitle-2 black--text text-uppercase text-center" style="width: 10%">Influencer</th>
                                <th class="bg-grey table_col_width subtitle-2 black--text text-uppercase text-center" style="width: 25%">Campaign</th>
                                <th class="bg-grey table_col_width subtitle-2 black--text text-uppercase text-center" style="width: 20%">Touch Point</th>
                                <th class="bg-grey table_col_width subtitle-2 black--text text-uppercase text-center" style="width: 5%">Amount</th>
                                <th class="bg-grey table_col_width subtitle-2 black--text text-uppercase text-center" style="width: 5%">Status</th>
                                <th class="bg-grey table_col_width subtitle-2 black--text text-uppercase text-center" style="width: 27%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="i in 8" :key="i">
                                <td >
                                    <v-checkbox v-model="checkbox" label="10/03/2019"></v-checkbox>
                                </td>
                                <td class="text-center">Laura Miller</td>
                                <td class="text-center">Promotion Global Real Estate</td>
                                <td class="text-center">Touch Point Number {{i}}</td>
                                <td class="text-center">${{75*i}}</td>
                                <td class="text-center"><v-icon class="overline" color="warning">mdi-circle</v-icon>Draft</td>
                                <td class="text-center">
                                    <v-btn color="primary" class="overline" small>
                                        Open Dispute
                                    </v-btn>
                                    <v-btn color="success" class="overline" small>
                                        Pay Influencer
                                    </v-btn>
                                </td>
                            </tr>
                            </tbody>
                        </v-simple-table>
                        <p class="my-5 text-center primary--text">Load more</p>
                    </v-card>
                </v-col>
            </v-row>
        </v-flex>
    </div>
</template>

<script>

    export default {
        components: {

        },
        data: () => {
           return  {
               items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
               checkbox:false
            }
        },
        methods: {}
    }
</script>

<style scoped>
    .btn_right_border{
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    .btn_left_border{
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    >>>.search_fields .v-text-field__details {
        display: none;
    }
    .table_col_width {
        width: 33.33%;
        font-weight: bold;
    }
    >>>.list_cards .v-avatar {
        border-radius: 10px !important;
    }
    >>>.bg-grey{
        background: #EEEEEE !important;
    }
</style>
