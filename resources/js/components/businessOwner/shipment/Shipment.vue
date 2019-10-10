<template>
    <div>
        <v-flex :class="$vuetify.breakpoint.smAndUp ? 'ma-12' : 'ma-1'">
            <v-row justify="space-between">
                <v-col cols="12" md="6" xs="12">
                    <v-btn color="primary" class="mr-n1 btn_right_border" dark large>Pending</v-btn>
                    <v-btn color="white"class="mr-n1 btn_right_border btn_left_border" large>In Transit</v-btn>
                    <v-btn color="white btn_left_border" large>Delivered</v-btn>
                    <v-btn color="primary" class="btn_right_border" large dark
                           :class="$vuetify.breakpoint.smAndUp ? 'mr-n1 mr-n1' : 'mt-2'"
                    >Paid</v-btn>
                    <v-btn color="white btn_left_border" large
                           :class="$vuetify.breakpoint.smAndUp ? '' : 'mt-2'"
                    >Barter</v-btn>
                </v-col>
                <v-col cols="12" md="5" xs="12" class="pa-0">
                    <v-row class="search_fields">
                        <v-col cols="12" md="6">
                            <v-text-field
                                solo
                                label="Search by influencer Name"
                                prepend-inner-icon="search"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field
                                solo
                                label="Search by Campaign Name"
                                prepend-inner-icon="search"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12" md="12">
                    <v-card class="mx-auto pa-8">
                        <v-card-title>
                            <div class="subtitle-1 mb-2 text-uppercase"><strong>Campaign promotion on Brand</strong>
                                <v-icon>open_in_new</v-icon>
                            </div>
                        </v-card-title>
                        <v-card class="mx-auto table_card">
                            <v-card-title class="title font-weight-black">
                                <v-icon color="primary" class="mr-2">mdi-instagram</v-icon>
                                Instagram
                            </v-card-title>
                            <v-card-text>
                                <v-simple-table class="shipping_table" v-for="j in 2" :key="j">
                                    <thead class="gutter">
                                        <tr>
                                            <th class="table_col_width subtitle-2 black--text">Influencer Name: Jhon Snow</th>
                                            <th class="table_col_width subtitle-2 black--text text-center">Product</th>
                                            <th class="table_col_width subtitle-2 black--text text-center">Date Dispatch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="i in 4" :key="i">
                                        <td >
                                            <v-list two-line class="list_cards my-0 py-0">
                                                <v-list-item>
                                                    <v-list-item-avatar height="40" width="40" class="mr-2 my-0">
                                                        <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg"></v-img>
                                                    </v-list-item-avatar>
                                                    <v-list-item-content>
                                                        <v-list-item-title>
                                                            Brunch this weekend? <v-icon>open_in_new</v-icon>
                                                        </v-list-item-title>
                                                    </v-list-item-content>
                                                </v-list-item>
                                            </v-list>
                                        </td>
                                        <td class="text-center">
                                            <p>Brunch this weekend? <v-icon>open_in_new</v-icon></p>
                                        </td>
                                        <td class="text-center">10/12/2019</td>
                                    </tr>
                                    </tbody>
                                </v-simple-table>
                            </v-card-text>
                        </v-card>
                        <v-card class="mx-auto table_card mt-10">
                            <v-card-title class="title font-weight-black">
                                <v-icon color="primary" class="mr-2">mdi-youtube</v-icon>
                                Youtube
                            </v-card-title>
                            <v-card-text>
                                <v-simple-table class="shipping_table" v-for="j in 2" :key="j">
                                    <thead class="gutter">
                                    <tr>
                                        <th class="table_col_width subtitle-2 black--text">Influencer Name: Jhon Snow</th>
                                        <th class="table_col_width subtitle-2 black--text text-center">Product</th>
                                        <th class="table_col_width subtitle-2 black--text text-center">Date Dispatch</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="i in 4" :key="i">
                                        <td >
                                            <v-list two-line class="list_cards my-0 py-0">
                                                <v-list-item>
                                                    <v-list-item-avatar height="40" width="40" class="mr-2 my-0">
                                                        <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg"></v-img>
                                                    </v-list-item-avatar>
                                                    <v-list-item-content>
                                                        <v-list-item-title>
                                                            Brunch this weekend? <v-icon>open_in_new</v-icon>
                                                        </v-list-item-title>
                                                    </v-list-item-content>
                                                </v-list-item>
                                            </v-list>
                                        </td>
                                        <td class="text-center">
                                            <p>Brunch this weekend? <v-icon>open_in_new</v-icon></p>
                                        </td>
                                        <td class="text-center">10/12/2019</td>
                                    </tr>
                                    </tbody>
                                </v-simple-table>
                            </v-card-text>
                        </v-card>
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
</style>
