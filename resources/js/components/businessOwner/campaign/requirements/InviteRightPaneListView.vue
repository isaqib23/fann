<template>
    <v-flex :class="$vuetify.breakpoint.smAndUp ? 'ma-12' : 'mx-1 mt-5'">
        <div class="subtitle-1 mb-2"><strong>Search Results</strong></div>
        <v-row justify="space-between" class="top_row">
            <v-col md="4">
                <v-select
                    :items="items"
                    label="Product Title here"
                    class="product_field"
                    solo
                    background-color="white"
                    append-icon="keyboard_arrow_down"
                ></v-select>
            </v-col>
            <v-col md="4">
                <v-text-field
                    solo
                    label="Search Here"
                    prepend-inner-icon="search"
                    class="touch_field"
                ></v-text-field>
            </v-col>
        </v-row>
        <v-layout row wrap>
            <v-flex xl12 lg12 md12 sm12 xs12>
                    <v-list two-line color="transparent" class="list_cards">

                        <template
                            v-for="(searchItem, searchIndex) in fetchResults()">
                            <v-card class="mx-auto user_card full_width mt-4 mb-4">
                                <v-list-item :key="searchIndex">
                                    <v-list-item-avatar height="80" min-width="80" width="80">
                                        <v-img :src="searchItem.provider_photo"></v-img>
                                    </v-list-item-avatar>

                                    <v-list-item-content>
                                        <v-row class="mx-auto">
                                            <v-flex xl4 lg4 md4 sm6 xs12>
                                                <div class="float_class">
                                                    <div class="subtitle-1 mb-2"><strong>{{searchItem.provider_name}}</strong>
                                                        <v-rating v-model="rating" size="7" small class="d-inline-block ml-3"></v-rating>
                                                    </div>
                                                    <div class="followers">
                                                        <v-icon>mdi-instagram</v-icon>
                                                        {{searchItem.follower_count}} Followers
                                                        <strong class="ml-2 font-weight-bold">$59.00</strong>
                                                    </div>
                                                </div>
                                            </v-flex>
                                            <v-flex xl4 lg4 md4 sm6 xs12>
                                                <div class="float_class">
                                                    <div class="subtitle-2 mb-2 integrityColor--text">
                                                        <strong>Eng. Rate</strong>
                                                        <strong class="ml-2">Comments</strong>
                                                        <strong class="ml-1">Likes</strong>c
                                                    </div>
                                                    <div class="followers">
                                                        <p class="d-inline-block mb-0 mx-3">{{searchItem.eng_rate}}%</p>
                                                        <p class="d-inline-block mb-0 ml-10 mr-6">{{searchItem.comment_count}}</p>
                                                        <p class="d-inline-block mb-0 ml-2">{{searchItem.like_count}}</p>
                                                    </div>
                                                </div>
                                            </v-flex>
                                            <v-flex xl4 lg4 md4 sm6 xs12 class="text-center">
                                                <v-btn color="primary pl-3 pr-3" class="text-capitalize" depressed @click="goToProfile">
                                                    View Profile
                                                </v-btn>
                                                <v-btn color="success pl-3 pr-3" depressed class="text-capitalize">
                                                    Invite
                                                </v-btn>
                                            </v-flex>
                                        </v-row>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-card>
                        </template>
                    </v-list>
            </v-flex>
        </v-layout>
        <div class="text-right">
            <v-pagination
                v-model="inviteSearchParams.page"
                :length="totalPages()"
                :total-visible="totalVisible"
            ></v-pagination>
        </div>
    </v-flex>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    export default {
        components: {

        },
        data: () => {
           return  {
               rating: 3,
               totalVisible: 10,
               items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
               resultsFound: false
            }
        },
        methods: {
            ...mapActions({
                inviteSearch : 'campaign/inviteSearch'
            }),
            goToProfile() {
                this.$router.push({name:'influencer-profile'});
            },
            totalPages () {
                return !_.isNil(this.influencerSearchResults) ? this.influencerSearchResults.total  : 0
            },
            fetchResults() {

                let result = [];

                if (_.has(this.influencerSearchResults, 'data') &&  !_.isEmpty(this.influencerSearchResults.data)) {
                    result = this.influencerSearchResults.data;
                }

                return result;
            }
        },
        computed: {
            ...mapGetters({
                influencerSearchResults: 'campaign/influencerSearchResults',
                inviteSearchParams: 'campaign/inviteSearchParams',
            })
        },
        watch : {
            'inviteSearchParams.page' : {
                handler: function(val) {
                    this.inviteSearch (
                        this.inviteSearchParams
                    );
                }
            }
        }
    }
</script>

<style scoped>
    >>>.v-rating .v-icon{
        padding:0px;
    }
    >>>.list_cards .v-avatar{
        border-radius: 0px !important;
    }

    .followers {
        font-size:13px !important;
    }
    .followers .v-icon.v-icon{
        font-size: 18px !important;
    }
    >>>.list_cards .v-btn__content {
        font-size: 12px !important;
    }
    >>>.list_cards .v-btn__content .v-icon.v-icon{
        font-size: 18px !important;
    }
    >>>.top_row .v-text-field__details{
        display: none !important;
    }
</style>
