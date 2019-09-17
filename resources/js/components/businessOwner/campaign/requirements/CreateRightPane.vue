<template>
    <v-flex class="ma-12">
        <div class="subtitle-1 mb-2"><strong>Search Results</strong></div>
        <v-card class="card_wrapper">
            <v-img
                src="/images/banner.png"
                height="200"
                class="grey darken-4"
            ></v-img>



            <v-flex class="description_wrapper">
                <v-card class="description_card ma-auto" width="550" height="200">
                    <v-layout class="left-pane">
                        <div class="card_box"></div>
                    </v-layout>
                    <v-layout class="right-pane" style="background:#ccc">

                    </v-layout>
                </v-card>
            </v-flex>


            <v-flex class="common_wrapper ma-auto mt-5">
                <v-card class="description_card ma-auto" flat>
                    <v-layout class="left-pane">
                        <v-card-text>
                            <div class="subtitle-1 mb-2"><strong>Campaign Requirements</strong></div>
                        </v-card-text>
                    </v-layout>
                    <v-layout class="right-pane ma-auto">
                        <div class="parent_box ma-3">
                            <v-badge overlap>
                                <template v-slot:badge>0</template>
                            </v-badge>
                            <div class="child_box pa-5">
                                Instagram Post
                            </div>
                        </div>

                        <div class="parent_box ma-3">
                            <v-badge overlap>
                                <template v-slot:badge>0</template>
                            </v-badge>
                            <div class="child_box pa-5">
                                Instagram Story
                            </div>
                        </div>
                    </v-layout>
                </v-card>
            </v-flex>


            <v-flex class="common_wrapper ma-auto">
                <v-card class="description_card ma-auto" flat>
                    <v-layout class="left-pane">
                        <v-card-text>
                            <div class="subtitle-1 mb-2"><strong>Hashtags</strong></div>
                        </v-card-text>
                    </v-layout>
                    <v-layout class="right-pane ma-auto">
                        <v-btn class="ma-3" small>#Hashtag 1</v-btn>
                        <v-btn class="ma-3" small>#Hashtag 1</v-btn>
                    </v-layout>
                </v-card>
            </v-flex>

            <v-flex class="common_wrapper ma-auto">
                <v-card class="description_card ma-auto" flat>
                    <v-layout class="left-pane">
                        <v-card-text>
                            <div class="subtitle-1 mb-2"><strong>Brand Mentions</strong></div>
                        </v-card-text>
                    </v-layout>
                    <v-layout class="right-pane ma-auto">
                        <v-btn class="ma-3" small>@Mentions 1</v-btn>
                        <v-btn class="ma-3" small>@Mentions 2</v-btn>
                    </v-layout>
                </v-card>
            </v-flex>

            <v-divider></v-divider>

            <v-flex class="common_wrapper ma-auto" color="black">
                <v-card class="description_card ma-auto" flat>
                    <v-layout class="left-pane">
                        <v-card-text>
                            <div class="subtitle-1 mb-2"><strong>Content Guidelines</strong></div>
                        </v-card-text>
                    </v-layout>
                    <v-layout class="right-pane ma-auto inline_display">
                        <v-list>
                            <v-list-item
                                v-for="item in list_items"
                                :key="item.title"
                                @click=""
                            >
                                <v-list-item-icon class="mr-0">
                                    <strong class="primary--text">{{item.number}}.</strong>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-subtitle>

                                        {{item.title}}
                                    </v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-layout>
                </v-card>
            </v-flex>

            <v-divider></v-divider>

            <v-flex class="common_wrapper ma-auto" color="black" style="min-height: 270px;">
                <v-card class="description_card ma-auto" flat>
                    <v-layout class="left-pane">
                        <v-card-text>
                            <div class="subtitle-1 mb-2"><strong>Due Date</strong></div>
                            <v-date-picker :weekday-format="getDay" v-model="picker" width="180" height="180" color="primary"></v-date-picker>
                        </v-card-text>
                    </v-layout>
                    <v-layout class="right-pane ma-auto inline_display">
                        <v-card-text>
                            <div class="subtitle-1 mb-2"><strong>Pricing</strong></div>
                            <v-simple-table>
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>DELIVERABLES</td>
                                        <td>QUANTITY</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Instagram Post Image</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Instagram Post Image</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Instagram Post Image</td>
                                    <td>1</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Collabration Budget</td>
                                        <td>$20.00</td>
                                    </tr>
                                </tfoot>
                            </v-simple-table>
                        </v-card-text>
                    </v-layout>
                </v-card>
            </v-flex>
        </v-card>
    </v-flex>
