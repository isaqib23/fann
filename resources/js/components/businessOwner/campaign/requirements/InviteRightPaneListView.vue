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
                        <template v-for="i in 15">
                            <v-card class="mx-auto user_card full_width mt-4 mb-4">
                                <v-list-item :key="i">
                                    <v-list-item-avatar height="80" min-width="80" width="80">
                                        <v-img src="/images/avtar.png"></v-img>
                                    </v-list-item-avatar>

                                    <v-list-item-content>
                                        <v-row class="mx-auto">
                                            <v-flex xl4 lg4 md4 sm6 xs12>
                                                <div class="float_class">
                                                    <div class="subtitle-1 mb-2"><strong>Amanda Nash</strong>
                                                        <v-rating v-model="rating" size="7" small class="d-inline-block ml-3"></v-rating>
                                                    </div>
                                                    <div class="followers">
                                                        <v-icon>mdi-instagram</v-icon>
                                                        50.5K Followers
                                                        <strong class="ml-2 font-weight-bold">$59.00</strong>
                                                    </div>
                                                </div>
                                            </v-flex>
                                            <v-flex xl4 lg4 md4 sm6 xs12>
                                                <div class="float_class">
                                                    <div class="subtitle-2 mb-2 integrityColor--text">
                                                        <strong>Eng. Rate</strong>
                                                        <strong class="ml-2">Comments</strong>
                                                        <strong class="ml-1">Likes</strong>
                                                    </div>
                                                    <div class="followers">
                                                        <p class="d-inline-block mb-0 mx-3">43%</p>
                                                        <p class="d-inline-block mb-0 ml-10 mr-6">2.2K</p>
                                                        <p class="d-inline-block mb-0 ml-2">5.5K</p>
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
                v-model="page"
                :length="6"
            ></v-pagination>
        </div>
    </v-flex>
</template>

<script>

    export default {
        components: {

        },
        data: () => {
           return  {
               rating: 3,
               page: 1,
               items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            }
        },
        methods: {
            goToProfile(){
                this.$router.push({name:'influencer-profile'});
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
