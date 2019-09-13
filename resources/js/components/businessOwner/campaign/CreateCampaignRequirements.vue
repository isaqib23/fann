<template>
    <div>
        <v-flex>
            <v-layout class="panes-container full_height left-pane">
                <v-card fluid grid-list-md>

                    <v-tabs vertical flat icons-and-text active-class="active_tab" background-color="decent" color="gutter" >
                        <v-tab >
                            Create
                            <v-icon left>mdi-account-plus</v-icon>
                        </v-tab>
                        <v-tab>
                            invite
                            <v-icon left>mdi-lock</v-icon>
                        </v-tab>
                        <v-tab>
                            promote
                            <v-icon left>mdi-access-point</v-icon>
                        </v-tab>

                        <v-tab-item>

                            <v-flex>
                                <v-card class="elevation-4  mx-auto pa-3 transition-swing">
                                    <v-card-text>
                                        <div class="subtitle-1 mb-2"><strong>Campaign Cover</strong></div>
                                        Upload your campaign cover photo
                                    </v-card-text>
                                    <div class="dropzone_content">
                                        <div class="subtitle-1 mb-2">Upload</div>
                                    <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
                                    </div>
                                </v-card>
                            </v-flex>

                            <v-flex>
                                <v-card class="elevation-4 mx-auto pa-3 transition-swing mt-3"
                                >
                                    <v-card-text >
                                        <div class="subtitle-1 mb-2"><strong>Campaign Description</strong></div>
                                    </v-card-text>

                                    <v-textarea
                                        label="Write your campaign description here"
                                        auto-grow
                                        outlined
                                        rows="8"
                                        row-height="15"
                                    ></v-textarea>
                                </v-card>
                            </v-flex>

                            <v-flex>
                                <v-card class="elevation-4  mx-auto pa-3 transition-swing mt-3"
                                >
                                    <v-card-text >
                                        <div class="subtitle-1 mb-2"><strong>Campaign Requirements / Tasks</strong></div>
                                    </v-card-text>

                                    <v-layout row wrap pl-3 pr-3>
                                        <v-flex lg9 sm9 m9>
                                            <v-text-field
                                                outlined
                                                label="Instagram image post"
                                                prepend-icon="mdi-instagram"
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex lg3 sm3 m3>
                                            <v-text-field
                                                outlined
                                                label="Qty"
                                                type="number"
                                            ></v-text-field>
                                        </v-flex>
                                    </v-layout>
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
                                <v-card class="elevation-4  mx-auto pa-3 transition-swing  mt-3"
                                >
                                    <v-card-text >
                                        <div class="subtitle-1"><strong>Content Guidelines</strong></div>
                                    </v-card-text>

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
                                    <v-card-text >
                                        <div class="subtitle-1"><strong>Shipment</strong></div>
                                    </v-card-text>

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

                        </v-tab-item>
                        <v-tab-item>
                            <v-card>
                                <v-card-text>
                                    <p>
                                        Morbi nec metus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Nunc sed turpis.
                                    </p>

                                    <p>
                                        Suspendisse feugiat. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In hac habitasse platea dictumst. Fusce ac felis sit amet ligula pharetra condimentum.
                                    </p>

                                    <p>
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Nam commodo suscipit quam. In consectetuer turpis ut velit. Sed cursus turpis vitae tortor. Aliquam eu nunc.
                                    </p>

                                    <p>
                                        Etiam ut purus mattis mauris sodales aliquam. Ut varius tincidunt libero. Aenean viverra rhoncus pede. Duis leo. Fusce fermentum odio nec arcu.
                                    </p>

                                    <p class="mb-0">
                                        Donec venenatis vulputate lorem. Aenean viverra rhoncus pede. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Fusce commodo aliquam arcu. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi.
                                    </p>
                                </v-card-text>
                            </v-card>
                        </v-tab-item>
                        <v-tab-item>
                            <v-card>
                                <v-card-text>
                                    <p>
                                        Fusce a quam. Phasellus nec sem in justo pellentesque facilisis. Nam eget dui. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In dui magna, posuere eget, vestibulum et, tempor auctor, justo.
                                    </p>

                                    <p class="mb-0">
                                        Cras sagittis. Phasellus nec sem in justo pellentesque facilisis. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nam at tortor in tellus interdum sagittis.
                                    </p>
                                </v-card-text>
                            </v-card>
                        </v-tab-item>
                    </v-tabs>
                </v-card>
            </v-layout>

            <v-layout column class="right-pane"></v-layout>
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
    >>>.v-tabs-items, >>>.v-card{
        background-color:#F7F7FF !important;
    }
    >>>.v-card{
        box-shadow:none !important;
    }
     .full_height {
        height: 100% !important;
    }

    v-tabs {
        height:100%;
    }
    .v-tabs > .v-tabs-bar {
        margin: 0 0 0 -14px !important;
        background: #403C79 !important;
        height: 100% !important;
        display: block !important;
        border-radius:0px !important;
    }
    .active_tab {
        color:black !important;
        background: #F7F7FF !important;
    }
    .theme--light.v-tabs>.v-tabs-bar .v-tab--disabled, .theme--light.v-tabs>.v-tabs-bar .v-tab:not(.v-tab--active), .theme--light.v-tabs>.v-tabs-bar .v-tab:not(.v-tab--active) > .v-icon {
        color:#A5A4BF !important;
    }
    #dropzone {
        background-color: #EFF2F8;
        font-family: 'Arial', sans-serif;
        letter-spacing: 0.2px;
        color: #777;
        transition: background-color .2s linear;
        border:none;
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
    >>>.v-input__prepend-outer{
        background:#EE6F6F;
        padding:16px 14px;
        margin:0px !important;
        border-top-left-radius:5px;
    }
    >>>.v-input__prepend-outer .v-icon{
        color:#fff !important;
    }
    >>>.v-text-field > .v-input__control > .v-input__slot{
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