</template>

<script>
    const daysOfWeek = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];
    export default {
        components: {

        },
        data: () => {
           return  {
               list_items: [
                   { number: 1, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
                   { number: 2, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
                   { number: 3, title: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'}
               ],
               picker: new Date().toISOString().substr(0, 10),
            }
        },
        methods: {
            getDay(date){
                let i = new Date(date).getDay(date)
                return daysOfWeek[i]
            }
        }
    }
</script>

<style scoped>
    .card_wrapper {
        border-radius: 10px !important;
    }
    .description_wrapper{
        background:linear-gradient(90deg, #ee6f6e 0%,#fea57e 100% );
        padding: 50px 90px;
    }
    .left-pane {
        width: 25% !important;
        position: relative;
    }
    .right-pane {
        width: 75% !important;
    }
    .common_wrapper .left-pane {
        width: 40% !important;
    }
    .common_wrapper .right-pane {
        width: 60% !important;
        background:none !important;
    }
    .card_box {
        height: 120px;
        width: 120px;
        background: yellow;
        margin-left: -25px;
        border-radius: 10px;
        top: 50%;
        position: absolute;
        vertical-align: middle;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    .common_wrapper {
        width:65% !important;
        clear: both !important;
    }
    .parent_box {
        background: red;
        width: 120px;
        height: 120px;
        border-radius: 10px;
        background:#FFA67D;
    }
    .child_box {
        background: red;
        width: 120px;
        height: 120px;
        border-radius: 10px;
        background:linear-gradient(90deg, #ee6f6e 0%,#fea57e 100% );
        margin-top:10px;
        margin-left:10px;
        color: #fff;
    }

    .parent_box:last-child {
        background: red;
        width: 120px;
        height: 180px;
        border-radius: 10px;
        background:#FFA67D;
    }
    .parent_box:last-child .child_box {
        background: red;
        width: 120px;
        height: 180px;
        border-radius: 10px;
        background:linear-gradient(90deg, #ee6f6e 0%,#fea57e 100% );
        margin-top:10px;
        margin-left:10px;
        color: #fff;
    }
    .parent_box .v-badge{
        position: absolute !important;
    }
    .inline_display{
        display: inline-block !important;
    }
    .inline_display .v-list-item__subtitle{
        word-wrap: break-word !important;
        white-space: initial !important;
    }
    >>>.v-date-picker-header .v-btn--fab{
        height: 30px !important;
        width: 30px !important;
        border: 1px solid #ccc;
        border-radius: 10px;
    }
    >>>.v-picker__title{
        display: none !important;
    }
    >>>.v-date-picker-header{
       padding: 4px !important;
    }
    >>>.v-date-picker-header__value button{
        font-size:9px;
        font-weight:bold;
        color: #EE6F6F !important;
    }
    >>>.v-date-picker-table th{
        font-size: 9px !important;
        padding:0px !important;
        margin:0px !important;
    }
    >>>.v-date-picker-table thead{
        background: #cccccc;
    }
    >>>.v-date-picker-table--date .v-btn{
        height: 25px;
        width: 25px;
        font-size: 10px !important;
        border: 1px solid #cccccc;
        border-radius: 0px;
    }
    >>>.v-picker__body{
       height: 210px !important;
    }
    .right-pane .v-data-table thead, .right-pane .v-data-table tfoot{
        background: #cccccc !important;
    }
    .right-pane .v-data-table td{
        font-size: 10px !important;
    }
    >>>.right-pane .v-data-table tfoot tr:first-child{
        font-size: 24px !important;
        font-weight: bolder;
    }
</style>
