<template>
    <div>
        <v-card>
            <v-flex>
                <v-card class="elevation-4 mx-auto pa-3 transition-swing">
                    <v-card-title>
                        <div class="subtitle-1 mb-2"><strong>Campaign Description</strong></div>
                    </v-card-title>

                    <v-textarea
                        v-model="campaignDescription"
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

                            <touch-point-title-field
                                v-if="campaignTouchPointFields.touchPointTitle"
                                :touchPoint="touchPoint"
                                :paymentMethod="paymentMethod"
                            ></touch-point-title-field>

                            <v-card-title>
                                <div class="subtitle-1 mb-2 text-capitalize"><strong>{{ campaignObjective.slug.replace('-',' ') }}</strong></div>
                            </v-card-title>

                            <v-row class="mx-auto my-5">
                                <touch-point-brand-field
                                    v-if="campaignTouchPointFields.touchPointBrand"
                                    :touchPoint="touchPoint"
                                    :paymentMethod="paymentMethod"
                                ></touch-point-brand-field>

                                <products-search
                                    v-if="campaignTouchPointFields.touchPointProduct"
                                    :emit-as="'dispatchProduct'"
                                    @selected-product="selectedProduct"
                                ></products-search>
                            </v-row>

                            <touch-point-post-format-field
                                v-if="campaignTouchPointFields.touchPointInstagramFormat"
                                :touchPoint="touchPoint"
                                :paymentMethod="paymentMethod"
                            ></touch-point-post-format-field>

                            <v-card flat class="mx-auto">
                                <v-card-title>
                                    <div class="subtitle-1 mb-2"><strong>Suggested Caption</strong></div>
                                </v-card-title>
                                <v-textarea
                                    v-model="touchPoint.caption"
                                    label="Write suggested caption here!"
                                    auto-grow
                                    outlined
                                    rows="5"
                                    row-height="15"
                                ></v-textarea>
                            </v-card>

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
                                                v-model="touchPoint.guideLines[n]"
                                                :count="n"
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
                                    <MultiImageInput v-model="touchPoint.images">
                                        <div slot="activator">
                                            <v-avatar size="40" v-ripple v-if="!touchPoint.images" class="mb-3" tile>
                                                <v-icon class="display-1">mdi-image-filter</v-icon>
                                            </v-avatar>
                                            <v-avatar size="40" v-else class="mb-3" tile>
                                                <v-img
                                                    class="white--text align-end"
                                                    :src="touchPoint.images.imageURL" alt="avatar">
                                                </v-img>
                                            </v-avatar>
                                        </div>
                                    </MultiImageInput>
                                </v-flex>
                                <v-flex lg8 sm8 m8 pl-3>
                                    <v-btn height="38" depressed block class="text-capitalize" color="primary">Upload Images</v-btn>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap pl-3 pr-3 mt-5>
                                <v-flex lg6 sm6 m6 pr-3>
                                    <div class="subtitle-2 mb-2"><strong>Hashtags</strong></div>
                                    <div class="overline mb-2">Seprate with (,)</div>
                                    <v-text-field
                                        v-model="touchPoint.hashtags"
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
                                        v-model="touchPoint.mentions"
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
                            <v-layout row wrap pl-3 pr-3 v-if="!disabledBarter">
                                <v-flex lg3 sm3 m3 pr-3>
                                    <v-btn outlined class="text-capitalize" color="grey">Barter</v-btn>
                                </v-flex>
                                <v-flex lg9 sm9 m9 pl-3>
                                    <products-search
                                        :emit-as="'barterProduct'"
                                        :placeholder="'Same as Unboxing'"
                                        @selected-product="selectedProduct"
                                    >
                                    </products-search>

                                </v-flex>
                            </v-layout>
                            <v-layout row wrap pl-3 pr-3 mt-3 v-if="!disabledPaid">
                                <v-flex lg3 sm3 m3 pr-3>
                                    <v-btn outlined class="text-capitalize" color="grey">Payment</v-btn>
                                </v-flex>
                                <v-flex lg9 sm9 m9 pl-3>
                                    <v-text-field
                                        v-model="touchPoint.amount"
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

        <v-flex>
            <v-card class="elevation-4  mx-auto pa-3 transition-swing mt-3">
                <div class="text-center mt-4">
                    <v-btn block height="20" class="task_btn text-capitalize" @click="addTouchPoint">+ Add another contest or giveaway</v-btn>
                </div>
                <div class="text-center mt-4">
                    <v-btn block height="20" color="primary" class="task_btn text-capitalize" @click="removeTouchPoint">- Remove contest or giveaway</v-btn>
                </div>
            </v-card>
        </v-flex>

    </div>
</template>

