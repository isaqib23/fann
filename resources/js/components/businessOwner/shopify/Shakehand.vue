<template>
    <div>
        <v-form
            ref="form"
            v-model="valid"
            @submit="validate"
        >
            <v-card>
                <v-card-title class="mb-8">Link your shopify stores</v-card-title>
                <v-card-text>
                    <v-layout wrap>
                        <v-flex xs4 sm4>
                            <v-subheader>Your shopify domain</v-subheader>
                        </v-flex>
                        <v-flex xs7 sm6>
                            <v-text-field
                                v-model="shop"
                                outlined
                                placeholder="acme.myshopify.com"
                                label="Your shop name"
                                required
                                :rules="shopRules"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs1 sm2 class="pl-2 mt-1">
                            <v-btn color="primary" large @click="validate" :disabled="!valid">Link Shop</v-btn>
                        </v-flex>
                    </v-layout>
                    <hr/>
                    <v-layout row wrap>
                        <v-flex xs12 sm12>
                            <v-card-title class="mb-3">
                                <span>Linked Stores</span>
                                <v-spacer></v-spacer>
                                <v-btn color="success" outlined small icon @click="getLinkedShops">
                                    <v-icon>refresh</v-icon>
                                </v-btn>
                            </v-card-title>
                            <v-card-text>
                                <div v-if="shops.length == 0 && !busy">No Shops Linked.</div>
                                <v-list nav class="primary--text" two-line>
                                    <v-list-item
                                        class="v-item--active v-list-item--active v-list-item--link theme--light"
                                        v-for="(crntShop, i) in shops" :key="i">
                                        <v-list-item-avatar>
                                            <v-icon color="green">shop</v-icon>
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-list-item-title>
                                                <a :href="'https://'+crntShop.domain" target="_blank">
                                                    {{'https://'+crntShop.domain}}
                                                </a>
                                            </v-list-item-title>
                                            <v-list-item-subtitle>{{ crntShop.name }}</v-list-item-subtitle>
                                        </v-list-item-content>
                                        <v-list-item-action>
                                            <deleteable :target="crntShop" :name="'Shop'" @delete="deleteShop">
                                                <v-btn icon color="error">
                                                    <v-icon>delete_outline</v-icon>
                                                </v-btn>
                                            </deleteable>
                                        </v-list-item-action>
                                    </v-list-item>
                                </v-list>
                            </v-card-text>
                        </v-flex>
                    </v-layout>
                </v-card-text>
            </v-card>
        </v-form>
    </div>
</template>

<script>

    import axios from 'axios'
    import {api} from '~/config'
    import deleteable from "../shared/deleteable"

    export default {
        data: () => ({
            busy: false,
            valid: false,
            shop: null,
            shops: [],
            shopRules: [
                v => !!v || 'Shop name is required'
            ]
        }),
        methods: {
            validate: function () {
                let self = this;
                if (this.$refs.form.validate()) {
                    axios
                        .get(api.path('shopify', {'shop': this.shop}))
                        .then(function (resp) {
                            if (!resp.data.status) {
                                self.$toast.error(resp.data.message)
                                return false;
                            }
                            window.open(resp.data.url, 'window', 'toolbar=no, menubar=no, resizable=yes, width=700, height=720');
                        });
                }
            },
            getLinkedShops: function () {
                let self = this;
                self.busy = true;
                axios
                    .get(api.path('linkedShops'))
                    .then(function (resp) {
                        self.shops = resp.data;
                        self.busy = false;
                    });
            },
            deleteShop: function (shop) {
                let self = this;
                self.busy = true;
                axios
                    .patch(api.path('shopifyCleanUninstall'), shop)
                    .then(function (resp) {
                        if (resp.data.status == true) {
                            self.shops.splice(self.shops.indexOf(shop), 1);
                            self.busy = false;
                        }
                    });
            },
            addFocusEvent: function () {
                let self = this;
                if ('shopFocusBound' in window == false) {
                    window.addEventListener("focus", function (event) {
                        window['shopFocusBound'] = true;
                        self.getLinkedShops();
                    }, false);
                }
            }
        },

        mounted() {
            this.getLinkedShops();
            //this.addFocusEvent();
        },
        components: {
            deleteable
        }
    }
</script>
