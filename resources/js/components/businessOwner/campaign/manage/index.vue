<template>
    <v-row class="mx-auto main_wrapper">
        <v-flex class="panes-container full_height lg12 sm12 xl12 md12 xs12">
            <v-card fluid grid-list-md :class="cardClass">
                <v-tabs v-model="active_tab" flat icons-and-text background-color="decent" color="gutter"
                        :vertical="$vuetify.breakpoint.mdAndUp ? true : false"
                        :centered="$vuetify.breakpoint.mdAndUp ? false : true"
                        :active-class="$vuetify.breakpoint.mdAndUp ? 'active_tab' : 'active_tab_sm'"
                >
                    <LeftTabs></LeftTabs>

                    <v-tab-item>
                        <CampaignListing></CampaignListing>
                    </v-tab-item>
                    <v-tab-item>
                         <Placement></Placement>
                     </v-tab-item>
                    <v-tab-item>
                         <Influencer></Influencer>
                     </v-tab-item>
                </v-tabs>
            </v-card>
        </v-flex>
    </v-row>
</template>

<script>
    import LeftTabs from './LeftTabs';
    import Listing from './Listing';
    import Placement from './Placement';
    import Influencer from './Influencer';

    export default {
        components: {
            LeftTabs: LeftTabs,
            CampaignListing: Listing,
            Placement:Placement,
            Influencer:Influencer
        },
        data: () => {
            return  {
                active_tab: 0
            }
        },
        methods: {},
        computed: {
            cardClass: function() {
                return (this.active_tab == 3) ? 'full_width' : 'full_width';
            }
        }
    }
</script>

<style scoped>
    .main_wrapper{
        background: #F4F7FD !important;
    }
    >>>.theme--light.v-tabs-items{
        background: #F4F7FD !important;
    }
</style>
