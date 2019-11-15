<template>
    <v-flex class="my-12 mx-auto card_wrapper">
        <div class="subtitle-1 mb-2 text-uppercase"><strong>Business Profile</strong></div>
        <v-card class="pa-6">
            <v-row class="mx-auto">
                <v-form ref="form" @submit.prevent="submit" enctype="multipart/form-data">
                    <v-flex xl12 lg12 md12 sm12 sx12 class="mr-12">
                        <v-card-title>
                            <div class="subtitle-1 mb-2"><strong>Business Information</strong></div>
                        </v-card-title>
                        <v-card-text>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum maiores modi quidem veniam, expedita quis laboriosam, ullam facere adipisci, iusto, voluptate sapiente corrupti asperiores rem nemo numquam fuga ab at.</p>

                            <div class="subtitle-1 mb-2 black--text"><strong>Personal Business</strong></div>
                            <v-row>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">First Name</label>
                                    <v-text-field
                                        v-model="user.name"
                                        label="First Name"
                                        solo
                                        class="mt-1 custom_dropdown"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Last Name</label>
                                    <v-text-field
                                        label="Last Name"
                                        solo
                                        class="mt-1 custom_dropdown"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Email</label>
                                    <v-text-field
                                        v-model="user.email"
                                        label="First Name"
                                        solo
                                        class="mt-1 custom_dropdown"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                            <div class="subtitle-1 mb-2 black--text"><strong>Company Details</strong></div>
                            <v-row>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Upload Logo</label>
                                    <v-file-input
                                        :rules="rules"
                                        accept="image/png, image/jpeg, image/bmp"
                                        placeholder="Pick an Company Logo"
                                        prepend-icon="mdi-camera"
                                        label="Company Logo"
                                        @change="onFileChange"
                                        v-model="file"
                                        ref="files"
                                    ></v-file-input>
                                </v-col>
                            </v-row>

                            <v-row justify="start">
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Website</label>
                                    <v-text-field
                                        label="www.abc.com"
                                        solo
                                        class="mt-1 custom_dropdown"
                                        v-model="user.company_user.company.website"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Niche</label>
                                    <v-select
                                        :items="items"
                                        label="Health & fitness"
                                        solo
                                        class="custom_dropdown"
                                        append-icon="keyboard_arrow_down"
                                        v-model="user.company_user.company.niche"
                                    ></v-select>
                                </v-col>
                            </v-row>

                            <v-row justify="start">
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Phone</label>
                                    <v-text-field
                                        label="123456789"
                                        solo
                                        class="mt-1 custom_dropdown"
                                        v-model="user.company_user.company.phone"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Time Zone</label>
                                    <v-text-field
                                        label="Europe"
                                        solo
                                        class="mt-1 custom_dropdown"
                                        v-model="user.company_user.company.timezone"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row justify="start">
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Business Address</label>
                                    <v-textarea
                                        solo
                                        name="input-7-4"
                                        label="Solo textarea ......"
                                        rows="7"
                                        class="custom_dropdown"
                                        v-model="user.company_user.company.address"
                                    ></v-textarea>
                                </v-col>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Country</label>
                                    <v-autocomplete
                                        :items="countries"
                                        v-model="user.company_user.company.country_id"
                                        label="Pakistan"
                                        solo
                                        class="custom_dropdown"
                                        append-icon="keyboard_arrow_down"
                                        item-text="name"
                                        @change="getCountryStates"
                                        item-value="id"
                                    ></v-autocomplete>
                                    <label class="font-weight-bold">State</label>
                                    <v-autocomplete
                                        :items="states"
                                        v-model="user.company_user.company.state_id"
                                        label="Islamabad"
                                        solo
                                        append-icon="keyboard_arrow_down"
                                        class="custom_dropdown"
                                        return-object
                                        item-text="name"
                                        item-value="id"
                                    ></v-autocomplete>
                                </v-col>
                            </v-row>
                        </v-card-text>

                        <v-card-actions class="text-right float-right">
                            <v-btn class="caption mr-3 text-capitalize" large>Button</v-btn>
                            <v-btn type="submit" color="primary" class="caption text-capitalize" large>Submit</v-btn>
                        </v-card-actions>
                    </v-flex>
                </v-form>
            </v-row>
        </v-card>
    </v-flex>
</template>

<script>
    import {mapGetters} from 'vuex'
    import axios from 'axios'
    import { api } from '~/config'
    import Form from '~/mixins/form'
    export default {
        mixins: [Form],
        data: () => ({
            rules: [
                value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
            ],
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            user: {
                name: null,
                email: null,
                file: null,
                company_user:{
                    company:{}
                }
            },
            states : [],
            countries : [],
            selectedCountry : null,
            file: null,
            imageUrl: null
        }),

        computed: mapGetters({
            auth: 'auth/user'
        }),
        methods: {
            getCountries: function(){
                let self = this;
                self.busy = true;
                axios
                    .get(api.path('countryList'))
                    .then(function(resp){
                        self.countries = resp.data.countries;
                    });
            },
            getCountryStates: function(){
                console.log(this.user.company_user.company);
                let self = this;
                self.busy = true;
                this.states = [],
                axios
                    .post(api.path('stateList'),this.user.company_user.company)
                    .then(function(resp){
                        self.states = resp.data.states;
                        console.log(self.states);
                    });
            },
            submit() {
                this.loading = true

                axios.put(api.path('profile'), this.user)
                    .then(res => {
                        this.$toast.success('Your profile successfully updated.')
                        this.$emit('success', res.data)
                    })
                    .catch(err => {
                        this.handleErrors(err.response.data.errors)
                    })
                    .then(() => {
                        this.loading = false
                    })
            },
            onFileChange() {
                this.user.file = this.$refs.file.files[0];
                console.log(this.user.file);
            }
        },
        mounted() {
            this.user = Object.assign(this.user, this.auth);
            this.getCountries();
            if(this.user.company_user !== null) {
                this.getCountryStates();
            }
        }
    }
</script>
<style scoped>
    .card_wrapper{
        width: 90%;
    }
    >>>.custom_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    >>>.custom_dropdown .v-input__control{
        min-height: 45px !important;
    }
</style>
