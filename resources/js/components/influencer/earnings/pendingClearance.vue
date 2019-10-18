<template>
    <v-layout wrap class="ma-3 pa-2">
        <v-flex xs12 class="pa-2">
            <v-subheader class="pa-0 headline black--text">Earnings</v-subheader>
        </v-flex>
        <!-- Top Content -->
        <v-flex xs12 md12>
            <v-row class="full_width" align="center">
                <v-col class="d-flex" cols="3" v-for="i in 4" :key="i">
                    <v-card class="mx-auto py-3" max-width="100%" min-width="100%">
                        <v-card-text class="text-center">
                            <div>Net Income</div>
                            <p class="headline text--primary mb-0">
                                $312
                            </p>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-flex>
        <v-flex xs12 md12>
            <v-row justify="start">
                <v-col cols="12" md="1" xs="12" class="mr-n3">
                    <p class="mb-0 pt-2 text-uppercase font-weight-bold subtitle-2 grey--text">Withdraw</p>
                </v-col>
                <v-col cols="12" md="6" xs="12">
                    <v-btn depressed height="40" color="white" class="mr-3">
                        <v-icon color="info" class="mr-2">mdi-paypal</v-icon>
                        Paypal Account
                    </v-btn>
                    <v-btn depressed height="40" color="white">
                        <v-icon color="error" class="mr-2">mdi-checkbox-blank</v-icon>
                        Bank Transfer
                    </v-btn>
                </v-col>
            </v-row>
            <v-row justify="start">
                <v-col cols="12" md="1" xs="12" class="mr-n3">
                    <p class="mb-0 pt-2 text-uppercase font-weight-bold subtitle-2 grey--text">Show</p>
                </v-col>
                <v-col cols="12" md="11" xs="12">
                    <v-select :items="items" label="EVERYTHINGS" solo class="mr-3 d-inline-block custom_dropdown" append-icon="keyboard_arrow_down"></v-select>
                    <v-select :items="items" label="2019" solo class="mr-3 max-width-25 d-inline-block custom_dropdown" append-icon="keyboard_arrow_down"></v-select>
                    <v-select :items="items" label="ALL MONTHS" solo class="d-inline-block custom_dropdown" append-icon="keyboard_arrow_down"></v-select>
                </v-col>
            </v-row>
        </v-flex>

        <v-flex xs12 md12>
            <v-row justify="start">
                <v-col cols="12" md="6" xs="12" class="mr-n3 my-0 py-0">
                    <v-btn color="primary" class="btn_right_border" dark depressed large height="45">Pending Clearance</v-btn>
                    <v-btn class="btn_left_border ml-n1" large solo depressed height="45" @click="goToApproval">Pending Approvals</v-btn>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="12" md="2" xs="12" class="my-0 py-0">
                    <v-btn color="blue" class="text-capitalize float-right" text large height="45">Export to CSV</v-btn>
                </v-col>
            </v-row>
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                    <tr>
                        <th class="text-left text-uppercase">Date</th>
                        <th class="text-left text-uppercase">Campaigns</th>
                        <th class="text-left text-uppercase">Touch Points</th>
                        <th class="text-left text-uppercase">Status</th>
                        <th class="text-center text-uppercase">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in desserts" :key="item.name">
                        <td>{{ item.date }}</td>
                        <td>{{ item.campaign }}</td>
                        <td>{{ item.touch_point }}</td>
                        <td>
                            <v-btn outlined small height="20" class="custom_btn mr-2" depressed>clearing</v-btn>
                            {{ item.status }}
                        </td>
                        <td class="text-center green--text">{{ item.amount }}</td>
                    </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-flex>

    </v-layout>

</template>

<script>

    export default {
        data: () => ({
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            desserts: [
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
                { date: 'Oct 17, 19', campaign: 'My Awesomw Party Campaign', touch_point: "Orange Delight Scrub promotion TRI", status: "Funds Pending Clearance (view order)", amount: "$8"},
            ]
        }),
        methods: {
            goToApproval(){
                this.$router.push({ name: 'influencer-earnings-approval' })
            }
        }
    }
</script>
<style scoped>
    >>>.custom_dropdown .v-input__control{
        min-height: 45px !important;
    }
    >>>.custom_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    >>>.max-width-25 {
        max-width: 10%;
    }
    .btn_right_border{
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    .btn_left_border{
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
        background: #ffffff !important;
    }
    >>>.custom_btn{
        background: rgb(211,235,253);
        background: -moz-linear-gradient(90deg, rgba(211,235,253,1) 60%, rgba(255,255,255,1) 60%);
        background: -webkit-linear-gradient(90deg, rgba(211,235,253,1) 60%, rgba(255,255,255,1) 60%);
        background: linear-gradient(90deg, rgba(211,235,253,1) 60%, rgba(255,255,255,1) 60%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#d3ebfd",endColorstr="#ffffff",GradientType=1);
    }
</style>
