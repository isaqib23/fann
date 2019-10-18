<template>

    <v-container fluid>
        <v-layout wrap class="pa-12">
            <v-flex xs12>
                <v-row >
                    <v-col cols="12" md="6" xs="12">
                        <div class="subtitle-1 mb-2"><strong>Campaign</strong></div>
                    </v-col>
                    <v-spacer></v-spacer>
                    <v-col cols="12" md="1" xs="12" class="mr-n3">
                        <p class="mb-0 pt-2 text-uppercase font-weight-bold subtitle-2"><v-icon class="headline">mdi-filter-outline</v-icon> Filters</p>
                    </v-col>
                    <v-col cols="12" md="2" xs="12">
                        <v-select :items="items" label="From" solo class="custom_dropdown custom_dropdown" append-icon="keyboard_arrow_down"></v-select>
                    </v-col>
                </v-row>
            </v-flex>
            <v-flex xs12 md12>
                <v-card outlined tile  class="pa-12">
                    <v-row class="full_width" align="center">
                        <v-col class="d-flex" cols="3" v-for="i in 15" :key="i">
                            <v-card
                            :loading="loading"
                            class="mx-auto my-2"
                            @click="goToDetail()"
                        >
                            <v-img
                                height="250"
                                src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
                            ></v-img>

                            <v-avatar tile class="brand_logo">
                                <img
                                    src="https://cdn.vuetifyjs.com/images/cards/road.jpg"
                                    alt="John"
                                    style="border: 2px solid white"
                                >
                            </v-avatar>
                            <v-card-title class="title">
                                <v-icon class="primary--text headline mr-2">mdi-instagram</v-icon>
                                Cafe Badilico
                            </v-card-title>

                            <v-card-text class="py-0">
                                <div>Small plates, salads & sandwiches</div>
                            </v-card-text>

                            <v-card-text class="py-0 mb-5">
                                <v-chip-group active-class="deep-purple accent-4 white--text" column>
                                    <v-chip>Paid</v-chip>

                                    <v-chip>Unboxing</v-chip>

                                    <v-chip>USA</v-chip>
                                </v-chip-group>
                            </v-card-text>
                        </v-card>
                        </v-col>
                    </v-row>
                </v-card>
            </v-flex>

        </v-layout>
    </v-container>
</template>

<script>

    export default {
        data: () => ({
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            loading: false,
        }),
        methods: {
            reserve () {
                this.loading = true

                setTimeout(() => (this.loading = false), 2000)
            },
            goToDetail(){
                this.$router.push({ name: 'influencer-campaign-detail' })
            }
        },
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
    >>>.v-text-field__details {
        display: none !important;
    }
    >>>.brand_logo{
        margin-top: -24px;
        margin-left: 24px;
        border-radius: 10px;
    }
</style>
