<template>
    <div>
        <v-flex class="ma-12">
            <div class="subtitle-1 mb-2"><strong>Different Popups</strong></div>
            <v-card class="mx-auto card_wrapper">
                <v-card-text>

                    <v-dialog v-model="proposal" max-width="70%" transition="slide-y-reverse-transition">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary text-capitalize" class="my-3" v-on="on">
                                Proposal Popup
                            </v-btn>
                        </template>
                        <Proposal></Proposal>
                    </v-dialog>

                    <v-dialog v-model="TouchPoint" max-width="50%" transition="slide-y-reverse-transition">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary text-capitalize" class="my-3" v-on="on">
                                Touch Point (Product Promotion)
                            </v-btn>
                        </template>
                        <TouchPoint></TouchPoint>
                    </v-dialog>

                    <v-dialog v-model="Giveaway" max-width="50%" transition="slide-y-reverse-transition">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary text-capitalize" class="my-3" v-on="on">
                                Touch Point (Give Away)
                            </v-btn>
                        </template>
                        <Giveaway></Giveaway>
                    </v-dialog>

                    <v-dialog v-model="SubmitReview" max-width="50%" transition="slide-y-reverse-transition">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary text-capitalize" class="my-3" v-on="on">
                                Touch Point (Submit for Review)
                            </v-btn>
                        </template>
                        <SubmitReview></SubmitReview>
                    </v-dialog>

                    <v-dialog v-model="SubmitReview2" max-width="50%" transition="slide-y-reverse-transition">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary text-capitalize" class="my-3" v-on="on">
                                Touch Point (Submit for Review2)
                            </v-btn>
                        </template>
                        <SubmitReview2></SubmitReview2>
                    </v-dialog>

                    <v-dialog v-model="SubmitReview3" max-width="50%" transition="slide-y-reverse-transition">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary text-capitalize" class="my-3" v-on="on">
                                Touch Point (Submit for Review3)
                            </v-btn>
                        </template>
                        <SubmitReview3></SubmitReview3>
                    </v-dialog>

                    <v-dialog v-model="SubmitReview4" max-width="50%" transition="slide-y-reverse-transition">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary text-capitalize" class="my-3" v-on="on">
                                Touch Point (Submit for Review4)
                            </v-btn>
                        </template>
                        <SubmitReview4></SubmitReview4>
                    </v-dialog>

                </v-card-text>
            </v-card>

        </v-flex>
    </div>
</template>

<script>
import Proposal from '../popups/Proposal'
import TouchPoint from '../popups/TouchPoint'
import Giveaway from '../popups/Giveaway'
import SubmitReview from '../popups/SubmitReview'
import SubmitReview2 from '../popups/SubmitReview2'
import SubmitReview3 from '../popups/SubmitReview3'
import SubmitReview4 from '../popups/SubmitReview4'

    export default {
        components: {
            Proposal:Proposal,
            TouchPoint:TouchPoint,
            Giveaway:Giveaway,
            SubmitReview:SubmitReview,
            SubmitReview2:SubmitReview2,
            SubmitReview3:SubmitReview3,
            SubmitReview4:SubmitReview4
        },
        data: () => {
           return  {
               rating: 3,
               items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
               show: true,
               proposal: false,
               touchPoint: false,
               giveAway: false,
               submitReview: false,
               submitReview2: false,
               submitReview3: false,
               submitReview4: false
            }
        },
        methods: {}
    }
</script>

<style scoped>

</style>
