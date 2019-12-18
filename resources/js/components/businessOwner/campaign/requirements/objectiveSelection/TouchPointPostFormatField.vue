<template>
    <div>
        <v-layout>
            <v-flex lg12 sm12 m12>
                <v-card-title>
                    <div class="subtitle-1 mb-2"><strong>Format</strong></div>
                </v-card-title>
            </v-flex>
        </v-layout>
        <v-layout row wrap pl-3 pr-3>
            <v-flex lg4 sm4 m4 pr-3>
                <v-checkbox class="mt-0 pt-0" color="primary" label="Instagram Post"
                            v-model="touchPoint.instaFormatFields.instaPost"
                            @click="disabledBioLink = !disabledBioLink"
                            value="post"
                ></v-checkbox>
            </v-flex>
            <v-flex lg8 sm8 m8 pl-3>
                <v-text-field
                    solo
                    label="Bio Link"
                    class="custom_dropdown"
                    v-model="touchPoint.instaFormatFields.instaBioLink"
                    :disabled="disabledBioLink"
                ></v-text-field>
            </v-flex>
        </v-layout>
        <v-layout row wrap pl-3 pr-3 mt-3>
            <v-flex lg4 sm4 m4 pr-3>
                <v-checkbox class="mt-0 pt-0" color="primary" label="Instagram Story"
                            v-model="touchPoint.instaFormatFields.instaStory"
                            @click="disabledStoryLink = !disabledStoryLink"
                            value="story"
                ></v-checkbox>
            </v-flex>
            <v-flex lg8 sm8 m8 pl-3>
                <v-text-field
                    solo
                    label="Story Link"
                    class="custom_dropdown"
                    v-model="touchPoint.instaFormatFields.instaStoryLink"
                    :disabled="disabledStoryLink"
                ></v-text-field>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>

    export default {
        props : {
            touchPoint    : {},
            paymentMethod : {}
        },
        data ()  {
            return  {
                icon                  :null,
                disabledBioLink       :true,
                disabledStoryLink     :true,
            }
        },
        mounted () {
            this.disabledBioLink = (_.isNil(this.touchPoint.instaFormatFields.instaPost)) ? this.disabledBioLink : false;
            this.disabledStoryLink = (_.isNil(this.touchPoint.instaFormatFields.instaStory)) ? this.disabledBioLink : false;
            console.log(this.disabledBioLink, 'disabledBioLink');
            console.log(this.disabledStoryLink, 'disabledStoryLink');
            console.log(this.touchPoint, 'disabledStoryLink');
            this.icon = this.paymentMethod.platform == 2 ? 'mdi-instagram': 'mdi-youtube';
        }
    }
</script>

<style scoped>
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
    >>>.custom_dropdown .v-input__control{
        min-height: 45px !important;
    }
    >>>.custom_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    >>>.custom_dropdown .v-input__slot{
        margin-bottom: 0px !important;
    }
</style>
