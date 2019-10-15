<template>
    <v-flex class="my-12 mx-auto card_wrapper">
        <div class="subtitle-2 mb-2 text-uppercase"><strong>Integrations</strong></div>
        <v-card class="pa-6">
            <v-row class="mx-auto">
                <v-flex xl12 lg12 md12 sm12 sx12 class="mr-12">
                    <v-card-text class="mb-12">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum maiores modi quidem veniam, expedita quis laboriosam, ullam facere adipisci, iusto, voluptate sapiente corrupti asperiores rem nemo numquam fuga ab at.</p>

                        <v-row>
                            <v-col cols="12" sm="12">
                                <v-tabs class="fields_tabs" active-class="active_tab">
                                    <v-tab class="all_integration text-capitalize">
                                        All Integrations
                                    </v-tab>
                                    <v-tab class="enabled_integration text-capitalize">
                                        Enabled Integrations
                                    </v-tab>
                                    <v-tab-item class="pa-8 tab_items">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum maiores modi quidem veniam, expedita quis laboriosam, ullam facere adipisci, iusto, voluptate sapiente corrupti asperiores rem nemo numquam fuga ab at.</p>
                                    </v-tab-item>
                                    <v-tab-item class="pa-8 tab_items">
                                        <v-row>
                                            <v-col cols="12" sm="4">
                                                <label class="font-weight-bold black--text text-uppercase">Category</label>
                                                <v-select
                                                    :items="items"
                                                    label="Health & fitness"
                                                    solo
                                                    append-icon="keyboard_arrow_down"
                                                    class="custom_dropdown"
                                                ></v-select>
                                            </v-col>
                                            <v-col cols="12" sm="4">
                                                <label class="font-weight-bold black--text text-uppercase">Name Includes</label>
                                                <v-text-field
                                                    label="Filter by integration Name"
                                                    solo
                                                    class="custom_dropdown"
                                                ></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-tab-item>
                                </v-tabs>
                                <v-list class="integrations_list">
                                    <v-list-item>
                                        <v-list-item-icon class="title mr-2">
                                            <v-icon color="success">mdi-shopify</v-icon>
                                        </v-list-item-icon>

                                        <v-list-item-content>
                                            <v-list-item-title class="text-uppercase">Shopify</v-list-item-title>
                                            <v-list-item-subtitle>eCommerce</v-list-item-subtitle>
                                        </v-list-item-content>

                                        <v-list-item-avatar class="primary--text" width="100">
                                            View Settings <v-icon color="primary">keyboard_arrow_right</v-icon>
                                        </v-list-item-avatar>
                                    </v-list-item>
                                </v-list>
                            </v-col>
                        </v-row>

                    </v-card-text>

                    <v-card-actions class="text-right float-right">
                        <v-btn class="caption mr-3 text-capitalize" large>Back</v-btn>
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
    >>>.fields_tabs .v-tabs-bar {
        height: 40px !important;
    }
    >>>.fields_tabs .v-slide-group__prev, >>>.fields_tabs .v-slide-group__next{
        display:none !important;
    }
    >>>.fields_tabs .v-tabs-slider-wrapper{
        display: none !important;
    }
    .v-tab {
        color:#2f2f2f !important;
        background: #dcdcdc !important;
    }
    .active_tab {
        color:#ffffff !important;
        background: #EE6F6F !important;
    }
    .tab_items {
        border: 1px solid #cccccc;
        border-top-right-radius: 5px;
        --background: #ffffff;
    }
    >>>.fields_tabs .all_integration{
        border-top-left-radius: 5px !important;
    }
    >>>.fields_tabs .enabled_integration{
        border-top-right-radius: 5px !important;
    }
    >>>.integrations_list .v-list-item__icon .v-icon.v-icon{
        font-size: 48px !important;
    }
    .integrations_list{
        border: 1px solid #ccc;
        border-bottom-right-radius: 5px;
        border-left: 6px solid #EE6F6F;
        border-top: none;
    }
    >>>.custom_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    >>>.custom_dropdown .v-input__control{
        min-height: 45px !important;
    }
</style>
