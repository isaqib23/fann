<template>
    <div>
        <v-card>
            <v-flex
            >
                <v-card class="elevation-4 mx-auto pa-3 transition-swing"
                >
                    <v-card-title>
                        <div class="subtitle-1 mb-2"><strong>Campaign Description</strong></div>
                    </v-card-title>

                    <v-textarea
                        label="Write your campaign description here"
                        auto-grow
                        outlined
                        rows="5"
                        row-height="15"
                    ></v-textarea>
                </v-card>
            </v-flex>
            <v-tabs
                v-model="currentTab"
                background-color="red lighten-2"
                dark
                next-icon="keyboard_arrow_right"
                prev-icon="keyboard_arrow_left"
                show-arrows
            >
                <v-tab-item v-for="n in tabsLength" :key="n">
                    <v-flex>
                        <v-card class="elevation-4  mx-auto pa-3 mt-3">
                            <v-card-title>
                                <v-btn icon @click="preTab()" class="px-0 ml-n10">
                                    <v-icon right>keyboard_arrow_left</v-icon>
                                </v-btn>
                                <div class="subtitle-1 mb-2"><strong>Touch Point # {{n}}</strong></div>
                                <v-spacer></v-spacer>
                                <v-btn icon @click="nextTab()" class="px-0 mr-n6">
                                    <v-icon right>keyboard_arrow_right</v-icon>
                                </v-btn>
                            </v-card-title>

                            <v-text-field
                                label="Create a unboxing video on youtube"
                                solo
                                dense
                                prepend-inner-icon="mdi-instagram"
                                class="custom_dropdown"
                            ></v-text-field>

                            <v-card-title>
                                <div class="subtitle-1 mb-2"><strong>Unboxing Product</strong></div>
                            </v-card-title>
                            <v-row class="mx-auto my-5">
                                <v-flex xl2 lg2 md2 sm1 xs2>
                                    <v-list-item-avatar height="45" min-width="100%" width="100%" class="ma-0 field_icon">
                                        <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg"></v-img>
                                    </v-list-item-avatar>
                                </v-flex>
                                <v-flex xl10 lg10 md10 sm11 xs10>
                                    <v-select
                                        :items="items"
                                        label="Instagram image post"
                                        solo
                                        dense
                                        append-icon="keyboard_arrow_down"
                                        class="custom_dropdown product_left_border"
                                    ></v-select>
                                </v-flex>
                            </v-row>

                            <v-layout>
                                <v-flex lg12 sm12 m12>
                                    <v-card-title>
                                        <div class="subtitle-1 mb-2"><strong>Format</strong></div>
                                    </v-card-title>
                                </v-flex>
                            </v-layout>
                            <v-layout row wrap pl-3 pr-3>
                                <v-flex lg4 sm4 m4 pr-3>
                                    <v-checkbox class="mt-0 pt-0" color="primary" label="Instagram Post"></v-checkbox>
                                </v-flex>
                                <v-flex lg8 sm8 m8 pl-3>
                                    <v-text-field
                                        solo
                                        label="Bio Link"
                                        class="custom_dropdown"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <v-layout row wrap pl-3 pr-3 mt-3>
                                <v-flex lg4 sm4 m4 pr-3>
                                    <v-checkbox class="mt-0 pt-0" color="primary" label="Instagram Story"></v-checkbox>
                                </v-flex>
                                <v-flex lg8 sm8 m8 pl-3>
                                    <v-text-field
                                        solo
                                        label="Story Link"
                                        class="custom_dropdown"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>


                            <v-card flat class="mx-auto"
                            >
                                <v-card-title>
                                    <div class="subtitle-1 mb-2"><strong>Suggested Caption</strong></div>
                                </v-card-title>

                                <v-textarea
                                    label="Write suggested caption here!"
                                    auto-grow
                                    outlined
                                    rows="5"
                                    row-height="15"
                                ></v-textarea>
                            </v-card>

                            <v-layout>
                                <v-flex lg12 sm12 m12>
                                    <v-card-title>
                                        <div class="subtitle-1 mb-2"><strong>Images</strong></div>
                                    </v-card-title>
                                    <v-card-text>
                                        Adding images can help influencer create a better Unboxing video!
                                    </v-card-text>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap pl-3 pr-3 mt-3>
                                <v-flex lg4 sm4 m4 pr-3 class="text-center">
                                    <image-input v-model="avatar">
                                        <div slot="activator">
                                            <v-avatar size="40" v-ripple v-if="!avatar" class="mb-3" tile>
                                                <v-icon class="display-1">mdi-image-filter</v-icon>
                                            </v-avatar>
                                            <v-avatar size="40" v-else class="mb-3" tile>
                                                <v-img
                                                    class="white--text align-end"
                                                    :src="avatar.imageURL" alt="avatar">
                                                </v-img>
                                            </v-avatar>
                                        </div>
                                    </image-input>
                                </v-flex>
                                <v-flex lg8 sm8 m8 pl-3>
                                    <v-btn height="38" depressed block class="text-capitalize" color="primary">Upload Images</v-btn>
                                </v-flex>
                            </v-layout>

                            <v-flex>
                                <v-card-title>
                                    <div class="subtitle-1 mb-2"><strong>Guidelines</strong></div>
                                </v-card-title>
                                <v-badge v-for="n in guideLines" :key="n" class="full_width">
                                    <template v-slot:badge v-if="n > 1">
                                        <v-icon @click="removeGuide" color="white">mdi-minus</v-icon>
                                    </template>
                                    <v-row class="mx-auto my-2">
                                        <v-flex xl1 lg1 md1 sm1 xs2>
                                            <v-list-item-icon class="mt-3 ml-2">
                                                <strong class="primary--text">{{n}}</strong>
                                            </v-list-item-icon>
                                        </v-flex>
                                        <v-flex xl11 lg11 md11 sm11 xs10>
                                            <v-text-field
                                                label="For e.g: please follow our brand"
                                                solo
                                                dense
                                                class="custom_dropdown product_left_border"
                                            ></v-text-field>
                                        </v-flex>
                                    </v-row>
                                </v-badge>
                                <v-btn small icon color="primary" @click="addGuide">
                                    <v-icon>mdi-plus-circle</v-icon>
                                </v-btn>
                            </v-flex>

                            <v-layout row wrap pl-3 pr-3 mt-5>
                                <v-flex lg6 sm6 m6 pr-3>
                                    <div class="subtitle-2 mb-2"><strong>Hashtags</strong></div>
                                    <div class="overline mb-2">Seprate with (,)</div>
                                    <v-text-field
                                        solo
                                        label="Fitness,Gym"
                                        prepend-icon="#"
                                        class="tag_field"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex lg6 sm6 m6 pl-3>
                                    <div class="subtitle-2 mb-2"><strong>Brand Mention</strong></div>
                                    <div class="overline mb-2">Seperate with (,)</div>
                                    <v-text-field
                                        solo
                                        label="Nike,Nuchey"
                                        prepend-icon="@"
                                        class="tag_field"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>

                            <v-layout>
                                <v-flex lg12 sm12 m12>
                                    <v-card-title>
                                        <div class="subtitle-1 mb-2"><strong>Payment</strong></div>
                                    </v-card-title>
                                    <v-card-text>
                                        Please specify incentives to complete this touch point!
                                    </v-card-text>
                                </v-flex>
                            </v-layout>
                            <v-layout row wrap pl-3 pr-3>
                                <v-flex lg3 sm3 m3 pr-3>
                                    <v-btn outlined class="text-capitalize" color="grey">Barter</v-btn>
                                </v-flex>
                                <v-flex lg9 sm9 m9 pl-3>
                                    <v-select
                                        :items="items"
                                        label="Same as Unboxing"
                                        solo
                                        dense
                                        append-icon="keyboard_arrow_down"
                                        class="custom_dropdown product_left_border"
                                    ></v-select>
                                </v-flex>
                            </v-layout>
                            <v-layout row wrap pl-3 pr-3 mt-3>
                                <v-flex lg3 sm3 m3 pr-3>
                                    <v-btn outlined class="text-capitalize" color="grey">Payment</v-btn>
                                </v-flex>
                                <v-flex lg9 sm9 m9 pl-3>
                                    <v-text-field
                                        solo
                                        label="$100"
                                        class="custom_dropdown"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-card>
                    </v-flex>
                </v-tab-item>
            </v-tabs>

        </v-card>

        <v-flex
        >
            <v-card class="elevation-4  mx-auto pa-3 transition-swing mt-3">
                <div class="text-center mt-4">
                    <v-btn block height="20" class="task_btn text-capitalize" @click="addTouchPoint">+ Add another contest or giveaway</v-btn>
                </div>

                <div class="text-center mt-4">
                    <v-btn block height="20" color="primary" class="task_btn text-capitalize" @click="removeTouchPooint">- Remove contest or giveaway</v-btn>
                </div>
            </v-card>
        </v-flex>

    </div>
