<template>
    <v-flex class="ma-12">
        <div class="subtitle-1 mb-2"><strong>Search Results</strong></div>
        <v-layout row wrap>
            <v-flex xl4 lg4 md4 sm4 xs12 v-for="i in 15" :key="i" class="mt-4 mb-4">
                <v-card
                    class="mx-auto user_card"
                    max-width="400"
                    width="250"
                >
                    <v-img
                        class="white--text"
                        height="200px"
                        src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                    >
                        <v-card-title>
                            <div class="float_class">
                                <v-chip color="primary">Avg. Engagement Rate 10%</v-chip>
                            </div>
                            <div class="float_class">
                                <v-btn icon class="text-sm-right">
                                    <v-icon align-end color="white">mdi-heart</v-icon>
                                </v-btn>
                            </div>
                        </v-card-title>
                    </v-img>
                    <v-card-text>
                        <div class="float_class">
                            <div class="subtitle-1 mb-2"><strong>Amanda Nash</strong></div>
                            <v-rating v-model="rating" size="7" small></v-rating>
                        </div>
                        <div class="float_class">
                            <div class="subtitle-1 mb-2 primary--text"><strong>$59.00</strong></div>
                            <div class="followers">
                                <v-icon>mdi-instagram</v-icon>
                                50.5K Followers
                            </div>

                        </div>
                    </v-card-text>

                    <v-card-actions>
                        <v-btn color="grayLight float_class" depressed>
                            <v-icon>mdi-account-plus-outline</v-icon>
                            Invite
                        </v-btn>
                        <v-btn color="primary float_class" dark depressed right end>
                            View Profile
                        </v-btn>
                    </v-card-actions>
                </v-card>
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
            }
        },
        methods: {}
    }
</script>

<style scoped>
    >>>.v-chip{
        text-align: center;
        line-height: 12px;
        font-size: 10px;
    }
    .user_card >>>.v-card__title{
        padding: 2px 6px 8px;
    }
    .float_class:first-child{
        text-align: left !important;
        float: left !important;
    }
    .float_class{
        text-align: right !important;
        float: right !important;
        width: 50%
    }
    >>>.v-rating .v-icon{
        padding:0px;
    }
    .followers {
        font-size:11px !important;
    }
    .followers .v-icon.v-icon{
        font-size: 18px !important;
    }
    .v-card__actions .v-btn {
        font-size: 10px !important;
    }
</style>
