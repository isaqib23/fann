<template>
    <v-flex class="my-12 mx-auto card_wrapper">
        <div class="subtitle-2 mb-2 text-uppercase"><strong>Billing & Payment</strong></div>
        <v-card class="pa-6">
            <v-row class="mx-auto">
                <v-flex xl12 lg12 md12 sm12 sx12 class="mr-12">
                    <v-card-title>
                        <div class="title mb-2"><strong>Your Current Balance:</strong> <span class="ml-5">$645.00</span></div>
                    </v-card-title>
                    <v-card-text class="mb-10">
                        <div class="subtitle-1 mb-2 darkSecondary--text"><strong>Add more Funds</strong></div>

                        <v-row justify="start">
                            <v-col cols="12" sm="6" md="8">
                                <v-btn class="mr-1" color="darkSecondary" outlined>$50</v-btn>
                                <v-btn class="mx-1" color="darkSecondary" outlined>$100</v-btn>
                                <v-btn class="mx-1" color="darkSecondary" outlined>$500</v-btn>
                                <v-btn class="mx-1" color="darkSecondary" outlined>$1000</v-btn>
                                <v-btn class="mx-1" color="darkSecondary" outlined>$5000</v-btn>
                            </v-col>
                        </v-row>

                        <v-row justify="start">
                            <v-col cols="12" sm="6" md="8">
                                <v-card class="mx-auto table_card">
                                    <v-card-title class="subtitle-1 font-weight-black" color="gray">
                                        Billing Method
                                        <v-spacer></v-spacer>
                                        <v-btn color="primary" class="caption text-capitalize">Add Method</v-btn>
                                    </v-card-title>
                                    <v-card-text>
                                        <v-simple-table>
                                                <tbody>
                                                <tr v-for="i in 3" :key="i">
                                                    <td class="ma-0 pa-0">
                                                        <p class="font-weight-bold d-block mb-n5 pl-5 text-uppercase">Primary</p>
                                                        <v-list class="ma-0 pa-0">
                                                            <v-list-item>
                                                                <v-list-item-icon class="title mr-2">
                                                                    <v-icon color="black">credit_card</v-icon>
                                                                </v-list-item-icon>

                                                                <v-list-item-content>
                                                                    <v-list-item-title class="caption">Visa ending in 2019</v-list-item-title>
                                                                </v-list-item-content>

                                                                <v-list-item-avatar>
                                                                    CAD <v-icon>more_horiz</v-icon>
                                                                </v-list-item-avatar>
                                                            </v-list-item>
                                                        </v-list>
                                                    </td>
                                                </tr>
                                                </tbody>
                                        </v-simple-table>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                        </v-row>
                        <p>A 2% processing fee will be accessed on all payments</p>
                    </v-card-text>

                    <v-card-actions class="text-right float-right">
                        <v-btn class="caption mr-3 text-capitalize" large>Button</v-btn>
                        <v-btn color="primary" class="caption text-capitalize" large>Submit</v-btn>
                    </v-card-actions>
                </v-flex>
            </v-row>
        </v-card>
    </v-flex>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        data: () => ({
            rules: [
                value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
            ],
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            user: {
                name: null,
                email: null,
            }
        }),

        computed: mapGetters({
            auth: 'auth/user'
        }),

        mounted() {
            this.user = Object.assign(this.user, this.auth)
        }
    }
</script>
<style scoped>
    .card_wrapper{
        width: 90%;
    }
    >>>.table_card .v-card__title{
        background: #dcdcdc !important;
    }
    >>>.table_card .v-list-item__icon .v-icon.v-icon{
        font-size: 48px !important;
    }
</style>
