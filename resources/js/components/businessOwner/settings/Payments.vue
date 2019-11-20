<template>
    <v-flex class="my-12 mx-auto card_wrapper">
        <div class="subtitle-2 mb-2 text-uppercase"><strong>Billing & Payment</strong></div>
        <v-card class="pa-6">
            <v-row class="mx-auto">
                <v-flex xl12 lg12 md12 sm12 sx12 class="mr-12">
                    <v-card-title>
                        <div class="title mb-2"><strong>Your Current Balance:</strong> <span class="ml-5 font-weight-light">$645.00</span></div>
                    </v-card-title>
                    <v-card-text class="mb-10">
                        <div class="subtitle-1 mb-2 darkSecondary--text"><strong>Add more Funds</strong></div>

                        <v-row justify="start">
                            <v-col cols="12" sm="6" md="8">
                                <v-btn v-for="(payment, index) in payments"
                                   :key="index"
                                   class="mr-1"
                                   color="darkSecondary"
                                   outlined
                                   @click="showDialog('funds',payment)"
                                >
                                    ${{ payment }}
                                </v-btn>

                            </v-col>
                        </v-row>

                        <v-row justify="start">
                            <v-col cols="12" sm="6" md="8">
                                <v-card class="mx-auto table_card">
                                    <v-card-title class="subtitle-1 font-weight-black" color="gray">
                                        Billing Method
                                        <v-spacer></v-spacer>
                                        <v-btn v-if="this.user.stripe_customer_id === null" color="primary" class="caption text-capitalize" @click="showDialog('method')">Add Method</v-btn>

                                    </v-card-title>
                                    <v-card-text>
                                        <v-simple-table>
                                                <tbody>
                                                <tr v-for="(card, index) in cards" :key="card.id">
                                                    <td class="ma-0 pa-0">
                                                        <p class="font-weight-bold d-block mb-n5 pl-5 text-uppercase" v-if="index == 0">Primary</p>
                                                        <v-list class="ma-0 pa-0">
                                                            <v-list-item>
                                                                <v-list-item-icon class="title mr-2">
                                                                    <v-icon color="black">credit_card</v-icon>
                                                                </v-list-item-icon>

                                                                <v-list-item-content>
                                                                    <v-list-item-title class="caption">{{card.brand}} ending in {{card.exp_year}}</v-list-item-title>
                                                                </v-list-item-content>

                                                                <v-list-item-avatar>
                                                                    CAD {{card.last4}}
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
                        <p>* A 2% processing fee will be accessed on all payments</p>
                    </v-card-text>

                    <v-card-actions class="text-right float-right">
                        <v-btn class="caption mr-3 text-capitalize" large>Back</v-btn>
                        <v-btn color="primary" class="caption text-capitalize" large>Submit</v-btn>
                    </v-card-actions>
                </v-flex>
            </v-row>
        </v-card>
        <stripePopup
            :methodDialog="methodDialog"
            @updateMethodDialog="getUserCards"
        />
        <confirmDialog
            :fundDialog="fundDialog"
            :msg="msg"
            :payment="payment"
            @updateFundDialog="addFundsToAccount"
        />

    </v-flex>

</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    import stripePopup from '../popups/stripePopup'
    import confirmDialog from '../../general/confirmDialog'

    export default {
        components: {
            stripePopup:stripePopup,
            confirmDialog:confirmDialog,
        },
        data: () => ({
            rules: [
                value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
            ],
            payments: ['50', '100', '500', '1000', '5000'],
            user: {
                name: null,
                email: null,
            },
            methodDialog : false,
            fundDialog : false,
            msg: "Are you sure want to Add Funds to your account?",
            payment: null
        }),

        computed: mapGetters({
            auth: 'auth/user',
            cards: 'settings/cards',
        }),
        methods: {
            ...mapActions({
                addFunds: 'settings/addFunds',
                getCards: 'settings/getCards',
                fetchUser: 'auth/fetchUser'
            }),
            showDialog(val,payment) {
                if(val == 'funds'){
                    if(this.user.stripe_customer_id === null){
                        return this.$toast.error('You need to add Payment Method before add funds to your account!')
                    }
                    this.payment = payment;
                    return this.fundDialog = true;
                }
                this.methodDialog = true;
            },
            async addFundsToAccount(response){
                if(response.status){
                    await this.addFunds(response.payment);
                    this.$toast.success('$ '+response.payment+' added to your funds Successfully!');
                }
                this.fundDialog = false;
            },
            async getUserCards(response){
                if(response.status){
                    await this.getCards();
                    await this.fetchUser();
                    this.user = Object.assign(this.user, this.auth);
                    this.methodDialog = false;
                    console.log(this.user);
                }
                this.methodDialog = false;
            }
        },
        mounted() {
            this.getCards();
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
