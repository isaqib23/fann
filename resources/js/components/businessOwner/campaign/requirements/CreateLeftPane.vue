<template>
    <div>
        <v-flex>
            <v-card class="elevation-4 mx-auto pa-3 transition-swing"
            >
                <v-card-text >
                    <div class="subtitle-1 mb-2"><strong>Campaign Description</strong></div>
                </v-card-text>

                <v-textarea
                    label="Write your campaign description here"
                    auto-grow
                    outlined
                    rows="5"
                    row-height="15"
                ></v-textarea>
            </v-card>
        </v-flex>


        <v-flex>
            <v-card class="elevation-4  mx-auto pa-3 transition-swing mt-3">
                <v-card-title>
                    <div class="subtitle-1 mb-2"><strong>Touch Point # 1</strong></div>
                </v-card-title>

                <v-text-field
                    solo
                    label="Instagram image post"
                    prepend-inner-icon="mdi-instagram"
                    append-icon="place"
                    class="touch_field"
                ></v-text-field>

                <div class="d-inline-block full_width promotions mb-2 mt-4">
                    <v-btn color="primary pl-3 pr-3">
                        Product Promotion
                    </v-btn>
                    <v-btn color="white float-right">
                        Brand Promotion
                    </v-btn>
                </div>

                <v-text-field
                    solo
                    label="Instagram image post"
                    prepend-inner-icon="mdi-instagram"
                    class="touch_field mb-4"
                ></v-text-field>

                <v-tabs fixed-tabs class="fields_tabs" active-class="active_tab">
                    <v-tab>
                        Guidelines
                    </v-tab>
                    <v-tab>
                        Captions
                    </v-tab>
                    <v-tab>
                        Upload images
                    </v-tab>
                    <v-tab-item>
                        <v-textarea
                            label="Write your campaign description here"
                            auto-grow
                            outlined
                            rows="5"
                            row-height="15"
                        ></v-textarea>
                    </v-tab-item>
                    <v-tab-item>
                        <v-textarea
                            label="Write your campaign description here"
                            auto-grow
                            outlined
                            rows="5"
                            row-height="15"
                        ></v-textarea>
                    </v-tab-item>
                    <v-tab-item>
                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
                    </v-tab-item>
                </v-tabs>
                <div class="d-inline-block full_width promotions mb-2 mt-4">
                    <v-btn color="primary pl-7 pr-7">
                        IG Story
                    </v-btn>
                    <v-btn color="white" class="pl-5 pr-5">
                        IG Post
                    </v-btn>
                </div>

                <v-card flat>
                    <v-card-title>
                        <div class="subtitle-1"><strong>Shipment</strong></div>
                    </v-card-title>

                    <v-checkbox v-model="checkbox2" label="I will be shipping this product to influencers" color="primary"></v-checkbox>
                    <v-text-field class="ma-auto"
                                  :label="$t('labels.campaign.payment_FieldPlaceHolder')"
                                  solo
                    ></v-text-field>
                </v-card>


                <v-textarea
                    label="Write your task requirement here"
                    auto-grow
                    outlined
                    rows="8"
                    row-height="15"
                ></v-textarea>
                <div class="text-center mt-4">
                    <v-btn block height="20" class="task_btn">+ Add another task</v-btn>
                </div>
                <v-layout row wrap pl-3 pr-3 mt-5>
                    <v-flex lg6 sm6 m6 pr-3>
                        <div class="subtitle-2 mb-2"><strong>Hashtags</strong></div>
                        <div class="overline mb-2">Seprate with (,)</div>
                        <v-text-field
                            outlined
                            label="Fitness,Gym"
                            prepend-icon="#"
                            class="tag_field"
                        ></v-text-field>
                    </v-flex>
                    <v-flex lg6 sm6 m6 pl-3>
                        <div class="subtitle-2 mb-2"><strong>Brand Mention</strong></div>
                        <div class="overline mb-2">Seperate with (,)</div>
                        <v-text-field
                            outlined
                            label="Nike,Nuchey"
                            prepend-icon="@"
                            class="tag_field"
                        ></v-text-field>
                    </v-flex>
                </v-layout>

                <div class="subtitle-2 mt-4"><strong>Due Date</strong></div>
                <v-layout row wrap pl-3 pr-3 mt-2>
                    <v-flex lg4 sm4 m4>
                        <v-text-field
                            outlined
                            label="mm"
                            class="tag_field"
                            type="number"
                        ></v-text-field>
                    </v-flex>
                    <v-flex lg4 sm4 m4>
                        <v-text-field
                            outlined
                            label="yy"
                            class="tag_field"
                            type="number"
                        ></v-text-field>
                    </v-flex>
                    <v-flex lg4 sm4 m4>
                        <v-text-field
                            outlined
                            label="dd"
                            class="tag_field"
                            type="number"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card>
        </v-flex>

        <v-flex>
            <v-card class="elevation-4  mx-auto pa-3 transition-swing mt-3">
                <v-card-title>
                    <div class="subtitle-1 mb-2"><strong>Campaign Cover</strong></div>
                    Upload your campaign cover photo
                </v-card-title>
                <div class="dropzone_content">
                    <div class="subtitle-1 mb-2">Upload</div>

                </div>
            </v-card>
        </v-flex>

        <v-flex>
            <v-card class="elevation-4  mx-auto pa-3 transition-swing  mt-3"
            >
                <v-card-title>
                    <div class="subtitle-1"><strong>Content Guidelines</strong></div>
                </v-card-title>

                <v-text-field
                    outlined
                    label=""
                    prepend-icon="1"
                    class="tag_field mb-3"
                ></v-text-field>
                <v-text-field
                    outlined
                    label=""
                    prepend-icon="2"
                    class="tag_field"
                ></v-text-field>
            </v-card>
        </v-flex>

        <v-flex>
            <v-card class="elevation-4  mx-auto pa-3 transition-swing  mt-3"
            >
                <v-card-title>
                    <div class="subtitle-1"><strong>Shipment</strong></div>
                </v-card-title>

                <v-checkbox v-model="checkbox2" label="I will be shipping this product to influencers" color="primary"></v-checkbox>
            </v-card>
        </v-flex>

        <v-flex>
            <v-card class="elevation-4  mx-auto pa-3 transition-swing  mt-3"
            >

                <v-checkbox v-model="checkbox1" :label="$t('labels.campaign.payment_AmountCheckBox')" color="primary"></v-checkbox>
                <v-text-field class="ma-auto"
                              :label="$t('labels.campaign.payment_FieldPlaceHolder')"
                              solo
                ></v-text-field>
                <v-checkbox v-model="checkbox2" :label="$t('labels.campaign.payment_OfferCheckBox')" color="primary"></v-checkbox>
            </v-card>
        </v-flex>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    export default {
        components: {
            vueDropzone: vue2Dropzone
        },
        data: () => {
           return  {
               e1: 0,
               checkbox2: true,
               checkbox1: false,
               items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
               dropzoneOptions: {
                   url: 'https://httpbin.org/post',
                   maxFilesize: 0.5,
                   thumbnailHeight: 100,
                   acceptedFiles:'image/*',
                   addRemoveLinks: true,
                   dictDefaultMessage: "<i class='material-icons'>cloud_upload</i><br>Drag & Drop<br><span class='overline'>your files to assets, or <span class='primary--text'>browse</span></span>"
               }
            }
        },
        methods: {}
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
    >>>.touch_field > .v-input__control > .v-input__slot{
        padding-right: 0px !important;
        padding-left: 0px !important;
    }
    >>>.touch_field .v-input__append-inner{
        margin-top: 0px !important;
    }
    >>>.touch_field .v-input__append-inner .v-input__icon{
        background: #dcdcdc;
        padding: 28px;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }
    >>>.touch_field .v-input__append-inner .v-icon.v-icon{
        color: #2f2f2f !important;
    }
    >>>.touch_field .v-input__prepend-inner .v-input__icon{
        background: #EE6F6F;
        padding: 28px;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }
    >>>.touch_field .v-input__prepend-inner .v-icon.v-icon{
        color: #ffffff !important;
    }
    >>>.touch_field .v-input__prepend-inner{
        margin-top: 0px !important;
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
</style>
