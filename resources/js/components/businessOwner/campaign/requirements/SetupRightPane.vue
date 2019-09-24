<template>
    <v-flex class="ma-12">
        <v-card class="mx-auto full_width text-center pa-12">
            <v-card-title>
                <div class="headline mb-2 ma-auto">
                    GLOBAL REAL ESTATE PROMOTION CAMPAIGN
                </div>
            </v-card-title>
            <v-card-text class="px-2 mt-10">
                <v-row class="mx-auto full_width">

                    <v-flex lg6 sm6 pr-4>
                        <v-row class="mx-auto full_width">
                            <v-flex lg3 sm6 md3 xl3 xs12 class="left_side">
                                <div>Paid</div>
                                <div><v-icon class="display-1 type_icon_border" color="primary">mdi-currency-usd</v-icon></div>
                            </v-flex>
                            <v-flex lg9 sm6 md9 xl9 xs12 class="right_side">
                                Lorem Ipsum is simply dummy text of the printing and typesetting
                            </v-flex>
                        </v-row>
                    </v-flex>

                    <v-flex lg6 sm6 pl-4>
                        <v-row class="mx-auto full_width">
                            <v-flex lg3 sm6 md3 xl3 xs12 class="left_side">
                                <div>Paid</div>
                                <div><v-icon class="display-1 placement_icon_border" color="primary">mdi-instagram</v-icon></div>
                            </v-flex>
                            <v-flex lg9 sm6 md9 xl9 xs12 class="right_side">
                                Lorem Ipsum is simply dummy text of the printing and typesetting
                            </v-flex>
                        </v-row>
                    </v-flex>
                </v-row>
                <div class="scale_container mt-10">
                    <div class="subtitle-1 mb-2 text-start"><strong>Campaign Scale</strong></div>
                    <v-row class="mx-auto full_width">

                        <v-flex lg6 sm6 pr-4>
                            <v-card class="mx-auto full_width text-center" outlined>
                                <div class="float_class full_width">
                                    <v-icon align-end color="white">mdi-check-circle</v-icon>
                                </div>
                                <v-card-title>
                                    <p class="icon_border ma-auto"><v-icon class="display-3" color="primary">mdi-text-subject</v-icon></p>
                                </v-card-title>
                                <v-system-bar color="primary" height="40">
                                    <p class="mb-1 ma-auto subtitle-1 white--text">PLATINUM CAMPAIGN</p>
                                </v-system-bar>
                                <v-card-text class="px-10">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <v-list class="card_lists">
                                        <v-list-item
                                            v-for="item in list_items"
                                            :key="item.title"
                                            @click=""
                                        >
                                            <v-list-item-icon class="mr-0">
                                                <v-icon align-end size="10" color="primary">mdi-circle</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content>
                                                <v-list-item-subtitle>

                                                    {{item.title}}
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list>
                                </v-card-text>
                            </v-card>
                        </v-flex>

                        <v-flex lg6 sm6 pl-4>
                            <v-card class="mx-auto full_width text-center" outlined>
                                <v-card-title>
                                    <div class="float_class full_width">
                                        <v-icon align-end color="white">mdi-check-circle</v-icon>
                                    </div>
                                    <p class="icon_border ma-auto"><v-icon class="display-3" color="accent">mdi-gate</v-icon></p>
                                </v-card-title>
                                <v-system-bar color="accent" height="40">
                                    <p class="mb-1 ma-auto subtitle-1 white--text">SILVER CAMPAIGN</p>
                                </v-system-bar>
                                <v-card-text class="px-10">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <v-list class="card_lists">
                                        <v-list-item
                                            v-for="item in list_items"
                                            :key="item.title"
                                            @click=""
                                        >
                                            <v-list-item-icon class="mr-0">
                                                <v-icon align-end size="10" color="accent">mdi-circle</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content>
                                                <v-list-item-subtitle>

                                                    {{item.title}}
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list>
                                </v-card-text>
                            </v-card>
                            <v-btn color="primary" large class="mt-8 float-right">
                                Next
                                <v-icon right>keyboard_arrow_right</v-icon>
                            </v-btn>
                        </v-flex>
                    </v-row>
                </div>
            </v-card-text>
        </v-card>
    </v-flex>
</template>

<script>

    export default {
        components: {

        },
        data: () => {
           return  {
               list_items: [
                   { number: '.', title: 'Lorem Ipsum is simply dummy'},
                   { number: 2, title: 'Lorem Ipsum is simply dummy'},
                   { number: 2, title: 'Lorem Ipsum is simply dummy'},
                   { number: 2, title: 'Lorem Ipsum is simply dummy'},
                   { number: 3, title: 'Lorem Ipsum is simply dummy'}
               ],
            }
        },
        methods: {

        }
    }
</script>

<style scoped>
    .left_side {
        background: #EFEDFD;
        padding:18px
    }
    .right_side {
        background: #F6F5FE;
        padding:18px
    }
    .type_icon_border{
        border:2px solid #EE6F6F;
        border-radius: 50%;
        line-height: 100% !important;
    }
    .placement_icon_border{
        border-radius: 50%;
        line-height: 100% !important;
    }
    .float_class{
        text-align: right !important;
        float: right !important;
        position: absolute;
        right:1px;
        top:1px;
    }
    >>>.card_lists .v-list-item{
        height: 30px !important;
        min-height: auto !important;
    }
    >>>.card_lists .v-list-item__icon{
        margin: 9px 0;
    }
</style>
