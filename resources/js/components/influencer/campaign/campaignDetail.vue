<template>

    <v-container fluid style="width: 85%">
        <v-layout wrap class="pa-12">
            <v-flex xs12>
                <v-card class="description_wrapper">
                    <v-row>
                        <v-col cols="12" md="12" xs="12">
                            <v-btn icon @click="preTab()" class="nav_control nav_left" style="">
                                <v-icon right>keyboard_arrow_left</v-icon>
                            </v-btn>
                            <v-card width="85%" class="mx-auto py-3">
                                <v-list three-line>
                                    <v-list-item>
                                        <v-list-item-avatar class="brand_logo" tile height="120" width="120" min-width="120">
                                            <v-img src="https://cdn.vuetifyjs.com/images/cards/cooking.png"></v-img>
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-list-item-title>
                                                <v-list-item-avatar class="brand_logo2 mr-2 ml-0 my-1" tile height="30" width="30" min-width="30">
                                                    <v-img src="https://cdn.vuetifyjs.com/images/cards/cooking.png"></v-img>
                                                </v-list-item-avatar>
                                                <span class="subtitle-1 text-uppercase">Cafe Badilico</span>
                                            </v-list-item-title>
                                            <v-list-item-subtitle class="py-0 my-0">
                                                <p class=" mb-0 mr-5 d-inline-block subtitle-1 black--text font-weight-bold">The Freshest Seasonal Flowers</p>
                                                <v-chip class="mr-2">Paid</v-chip>
                                                <v-chip class="mr-2">Unboxing</v-chip>
                                                <v-chip>USA</v-chip>
                                            </v-list-item-subtitle>
                                            <v-list-item-subtitle>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </v-card>
                            <v-btn icon @click="nextTab()" class="nav_control nav_right">
                                <v-icon right>keyboard_arrow_right</v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-card>
            </v-flex>
            <v-flex xs12 md12>
                <v-card tile>
                    <v-card width="80%" flat class="mx-auto py-3">
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Content Guidelines</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12 class="ma-auto white">
                                <v-list class="guide_list">
                                    <v-list-item
                                        v-for="item in list_items"
                                        :key="item.title"
                                        @click=""
                                        height="35"
                                        min-height="35"
                                    >
                                        <v-list-item-icon class="ma-0">
                                            <strong class="primary--text">{{item.number}}.</strong>
                                        </v-list-item-icon>
                                        <v-list-item-content class="mt-n3 py-0">
                                            <v-list-item-subtitle>
                                                {{item.title}}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </v-flex>
                        </v-layout>
                    </v-card>
                </v-card>
            </v-flex>
            <v-flex xs12 md12>
                <v-card tile class="hr_divider">
                    <v-card width="80%" flat class="mx-auto py-3">
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Hashtags</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <v-btn class="ma-3 text-capitalize" color="grey lighten-2" depressed height="42">#Hashtag 1</v-btn>
                                <v-btn class="ma-3 text-capitalize" color="grey lighten-2" depressed height="42">#Hashtag 2</v-btn>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Brand Mentions</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <v-btn class="ma-3 text-lowercase" color="grey lighten-2" depressed height="42">@Mentions 1</v-btn>
                                <v-btn class="ma-3 text-lowercase" color="grey lighten-2" depressed height="42">@Mentions 2</v-btn>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Follow</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <v-btn class="ma-3 text-lowercase" color="grey lighten-2" depressed height="42">@Telefloral</v-btn>
                                <v-btn class="ma-3 text-lowercase" color="grey lighten-2" depressed height="42">@Telefloralofficial</v-btn>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>No. Of friends Tagged</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <v-btn class="ma-3 text-lowercase" color="grey lighten-2" depressed height="42">5</v-btn>
                            </v-flex>
                        </v-layout>
                    </v-card>
                </v-card>
            </v-flex>
            <v-flex xs12 md12>
                <v-card tile class="hr_divider">
                    <v-card width="80%" flat class="mx-auto py-3">
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Images:</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <v-row :class="$vuetify.breakpoint.smAndUp ? '' : 'fix_width mx-auto'">
                                    <v-col
                                        v-for="n in 6"
                                        :key="n"
                                        class="xl3 lg3 md3 sm4 xs12"
                                    >
                                        <v-card flat tile class="d-flex">
                                            <v-img
                                                :src="`https://picsum.photos/500/300?image=${n * 5 + 10}`"
                                                :lazy-src="`https://picsum.photos/10/6?image=${n * 5 + 10}`"
                                                aspect-ratio="1"
                                                class="grey lighten-2"
                                            >
                                                <template v-slot:placeholder>
                                                    <v-row
                                                        class="fill-height ma-0"
                                                        align="center"
                                                        justify="center"
                                                    >
                                                        <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                                                    </v-row>
                                                </template>
                                            </v-img>
                                        </v-card>
                                    </v-col>
                                </v-row>
                            </v-flex>
                        </v-layout>
                    </v-card>
                </v-card>
            </v-flex>
            <v-flex xs12 md12>
                <v-card tile class="hr_divider">
                    <v-card width="80%" flat class="mx-auto py-3">
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>Start Date</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <p class="mb-0 mt-4">12-October-2019</p>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex lg4 sm4 m4 xs12>
                                <v-card-title class="text-center">
                                    <div class="subtitle-1 mb-2"><strong>End Date</strong></div>
                                </v-card-title>
                            </v-flex>
                            <v-flex lg8 sm8 m8 xs12>
                                <p class="mb-0 mt-4">12-October-2019</p>
                            </v-flex>
                        </v-layout>
                    </v-card>
                </v-card>
            </v-flex>
            <v-flex xs12 md12>
                <v-card tile class="py-3">
                    <v-card-actions class="pr-12">
                        <v-spacer></v-spacer>
                        <v-btn class="text-capitalize" color="grey lighten-2" depressed height="42">Back</v-btn>
                        <v-btn class="text-capitalize" color="primary" depressed height="42">Apply for this Campaign</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>

    export default {
        data: () => ({
            tabs: 3,
            tab : null,
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            list_items: [
                { number: 1, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
                { number: 2, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
                { number: 3, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'}
            ],
        }),
        methods: {
            reserve () {
                this.loading = true

                setTimeout(() => (this.loading = false), 2000)
            },
        },
    }
</script>

<style scoped>
    .description_wrapper{
        background:linear-gradient(90deg, #ee6f6e 0%,#fea57e 100% );
        padding: 50px 90px;
    }
    >>>.brand_logo{
        margin-left: -65px;
        border-radius: 10px;
    }
    >>>.brand_logo2{
        border-radius: 5px;
    }
    >>>.guide_list .v-list-item{
        min-height: 35px !important;
    }
    .hr_divider {
        border-top: 1px solid #cccccc;
    }
    >>>.nav_control .v-icon{
        font-size: 48px;
        color: #fff;
    }
    >>>.nav_right{
        position: absolute;
        bottom: 140px;
        right:110px
    }
    >>>.nav_left{
        position: absolute;
        bottom: 140px;
        left:40px
    }
</style>
