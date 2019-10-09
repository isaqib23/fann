<template>
    <div>
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


        <v-flex
        >
            <v-card class="elevation-4  mx-auto pa-3 transition-swing mt-3">
                <v-card-title>
                    <div class="subtitle-1 mb-2"><strong>Touch Point # 1</strong></div>
                </v-card-title>

                <v-select
                    :items="items"
                    label="Instagram image post"
                    solo
                    dense
                    append-icon="keyboard_arrow_down"
                    prepend-inner-icon="mdi-instagram"
                    class="custom_dropdown"
                ></v-select>

                <v-row class="mx-auto">
                    <v-flex xl10 lg10 md10 sm11 xs11>
                        <v-select
                            :items="items"
                            label="Instagram image post"
                            solo
                            dense
                            append-icon="keyboard_arrow_down"
                            prepend-inner-icon="mdi-instagram"
                            class="custom_dropdown product_right_border"
                        ></v-select>
                    </v-flex>
                    <v-flex xl2 lg2 md2 sm1 xs1>
                        <v-list-item-avatar height="50" min-width="45" width="45" class="ma-0 field_right_icon" color="grey lighten-2">
                            <span>$25</span>
                        </v-list-item-avatar>
                    </v-flex>
                </v-row>

                <v-row class="mx-auto">
                    <v-flex xl2 lg2 md2 sm1 xs2>
                        <v-list-item-avatar height="49" min-width="59" width="59" class="ma-0 field_icon">
                            <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg"></v-img>
                        </v-list-item-avatar>
                    </v-flex>
                    <v-flex xl8 lg8 md8 sm10 xs8>
                        <v-text-field
                            label="Instagram image post"
                            solo
                            dense
                            class="custom_dropdown product_right_border product_left_border"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xl2 lg2 md2 sm1 xs2>
                        <v-list-item-avatar height="50" min-width="45" width="45" class="ma-0 field_right_icon" color="grey lighten-2">
                            <span>$25</span>
                        </v-list-item-avatar>
                    </v-flex>
                </v-row>

                <div class="d-inline-block full_width promotions mb-2 mt-4">
                    <v-btn color="primary pl-3 pr-3">
                        Product Promotion
                    </v-btn>
                    <v-btn color="white float-right">
                        Brand Promotion
                    </v-btn>
                </div>

                <v-row class="mx-auto">
                    <v-flex xl2 lg2 md2 sm1 xs2>
                        <v-list-item-avatar height="49" min-width="59" width="59" class="ma-0 field_icon">
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
                        <div class="subtitle-1"><strong>Select Barter Product</strong></div>
                    </v-card-title>
                    <v-select
                        :items="items"
                        label="Select from here"
                        solo
                        dense
                        class="custom_dropdown"
                        append-icon="keyboard_arrow_down"
                    ></v-select>


                    <v-row class="mx-auto" justify="space-between">
                        <v-flex xl5 lg5 md5 sm12 xs12>
                            <v-menu
                                v-model="menu1"
                                :close-on-content-click="false"
                                max-width="290"
                            >
                                <template v-slot:activator="{ on }">
                                    <label class="font-weight-bold">Start Date</label>
                                    <v-text-field
                                        clearable
                                        label="Start Date"
                                        readonly
                                        solo
                                        class="custom_datepickr"
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker
                                    v-model="date"
                                    @change="menu1 = false"
                                ></v-date-picker>
                            </v-menu>
                        </v-flex>
                        <v-flex xl5 lg5 md5 sm12 xs12>
                            <v-menu
                                v-model="menu2"
                                :close-on-content-click="false"
                                max-width="290"
                            >
                                <template v-slot:activator="{ on }">
                                    <label class="font-weight-bold">End Date</label>
                                    <v-text-field
                                        clearable
                                        label="End Date"
                                        readonly
                                        solo
                                        class="custom_datepickr"
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker
                                    v-model="date"
                                    @change="menu2 = false"
                                ></v-date-picker>
                            </v-menu>
                        </v-flex>
                    </v-row>
                    <v-row class="mx-auto">
                        <v-flex md12>
                            <label class="font-weight-bold">The amount you are paying to influencer.</label>
                            <v-text-field
                                label="Start Date"
                                solo
                                class="custom_datepickr"
                            ></v-text-field>
                        </v-flex>
                    </v-row>

                </v-card>

                <v-card flat>
                    <v-card-title>
                        <div class="subtitle-1"><strong>Shipment</strong></div>
                    </v-card-title>
                    <v-checkbox v-model="checkbox2" label="I will be shipping this product to influencers" color="primary"></v-checkbox>
                </v-card>

            </v-card>
        </v-flex>

        <v-flex
        >
            <v-card class="elevation-4  mx-auto pa-3 transition-swing mt-3">
                <div class="text-center mt-4">
                    <v-btn block height="20" class="task_btn">+ Add another task</v-btn>
                </div>
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
            </v-card>
        </v-flex>

    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone';

    export default {
        components: {
            vueDropzone: vue2Dropzone,
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
                   dictDefaultMessage: "<div class='text-center'><i class='material-icons'>cloud_upload</i><br>Drag & Drop<br><span class='overline'>your files to assets, or <span class='primary--text'>browse</span></span></div>"
               },
               menu1: false,
               menu2: false,
               date: new Date().toISOString().substr(0, 10),
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
</style>
