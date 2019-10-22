<template>
    <v-navigation-drawer
        fixed app dark
        :permanent="$vuetify.breakpoint.mdAndUp"
        :mini-variant.sync="$vuetify.breakpoint.mdAndUp && mini"
        :value="mini"
        :width="260"
        color="accent"
        class="elevation-4"
    >

        <v-list class="py-0">
            <v-list-item class="secondary">
                <v-list-item-icon v-show="$vuetify.breakpoint.mdAndUp && mini">
                    <img class="brand-logo-mini" src="/images/brand-mini.png"/>
                </v-list-item-icon>

                <v-list-item-content class="py-0">
                    <v-list-item-title>
                        <img class="brand-logo" src="/images/brand.png"/>
                    </v-list-item-title>
                </v-list-item-content>
                <v-list-item-icon>
                    <v-btn small icon @click.native.stop="navToggle" class="mx-0">
                        <v-icon>chevron_left</v-icon>
                    </v-btn>
                </v-list-item-icon>
            </v-list-item>

            <v-list-item v-show="$vuetify.breakpoint.mdAndUp && mini">
                <v-list-item-icon>
                    <v-btn small icon @click.native.stop="navToggle" class="mx-0">
                        <v-icon>chevron_right</v-icon>
                    </v-btn>
                </v-list-item-icon>
            </v-list-item>
        </v-list>

        <v-list class="px-0 py-2" dense nav v-for="(group, index) in items" :key="index">
            <template v-for="item in group">
                <v-list-group
                    v-if="!!item.items"
                    :prepend-icon="item.icon"
                    no-action
                    :key="item.title"
                    active-class="nav_active"
                >
                    <template v-slot:activator>
                        <v-list-item-content>
                            <v-list-item-title>{{ item.title }}</v-list-item-title>
                        </v-list-item-content>
                    </template>

                    <v-list-item
                        v-for="subItem in item.items"
                        :key="subItem.title"
                        @click="subItem.action ? subItem.action() : false"
                        :to="subItem.to"
                        ripple
                        :exact="subItem.exact !== undefined ? subItem.exact : true"
                    >
                        <v-list-item-content class="pl-2">
                            <v-list-item-title>{{ subItem.title }}</v-list-item-title>
                        </v-list-item-content>

                        <v-list-item-icon>
                            <v-icon>{{ subItem.icon }}</v-icon>
                        </v-list-item-icon>
                    </v-list-item>
                </v-list-group>

                <v-list-item
                    v-else
                    @click.native="item.action ? item.action() : false"
                    href="javascript:void(0)"
                    :to="item.to"
                    ripple
                    :exact="item.exact !== undefined ? item.exact : true"
                    :key="item.title"
                >
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        data: () => ({
            items: [],
            name: null
        }),

        props: ['mini'],

        computed: mapGetters({
            auth: 'auth/user'
        }),

        watch: {
            authName(val) {
                if (val) {
                    this.name = val
                }
            }
        },

        mounted() {
            this.name = this.auth.name
            this.navigation()
        },

        methods: {
            navToggle() {
                this.$emit('nav-toggle')
            },

            navigation() {
                this.items = [
                    [
                        {title: 'Dashboard', icon: 'dashboard', to: {name: 'businessOwner-dashboard'}}
                    ],
                    [
                        {title: 'Create', icon: 'list_alt', to: {name: 'create-campaign-name'}, exact: false}
                    ],
                    [
                        {title: 'Manage', icon: 'mdi-receipt', to: {name: 'manage-campaigns'}, exact: false}
                    ],
                    [
                        {title: 'Manage Shopify', icon: 'list_alt', to: {name: 'shopify-app'}, exact: false}
                    ],
                    [
                        {title: 'Shipment', icon: 'local_shipping', to: {name: 'shipment'}, exact: false}
                    ],
                    [
                        {title: 'Payments', icon: 'mdi-bank', to: {name: 'payments'}, exact: false}
                    ],
                    [
                        {title: 'Message', icon: 'mdi-chat', to: {name: 'message-inbox'}, exact: false}
                    ],
                    [
                        {title: 'Settings', icon: 'settings_applications', to: {name: 'settings-business-profile'}, exact: false}
                    ],

                ]
            }
        }
    }
</script>
<style scoped>
    >>>.v-list-item--active {
        background: #53508D 0% 0% no-repeat padding-box !important;
        color: #53508D !important;
        border-left: 3px solid #EE6F6F;
    }
    >>>.v-list-item--active .v-list-item__title, >>>.v-list-item--active .v-icon.v-icon{
        color: #ffffff !important;
    }
    >>>.v-navigation-drawer__border{
        background-color: transparent !important;
    }
</style>