<script>
    import MultiImageInput from '../../../general/MultiImageInput';
    import TouchPointTitleField from './objectiveSelection/TouchPointTitleField';
    import TouchPointPostFormatField from './objectiveSelection/TouchPointPostFormatField';
    import TouchPointBrandField from './objectiveSelection/TouchPointBrandField';
    import shopifyProductsPredictiveSearch from "./objectiveSelection/shopifyProductsPredictiveSearch";
    import {mapGetters, mapActions, mapMutations} from 'vuex';

    export default {
        components: {
            MultiImageInput: MultiImageInput,
            productsSearch : shopifyProductsPredictiveSearch,
            TouchPointTitleField : TouchPointTitleField,
            TouchPointPostFormatField : TouchPointPostFormatField,
            TouchPointBrandField : TouchPointBrandField
        },
        props : {
            //touchPoint : {}
        },
        data ()  {
            return  {
                touchPoint : {
                    caption              : null,
                    hashtags             : null,
                    mentions             : null,
                    guideLines           : [],
                    dispatchProduct      : {},
                    barterProduct        : {},
                    amount               : 0,
                    campaignDescription  : null,
                    images               : [],
                    instaPost            : null,
                    instaBioLink         : null,
                    instaStory           : null,
                    instaStoryLink       : null,
                },
                tabsLength            : 1,
                currentTab            : 0,
                guideLines            : 1,
                model                 : 0,
                e1                    : 0,
                kind                  : '1',
                checkbox2             : true,
                checkbox1             : false,
                items                 : ['Foo', 'Bar', 'Fizz', 'Buzz'],
                select2               : '',
                select                : ['Vuetify', 'Programming'],
                avatar                : null,
                saving                : false,
                saved                 : false,
                menu1                 : false,
                menu2                 : false,
                date                  : new Date().toISOString().substr(0, 10),
                touchPointProducts    : [],
                campaignDescription   : null,
                caption               : '',
                guideLineNumber       : 0,
                paymentMethod         : {},
                icon                  :null,
                disabledBioLink       :true,
                disabledStoryLink     :true,
                disabledPaid          : false,
                disabledBarter        : false,
                campaignTouchPointFields : {
                    touchPointTitle          : false,
                    touchPointInstagramFormat: false,
                    touchPointPaymentFormat  : false,
                    isPaid                   : false,
                    isBarter                 : false,
                    additionalPayAsBarter    : false,
                    additionalPayAsAmount    : false,
                    touchPointProduct        : false,
                    touchPointBrand          : false
                },
                touchPoints                  : [],
                touchPointTabsState          :{
                    preTouchPoint       : null,
                    currentTouchPoint   : 0,
                    nextTouchPoint      : null
                }
            }
        },
        computed: {
            ...mapGetters({
                placement           : 'campaign/campaignPlacement',
                campaignObjective   : 'campaign/campaignObjective',
                //touchPoint          : 'campaign/touchPoint'
            })
        },
        async mounted() {
            this.paymentMethod = Object.assign(this.paymentMethod, this.placement)
            this.setPayment();
            this.icon = this.paymentMethod.platform == 1 ? 'mdi-instagram': 'mdi-youtube';
            this.setTouchPointFields();
            await this.findTouchPoint(this.touchPointTabsState.currentTouchPoint);
        },
        methods: {
            ...mapMutations({
                setTouchPoint : 'campaign/setTouchPoint'
            }),
            ...mapActions({
                saveTouchPoint: 'campaign/saveTouchPoint',
                saveTouchPointField: 'campaign/saveTouchPointField',
                resetTouchPoint: 'campaign/resetTouchPoint'
            }),
            nextTab() {
                if (this.currentTab === this.tabsLength - 1) {
                    return false;
                }

                this.findTouchPoint(this.touchPointTabsState.nextTouchPoint);
                this.currentTab = this.currentTab + 1;
            },
            preTab() {
                if (this.currentTab === 0) {
                    return false;
                }

                this.findTouchPoint(this.touchPointTabsState.preTouchPoint);
                this.currentTab = this.currentTab - 1;
            },
            findTouchPoint(id){
                let result = _.find(this.touchPoints, ['id', id]);
                console.log(this.touchPoint, 'at the start');
                if(_.isNil(this.touchPointTabsState.preTouchPoint) || _.isNil(result)){
                    this.touchPoint = JSON.parse(localStorage.getItem('touchPoint'));
                    this.resetTouchPoint(JSON.parse(localStorage.getItem('touchPoint')));

                    console.log(this.touchPoint, 'at the if');
                    console.log(JSON.parse(localStorage.getItem('touchPoint')), 'at the local');
                    return;
                }

                this.touchPoint = _.find(this.touchPoints, ['id', id]);
                this.resetTouchPoint(this.touchPoint);

                console.log(this.touchPoint, 'at the else');
                return;
            },
            async addTouchPoint() {
                let response =  await this.saveTouchPoint();

                if (response.status === 200) {
                    this.touchPoint.id = response.details.id;
                    this.touchPoints.push(this.touchPoint);
                    this.tabsLength = this.tabsLength + 1;
                    this.currentTab = this.currentTab + 1;
                    this.touchPointTabsState.preTouchPoint = response.details.id;
                    this.touchPointTabsState.currentTouchPoint = this.touchPoint.id;
                    this.touchPoint = JSON.parse(localStorage.getItem('touchPoint'));
                    this.resetTouchPoint(JSON.parse(localStorage.getItem('touchPoint')));
                    this.guideLines = 1;

                    console.log(this.touchPoints, 'touchPoints Item');
                    console.log(this.touchPoint, 'touchPoint');
                }
            },
            removeTouchPoint() {
                if (this.tabsLength === 1) {
                    return false;
                }
                this.tabsLength = this.tabsLength - 1;
                this.currentTab = this.currentTab - 1;
            },
            addGuide() {
                this.guideLines = this.guideLines + 1;
            },
            removeGuide() {
                if (this.guideLines === 1) {
                    return false;
                }
                this.guideLines = this.guideLines - 1;
            },
            selectedProduct (e) {
                let self = this;
                let targetInput = `${ e.bindTo }`;
                self.touchPointProducts[targetInput] = e.item;
                this.setTouchPoint([targetInput, e.item]);
            },
            setPayment() {
                if (this.paymentMethod.paymentType === 'barter' && this.paymentMethod.additionalPayAsAmount === false) {
                    this.disabledPaid = true;
                    this.disabledBarter = false;
                } else if (this.paymentMethod.paymentType === 'paid' && this.paymentMethod.additionalPayAsBarter === false) {
                    this.disabledBarter = true;
                    this.disabledPaid = false;
                } else {
                    this.disabledBarter = false;
                    this.disabledPaid = false;
                }
            },
            setTouchPointFields() {

                this.campaignTouchPointFields.touchPointBrand = (this.campaignObjective.slug === 'unboxing' || this.campaignObjective.slug === 'product-review' || this.campaignObjective.slug === 'contest-giveways') ? false : true;
                this.campaignTouchPointFields.touchPointProduct = (this.campaignObjective.slug === 'unboxing' || this.campaignObjective.slug === 'product-review' || this.campaignObjective.slug === 'contest-giveways') ? true : false;
                this.campaignTouchPointFields.touchPointTitle = (this.campaignObjective.slug === 'product-review' || this.campaignObjective.slug === 'contest-giveways') ? false : true;
                this.campaignTouchPointFields.isBarter = (this.paymentMethod.paymentType === 'barter') ? true : false;
                this.campaignTouchPointFields.isPaid = (this.paymentMethod.paymentType == 'paid') ? true : false;
                this.campaignTouchPointFields.touchPointInstagramFormat = (this.paymentMethod.platform == 1) ? true : false;
                this.campaignTouchPointFields.additionalPayAsAmount = this.paymentMethod.additionalPayAsAmount;
                this.campaignTouchPointFields.additionalPayAsBarter = this.paymentMethod.additionalPayAsBarter;

                this.saveTouchPointField(this.campaignTouchPointFields)
            }
        },
        watch: {
            'touchPoint.caption' : {
                handler: function(val) {
                    this.setTouchPoint(['caption', val]);
                },
                immediate: true,
                deep: true
            },
            'touchPoint.hashtags' : {
                handler: function(val) {
                    this.setTouchPoint(['hashtags', val]);
                },
                immediate: true,
                deep: true
            },
            'touchPoint.mentions' : {
                handler: function(val) {
                    this.setTouchPoint(['mentions', val]);
                },
                immediate: true,
                deep: true
            },
            'touchPoint.guideLines' : {
                handler: function(val) {
                    this.setTouchPoint(['guideLines', _.values(val)]);
                },
                immediate: false,
                deep: true
            },
            'touchPoint.amount': {
                handler: function(val) {
                    this.setTouchPoint(['amount', val]);
                },
                immediate: true,
                deep: true
            },
            'touchPoint.name': {
                handler: function(val) {
                    this.setTouchPoint(['name', val]);
                },
                immediate: true,
                deep: true
            },
            'campaignDescription': {
                handler: function(val) {
                    this.setTouchPoint(['campaignDescription', val]);
                },
                immediate: true,
                deep: true
            },
            'touchPoint.images': {
                handler: function (val) {
                    return false;
                    if (!val.file) {
                        return;
                    }

                    let readFiles = [];

                    for (let i = 0; i < val.file.length; i++) {
                        let file = val.file[i];
                        let reader = new FileReader();

                        reader.onload = function (e) {
                            readFiles[i] = {
                                name: file.name,
                                size: file.size,
                                type: file.type,
                                src: e.target.result
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                    this.setTouchPoint(['images', readFiles]);
                },
                immediate: true,
                deep: true
            },
            'touchPoint.instaPost': {
                handler: function(val) {
                    this.setTouchPoint(['instaPost', val]);
                },
                immediate: true
            },
            'touchPoint.instaBioLink': {
                handler: function(val) {
                    this.setTouchPoint(['instaBioLink', val]);
                },
                immediate: true
            },
            'touchPoint.instaStory': {
                handler: function(val) {
                    this.setTouchPoint(['instaStory', val]);
                },
                immediate: true
            },
            'touchPoint.instaStoryLink': {
                handler: function(val) {
                    this.setTouchPoint(['instaStoryLink', val]);
                },
                immediate: true
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
</style>