</template>

<script>
    import ImageInput from '../../../../general/ImageInput';

    export default {
        components: {
            ImageInput: ImageInput
        },
        data: () => {
           return  {
               tabsLength: 1,
               guideLines: 1,
               currentTab: 0,
               model: 0,
               e1: 0,
               kind: '1',
               checkbox2: true,
               checkbox1: false,
               items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
               select2: '',
               select: ['Vuetify', 'Programming'],
               avatar: null,
               saving: false,
               saved: false,
               menu1: false,
               menu2: false,
               date: new Date().toISOString().substr(0, 10),
            }
        },
        methods: {
            nextTab(){
                if(this.currentTab === this.tabsLength - 1){
                    return false;
                }
                this.currentTab = this.currentTab + 1;
            },
            preTab(){
                if(this.currentTab === 0){
                    return false;
                }
                this.currentTab = this.currentTab - 1;
            },
            addTouchPoint(){
                this.tabsLength = this.tabsLength + 1;
                this.currentTab = this.currentTab + 1;
            },
            removeTouchPooint(){
                if(this.tabsLength === 1){
                    return false;
                }
                this.tabsLength = this.tabsLength - 1;
                this.currentTab = this.currentTab - 1;
            },
            addGuide(){
                this.guideLines = this.guideLines + 1;
            },
            removeGuide(){
                if(this.guideLines === 1){
                    return false;
                }
                this.guideLines = this.guideLines - 1;
            }
        }
    }
