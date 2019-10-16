<template>
    <div>
        <v-flex>
            <v-card class="elevation-4  mx-auto pa-5 transition-swing">
                <v-card-title>
                    <div class="subtitle-1 mb-2"><strong>Select Niche / Industry</strong></div>
                </v-card-title>
                <v-select
                    :items="items"
                    label="Health Care"
                    solo
                    class="custom_dropdown"
                ></v-select>

                <div class="kind_group">
                    <div class="subtitle-2 mt-0 mb-2">What kind of Influencers you are looking for?</div>
                    <v-radio-group v-model="kind" row class="mt-0">
                        <v-radio class="insta_radio" label="Instagram" off-icon="mdi-instagram" on-icon="mdi-instagram" value="radio-1" active-class="kind_active"></v-radio>
                        <v-radio class="youtube_radio" label="Youtube" off-icon="mdi-youtube" on-icon="mdi-youtube" value="radio-2" active-class="kind_active"></v-radio>

                    </v-radio-group>
                </div>

                <div class="kind_group">
                    <div class="subtitle-2 mt-6 mb-2">Followers</div>
                    <v-range-slider
                        v-model="range"
                        :max="max"
                        :min="min"
                        hide-details
                        class="align-center"
                    ></v-range-slider>
                    <p style="font-size: 10px">{{range[0]}} - {{range[1]}} Followers</p>
                </div>

                <div class="kind_group">
                    <div class="subtitle-2 mt-6 mb-2">Likes per Post</div>
                    <v-range-slider
                        v-model="range"
                        :max="max"
                        :min="min"
                        hide-details
                        class="align-center"
                    ></v-range-slider>
                    <p style="font-size: 10px">{{range[0]}} - {{range[1]}} Likes</p>
                </div>

                <div class="kind_group">
                    <div class="subtitle-2 mt-6 mb-0">Engagement Rate</div>
                    <v-select
                        :items="items"
                        label="10% to 15% Min"
                        solo
                        class="custom_dropdown"
                    ></v-select>
                </div>

                <div class="kind_group">
                    <div class="subtitle-2 mt-0 mb-2">Rating</div>
                    <v-rating v-model="rating" background-color="grey"></v-rating>
                </div>
            </v-card>
        </v-flex>

        <v-flex>
            <v-card class="elevation-4  mx-auto pa-5 transition-swing mt-3">
                <v-card-title>
                    <div class="subtitle-1 mb-2"><strong>Influencers Demographics</strong></div>
                </v-card-title>

                <div class="gender_group">
                    <div class="subtitle-2 mb-2">Gender</div>
                    <v-radio-group v-model="kind" row class="mt-0">
                        <v-radio label="Male" off-icon="mdi-human-male" on-icon="mdi-human-male" value="radio-4" active-class="kind_active"></v-radio>
                        <v-radio label="Female" off-icon="mdi-human-female" on-icon="mdi-human-female" value="radio-5" active-class="kind_active"></v-radio>
                    </v-radio-group>
                </div>

                <div class="age_group">
                    <div class="subtitle-2 mb-2">Age Range</div>
                    <v-radio-group v-model="kind" row class="mt-0">
                        <v-radio label="13 - 17" off-icon="mdi-human-males" on-icon="mdi-human-males" value="radio-6" active-class="kind_active"></v-radio>
                        <v-radio label="18 - 24" off-icon="mdi-human-males" on-icon="mdi-human-males" value="radio-7" active-class="kind_active"></v-radio>
                        <v-radio label="25 - 34" off-icon="mdi-human-males" on-icon="mdi-human-males" value="radio-8" active-class="kind_active"></v-radio>
                        <v-radio label="35 - 44" off-icon="mdi-human-males" on-icon="mdi-human-males" value="radio-9" active-class="kind_active"></v-radio>
                        <v-radio label="60+" off-icon="mdi-human-males" on-icon="mdi-human-males" value="radio-10" active-class="kind_active"></v-radio>
                    </v-radio-group>
                </div>

                <div class="age_group">
                    <div class="subtitle-2 mb-2">Country</div>
                    <v-autocomplete
                        :items="countries"
                        v-model="selected"
                        label="Select"
                        solo
                        class="custom_dropdown"
                        return-object
                        item-text="name"
                    >
                        <template slot="selection" slot-scope="data">
                            <v-avatar size="36" class="mr-2" tile >
                                <img :src="getFlag(data.item.flag)">
                            </v-avatar>
                            <div> {{ data.item.name }}
                            </div>
                        </template>
                        <template slot="item" slot-scope="data">
                            <v-list-tile-avatar size="36">
                                <img :src="getFlag(data.item.flag)">
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title> {{ data.item.name }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </template>
                    </v-autocomplete>
                </div>

                <v-card-actions class="action_btns mt-0 mb-3">
                    <v-btn color="primary" dark large block class="text-capitalize">
                        Apply Search Filters
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </div>
</template>

<script>
    import axios from 'axios'
    import { api } from '~/config'
    export default {
        components: {

        },
        data: () => {
           return  {
               kind: null,
               min: 0,
               max: 1000,
               range: [100, 600],
               rating:3,
               selected: null,
               countries : [],
               itemss: [
                   { text: 'Jason Oner', avatar: 'https://upload.wikimedia.org/wikipedia/commons/f/f1/Vue.png' },
                   { text: 'Travis Howard', avatar: 'https://upload.wikimedia.org/wikipedia/commons/f/f1/Vue.png' },
                   { text: 'Ali Connors', avatar: 'https://upload.wikimedia.org/wikipedia/commons/f/f1/Vue.png' },
                   { text: 'Cindy Baker', avatar: 'https://upload.wikimedia.org/wikipedia/commons/f/f1/Vue.png' }
               ]
            }
        },
        methods: {
            getCountries: function(){
                let self = this;
                self.busy = true;
                axios
                    .get(api.path('countryList'))
                    .then(function(resp){
                        self.countries = resp.data.data;
                        console.log(self.countries);
                    });
            },
            getFlag(name){
                return '/images/flags/'+name+'.svg';
            }
        },
        mounted() {
            this.getCountries();
        },
    }
</script>

<style scoped>

    >>>.kind_active {
        background: #EE6F6F !important;
        padding: 15px !important;
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
    >>>.kind_group .v-input--radio-group__input, >>>.gender_group .v-input--radio-group__input{
        border: 1px solid #ccc !important;
        border-radius: 5px !important;

    }
    >>>.age_group .v-input--radio-group__input{
        border: none;
    }
    >>>.age_group .v-radio{
        height: 30px;
        padding-left: 15px;
        padding-right: 15px;
        margin-right:0px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin: 5px;
    }
    >>>.age_group .v-input--selection-controls__input{
        display:none;
    }
    >>>.kind_group .v-radio, >>>.gender_group .v-radio{
        height: 50px;
        padding-left: 15px;
        padding-right: 15px;
        margin-right:0px;
    }
    >>>.kind_group .v-radio:first-child, >>>.gender_group .v-radio:first-child{
        border-right: 1px solid #ccc;
    }
    >>>.kind_group .v-radio:last-child, >>>.gender_group .v-radio:last-child{
        border-left: 1px solid #ccc;
    }
    >>>.kind_group .v-label{
        position: absolute !important;
        bottom: -75px;
        font-size: 11px;
    }
    >>>.youtube_radio .v-label{
        margin-left: 65px !important;
    }
    >>>.blogger_radio .v-label{
        margin-left: 130px !important;
    }
    v-list-tile-avatar img {
        height: 15px !important;
        margin-right: 10px
    }
    >>>.gender_group .v-radio{
        height: 35px !important;
    }
    >>>.custom_dropdown .v-input__control{
        min-height: 45px !important;
    }
    >>>.custom_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    >>>.v-rating .v-icon{
        padding:0px;
    }
</style>
