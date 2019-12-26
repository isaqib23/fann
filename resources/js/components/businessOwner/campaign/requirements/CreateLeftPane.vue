<template>
    <div>
        <v-card>
            <v-flex>
                <v-card class="elevation-4 mx-auto pa-3 transition-swing">
                    <v-card-title>
                        <div class="subtitle-1 mb-2"><strong>Campaign Description</strong></div>
                    </v-card-title>

                    <v-textarea
                        v-model="campaignInformation.description"
                        label="Write your campaign description here"
                        auto-grow
                        outlined
                        rows="5"
                        row-height="15"
                        :error-messages="errors['campaignInformation.description']"
                        :disabled="loading"
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
                                v-if="touchPoint.touchPointConditionalFields.touchPointTitle"
                                :touchPoint="touchPoint"
                                :paymentMethod="paymentMethod"
                                :errorMessage="errors['touchPoint.name']"
                            ></touch-point-title-field>

                            <v-card-title>
                                <div class="subtitle-1 mb-1 text-capitalize"><strong>
                                    {{ (campaignObjective.slug !== undefined) ? campaignObjective.slug.replace('-',' ') : ''}}
                                </strong></div>
                            </v-card-title>

                            <v-row class="mx-auto my-1">
                                <touch-point-brand-field
                                    v-if="touchPoint.touchPointConditionalFields.touchPointBrand"
                                    :touchPoint="touchPoint"
                                    :paymentMethod="paymentMethod"
                                ></touch-point-brand-field>

                                <products-search
                                    v-if="touchPoint.touchPointConditionalFields.touchPointProduct"
                                    :emit-as="'dispatchProduct'"
                                    :selectedProduct="dispatchProduct"
                                    :selectedVariants="dispatchProductVariant"
                                    @selected-product="selectedProduct"
                                    :errorMessage="errors['touchPoint.dispatchProduct']"
                                ></products-search>
                            </v-row>

                            <touch-point-post-format-field
                                v-if="touchPoint.touchPointConditionalFields.touchPointInstagramFormat"
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
                                    :error-messages="errors['touchPoint.caption']"
                                    :disabled="loading"
                                ></v-textarea>
                            </v-card>

                            <v-flex>
                                <v-card-title>
                                    <div class="subtitle-1 mb-2"><strong>Guidelines</strong></div>
                                </v-card-title>
                                <v-badge v-for="n in guideLines" :key="n" class="full_width">
                                    <template v-slot:badge v-if="n !== touchPoint.guideLines.length">
                                        <v-icon @click="removeGuide(n)" color="white">mdi-minus</v-icon>
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
                                                :error-messages="errors['touchPoint.guideLines']"
                                                :disabled="loading"
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

                            <MultiImageInput v-model="touchPoint.images">
                                <v-layout row wrap pl-3 pr-3 mt-3 slot="activator">
                                    <v-flex lg4 sm4 m4 pr-3 class="text-center">
                                        <v-avatar size="40" v-ripple v-if="touchPoint.images.length == 0" class="mb-3" tile>
                                            <v-icon class="display-1">mdi-image-filter</v-icon>
                                        </v-avatar>
                                        <v-avatar size="40" v-else class="mb-3" tile>
                                            <v-img
                                                class="white--text align-end"
                                                :src="touchPoint.images.length > 0 ? touchPoint.images[0].imageURL : ''" alt="avatar">
                                            </v-img>
                                        </v-avatar>
                                    </v-flex>
                                    <v-flex lg8 sm8 m8 pl-3>
                                        <v-btn height="38" depressed block class="text-capitalize" color="primary">Choose Images</v-btn>
                                    </v-flex>
                                </v-layout>
                            </MultiImageInput>

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
                                        :error-messages="errors['touchPoint.hashtags']"
                                        :disabled="loading"
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
                                        :error-messages="errors['touchPoint.mentions']"
                                        :disabled="loading"
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
                            <v-layout row wrap pl-3 pr-3 pb-5 v-if="!disabledBarter">
                                <v-flex lg3 sm3 m3 pr-3>
                                    <v-btn outlined class="text-capitalize" color="grey">Barter</v-btn>
                                </v-flex>
                                <v-flex lg9 sm9 m9 pl-3>
                                    <products-search
                                        :placeholder="'Same as Unboxing'"
                                        :emit-as="'barterProduct'"
                                        :selectedProduct="barterProduct"
                                        :selectedVariants="barterProductVariant"
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
    import Form from '~/mixins/form';

    export default {
        components: {
            MultiImageInput: MultiImageInput,
            productsSearch : shopifyProductsPredictiveSearch,
            TouchPointTitleField : TouchPointTitleField,
            TouchPointPostFormatField : TouchPointPostFormatField,
            TouchPointBrandField : TouchPointBrandField
        },
        mixins: [Form],
        props : ["campObjective"],
        data ()  {
            return  {
                loading               : false,
                tabsLength            : 1,
                currentTab            : 0,
                guideLines            : 1,
                model                 : 0,
                e1                    : 0,
                description           : null,
                dispatchProduct       : null,
                dispatchProductVariant: [],
                barterProduct         : null,
                barterProductVariant  : [],
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
                touchPointTabsState          :{
                    preTouchPoint       : null,
                    currentTouchPoint   : 0,
                    nextTouchPoint      : null
                },

            }
        },
        computed: {
            ...mapGetters({
                placement           : 'campaign/campaignPlacement',
                touchPoint          : 'campaign/touchPoint',
                campaignObjective   : 'campaign/campaignObjective',
                savedTouchPoints    : 'campaign/savedTouchPoints',
                savedDispatchProduct: 'campaign/savedDispatchProduct',
                savedBarterProduct  : 'campaign/savedBarterProduct',
                campaignInformation : 'campaign/campaignInformation'
            })
        },
        beforeMount(){
            this.form.campaignInformation = Object.assign(this.campaignInformation);

            this.form.touchPoint = Object.assign(this.touchPoint);
        },
        async created() {
            await this.getCampaignTouchPoint({slug:this.$router.currentRoute.params.slug});
            await this.findTouchPoint(this.touchPointTabsState.currentTouchPoint);
            this.setTouchPointFields();
            this.tabsLength = (this.savedTouchPoints.length > 0) ? this.savedTouchPoints.length : this.tabsLength;
        },
        async mounted() {
            this.paymentMethod = Object.assign(this.paymentMethod, this.placement);
            this.setPayment();
        },
        methods: {
            ...mapMutations({
                setTouchPoint : 'campaign/setTouchPoint',
                updateCampaignInformation : 'campaign/updateCampaignInformation'
            }),
            ...mapActions({
                saveTouchPoint              : 'campaign/saveTouchPoint',
                saveTouchPointField         : 'campaign/saveTouchPointField',
                resetTouchPoint             : 'campaign/resetTouchPoint',
                getCampaignTouchPoint       : 'campaign/getCampaignTouchPoint',
                getSavedDispatchProduct     : 'campaign/getSavedDispatchProduct',
                getSavedBarterProduct       : 'campaign/getSavedBarterProduct',
                getUserCompany              : 'settings/getUserCompany'
            }),
            nextTab() {
                if (this.currentTab === this.tabsLength - 1) {
                    return false;
                }
                this.currentTab = this.currentTab + 1;
                this.findTouchPoint(this.currentTab);
            },
            preTab() {
                if (this.currentTab === 0) {
                    return false;
                }
                this.currentTab = this.currentTab - 1;
                this.findTouchPoint(this.currentTab);
            },
            async findTouchPoint(id) {
                if (this.savedTouchPoints.length > 0 && !_.isNil(this.savedTouchPoints[id])) {
                    this.resetTouchPoint(this.savedTouchPoints[id]);
                    this.setTouchPointFields();
                    if(!_.isNil(this.touchPoint.dispatchProduct)) {
                        await this.getSavedDispatchProduct({
                            product_id: this.touchPoint.dispatchProduct.productId,
                            shop: localStorage.selectedShop
                        });
                    }

                        await this.getSavedBarterProduct({
                            product_id: this.touchPoint.barterProduct.productId,
                            shop: localStorage.selectedShop
                        });
                } else {
                    this.resetTouchPoint(JSON.parse(localStorage.getItem('touchPoint')));
                    this.setTouchPointFields();
                }
                this.setGuidelineLenght();
            },
            setGuidelineLenght() {
                let objectLenght = this.touchPoint.guideLines;
                this.guideLines = (objectLenght.length > 0) ? objectLenght.length : this.guideLines;
            },
            async addTouchPoint() {
                let response =  await this.saveTouchPoint();

                if (response.status === 200) {
                    this.loading = false
                    this.touchPoint.id = response.details.touch_point_id;
                    this.tabsLength = this.tabsLength + 1;
                    this.currentTab = this.currentTab + 1;
                    this.touchPointTabsState.preTouchPoint = response.details.touch_point_id;
                    this.touchPointTabsState.currentTouchPoint = this.touchPoint.id;
                    this.resetTouchPoint(JSON.parse(localStorage.getItem('touchPoint')));
                    this.setTouchPointFields();
                    this.guideLines = 1;

                } else {
                    this.loading = true
                    this.handleErrors(response.details)
                }
                this.loading = false
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
            removeGuide(n) {
                if (this.guideLines === 1) {
                    return false;
                }
                this.guideLines = this.guideLines - 1;
                this.touchPoint.guideLines.splice(n, 1);
                this.setGuidelineLenght();
                this.setTouchPoint(['guideLines', _.values(this.touchPoint.guideLines)]);
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

                let optFields = this.touchPoint.touchPointConditionalFields;
                optFields.touchPointBrand = (this.campaignObjective.slug === 'unboxing' || this.campaignObjective.slug === 'product-review' || this.campaignObjective.slug === 'contest-giveways') ? false : true;
                optFields.touchPointProduct = (this.campaignObjective.slug === 'unboxing' || this.campaignObjective.slug === 'product-review' || this.campaignObjective.slug === 'contest-giveways') ? true : false;
                optFields.touchPointTitle = (this.campaignObjective.slug === 'product-review' || this.campaignObjective.slug === 'contest-giveways') ? false : true;
                optFields.isBarter = (this.paymentMethod.paymentType === 'barter') ? true : false;
                optFields.isPaid = (this.paymentMethod.paymentType == 'paid') ? true : false;
                optFields.touchPointInstagramFormat = (this.paymentMethod.platform === 1) ? true : false;
                optFields.additionalPayAsAmount = this.paymentMethod.additionalPayAsAmount;
                optFields.additionalPayAsBarter = this.paymentMethod.additionalPayAsBarter;

                this.saveTouchPointField(optFields)
            }
        },
        watch: {
            'touchPoint.images': {
                handler: function (val) {
                    if (!val.file) {
                        return;
                    }

                    let readFiles = [];

                    for (let i = 0; i < val.file.length; i++) {
                        let file = val.file[i];
                        let reader = new FileReader();

                        reader.onload = function (e) {
                            let imgObject = {
                                name: file.name,
                                size: file.size,
                                type: file.type,
                                src: e.target.result,
                                imageURL: URL.createObjectURL(file)
                            };
                            readFiles.push(imgObject);
                        };
                        reader.readAsDataURL(file);
                    }
                    this.setTouchPoint(['images', readFiles]);
                },
                immediate: true,
                deep: true
            },
            // 'campaignInformation': {
            //     handler: function(val) {
            //         let self = this;
            //         if(!_.isNil(val)) {
            //             self.description = val.description;
            //         }
            //     },
            //     immediate: true,
            //     deep:true
            // },
            // 'description': {
            //     handler: function(val) {
            //         let self = this;
            //         if(!_.isNil(val)) {
            //             self.campaignInformation.description = val;
            //         }
            //     },
            //     immediate: true,
            //     deep:true
            // },
            'savedDispatchProduct' (val) {
                if(!_.isNil(val.details)) {
                    this.dispatchProductVariant = [];
                    this.dispatchProduct = val.details;
                    this.dispatchProductVariant.push(this.touchPoint.dispatchProduct);
                }
            },
            'savedBarterProduct' (val) {
                this.barterProductVariant = [];
                this.barterProduct = null;
                if(!_.isNil(val.details) && this.touchPoint.isBarter) {
                    this.barterProduct = val.details;
                    this.barterProductVariant.push(this.touchPoint.barterProduct);
                }
            },
            placement : {
                handler: function(val) {
                    let self = this;
                    if(!_.isNil(val)) {
                        self.paymentMethod = Object.assign(self.paymentMethod, val);
                        self.setPayment();
                        self.setTouchPointFields();
                    }
                },
                immediate: true,
                deep:true
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
    >>>.v-text-field__details {

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