</script>

<style scoped>
    #dropzone {
        background-color: #EFF2F8;
        font-family: 'Arial', sans-serif;
        letter-spacing: 0.2px;
        color: #777;
        transition: background-color .2s linear;
        height:100px;
        margin:0 auto;
    }
    #dropzone >>>.overline{
        font-size: 8px !important;
    }
    .dropzone_content{
        background: #fff;
        border-radius:10px;
        padding:15px;
    }
    .dropzone >>>.dz-message{
        margin:0px !important;
    }
    >>>.promotions .v-btn__content {
        font-size: 12px !important;
    }
    >>>.promotions .v-btn__content .v-icon.v-icon{
        font-size: 18px !important;
    }
    >>>.fields_tabs .v-tabs-bar {
        height: 40px !important;
    }
    .v-tab {
        color:#2f2f2f !important;
        background: #dcdcdc !important;
    }
    .active_tab {
        color:#ffffff !important;
        background: #EE6F6F !important;
    }
    >>>.fields_tabs .v-slide-group__prev, >>>.fields_tabs .v-slide-group__next{
        display:none !important;
    }
    >>>.fields_tabs .v-tabs-slider-wrapper{
        display: none !important;
    }



    >>>.v-input__prepend-outer{
        background:#EE6F6F;
        padding:16px 14px;
        margin:0px !important;
        border-top-left-radius:5px;
    }
    >>>.v-input__prepend-outer .v-icon{
        color:#fff !important;
    }
    >>>.tag_field > .v-input__control > .v-input__slot{
        border-radius: 0px !important;
        margin-bottom: 0px !important;
    }
    >>>.v-text-field__details{
        display:none;
    }
    .task_btn >>>.v-btn__content{
        font-size:10px;
    }
    >>>.tag_field .v-input__prepend-outer{
        background:#EE6F6F;
        padding:8px 10px;
        margin:0px !important;
        border-top-left-radius:5px;
        border-bottom-left-radius:5px;
    }
    >>>.tag_field > .v-input__control > .v-input__slot{
        min-height: 40px !important;
        border-top-right-radius:5px;
        border-bottom-right-radius:5px;
    }
    >>>.tag_field.v-input .v-label{
        height:45px !important;
    }
    >>>.tag_field.v-text-field--outlined .v-label{
        top: 10px !important;
    }
    >>>.tag_field .v-icon.v-icon{
        margin-top: -8px !important;
    }
    >>>.custom_dropdown .v-input__control{
        min-height: 50px !important;
    }
    >>>.custom_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    >>>.custom_dropdown .v-input__prepend-inner .v-input__icon, >>>.product_field .v-input__prepend-inner .v-input__icon{
        background: #EE6F6F;
        padding: 24px;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }
    >>>.custom_dropdown .v-input__prepend-inner .v-icon.v-icon, >>>.product_field .v-input__prepend-inner .v-icon.v-icon{
        color: #ffffff !important;
    }
    >>>.custom_dropdown .v-input__prepend-inner, >>>.product_field  .v-input__prepend-inner{
        margin-top: 0px !important;
        margin-left: -14px;
        margin-right: 10px;
    }
    .field_icon{
        border-radius: 0px;
        border-top-left-radius: 5px !important;
        border-bottom-left-radius: 5px !important;
    }
    >>>.product_left_border .v-input__slot {
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .field_right_icon {
        border-radius: 0px;
        border-top-right-radius: 5px !important;
        border-bottom-right-radius: 5px !important;
    }
    >>>.product_right_border .v-input__slot {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    >>>.custom_datepickr .v-input__control{
        min-height: 35px !important;
    }
    >>>.custom_datepickr .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    >>>.custom_dropdown .v-input__control{
        min-height: 45px !important;
    }
    >>>.custom_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    >>>.vertical_divider{
        height: 25px !important;
        margin-left: 45px !important;
        border-color: black !important;
        margin-bottom: -3px !important;
    }
    >>>.custom_dropdown .v-input__slot{
        margin-bottom: 0px !important;
    }

    >>>.age_group .kind_active .v-label{
        color: #fff !important;
        caret-color: #fff !important;
    }
    >>>.age_group .v-input--radio-group__input{
        border: none;
    }
    >>>.age_group .v-radio{
        height: 40px;
        padding-left: 20px;
        padding-right: 20px;
        margin-right:0px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin: 5px;
    }
    >>>.age_group .v-input--selection-controls__input{
        display:none;
    }
    >>>.kind_active {
        background: #EE6F6F !important;
        padding: 20px !important;
    }
    >>>.kind_active:first-child {
        border-right: 1px solid #ccc;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }
    >>>.kind_active .accent--text{
        color: #fff !important;
        caret-color: #fff !important;
    }
    >>>.gender_group .kind_active .v-label, >>>.age_group .kind_active .v-label{
        color: #fff !important;
        caret-color: #fff !important;
    }
    >>>.kind_active .v-input--selection-controls__input{
        margin-right: 0px !important;
    }
    >>>.v-tabs-bar{
        display: none !important;
    }
    >>>.full_width .v-badge__badge{
        right: -8px;
        top: -4px;
    }
</style>
