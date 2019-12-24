<template>
    <v-flex class="my-12 mx-auto card_wrapper">
        <div class="subtitle-1 mb-2 text-uppercase"><strong>Business Profile</strong></div>
        <v-card class="pa-6">
            <v-row class="mx-auto">
                <v-form ref="form" @submit.prevent="submit" enctype="multipart/form-data" lazy-validation v-model="valid">
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
                                        v-model="user.first_name"
                                        :label="labels.first_name"
                                        solo
                                        class="mt-1 custom_dropdown"
                                        :error-messages="errors.first_name"

                                        :disabled="loading"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Last Name</label>
                                    <v-text-field
                                        v-model="user.last_name"
                                        :label="labels.last_name"
                                        solo
                                        class="mt-1 custom_dropdown"
                                        :error-messages="errors.last_name"

                                        :disabled="loading"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="4">
                                <label class="font-weight-bold">Email</label>
                                <v-text-field
                                    v-model="user.email"
                                    :label="labels.email"
                                    solo
                                    class="mt-1 custom_dropdown"
                                    :error-messages="errors.email"

                                    :disabled="loading"
                                ></v-text-field>
                            </v-col>
                            </v-row>

                            <div class="subtitle-1 mb-2 black--text"><strong>Company Details</strong></div>
                            <v-row>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Upload Logo</label>

                                    <image-input v-model="file">
                                        <div slot="activator">
                                            <v-avatar size="175px" v-ripple v-if="!file.imageURL" class="mb-3" tile min-height="180" min-width="160" max-height="180" max-width="160">
                                                <img src="/images/icons/company_placeholder.png">
                                            </v-avatar>
                                            <v-avatar size="175px" v-else class="mb-3" tile min-height="180" min-width="160" max-height="180" max-width="160">
                                                <v-img
                                                    class="white--text align-end"
                                                    :src="file.imageURL"
                                                    alt="avatar"
                                                >
                                                </v-img>
                                            </v-avatar>
                                        </div>
                                    </image-input>
                                </v-col>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Name</label>
                                    <v-text-field
                                        :label="labels.name"
                                        solo
                                        class="mt-1 custom_dropdown"
                                        v-model="user.userCompany.name"
                                        :error-messages="errors['userCompany.name']"

                                        :disabled="loading"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                            <v-row justify="start">
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Website</label>
                                    <v-text-field
                                        label="www.abc.com"
                                        solo
                                        class="mt-1 custom_dropdown"
                                        v-model="user.userCompany.website"
                                        :error-messages="errors['userCompany.website']"

                                        :disabled="loading"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Niche</label>
                                    <v-autocomplete
                                        :items="niches"
                                        label="Health & fitness"
                                        solo
                                        class="custom_dropdown"
                                        append-icon="keyboard_arrow_down"
                                        v-model="user.userCompany.niche_id"
                                        :error-messages="errors['userCompany.niche_id']"

                                        :disabled="loading"
                                        item-text="name"
                                        item-value="id"
                                    ></v-autocomplete>
                                </v-col>
                            </v-row>

                            <v-row justify="start">
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Phone</label>
                                    <v-text-field
                                        label="123456789"
                                        solo
                                        class="mt-1 custom_dropdown"
                                        v-model="user.userCompany.phone"
                                        :error-messages="errors['userCompany.phone']"

                                        :disabled="loading"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Time Zone</label>
                                    <v-text-field
                                        label="Europe"
                                        solo
                                        class="mt-1 custom_dropdown"
                                        v-model="user.userCompany.timezone"
                                        :error-messages="errors['userCompany.timezone']"

                                        :disabled="loading"
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
                                        v-model="user.userCompany.address"
                                        :error-messages="errors['userCompany.address']"

                                        :disabled="loading"
                                    ></v-textarea>
                                </v-col>
                                <v-col cols="12" sm="4">
                                    <label class="font-weight-bold">Country</label>
                                    <v-autocomplete
                                        :items="countries"
                                        v-model="user.userCompany.country_id"
                                        label="Pakistan"
                                        solo
                                        class="custom_dropdown"
                                        append-icon="keyboard_arrow_down"
                                        item-text="name"
                                        @change="getStates({'country_id':$event})"
                                        item-value="id"
                                        :error-messages="errors['userCompany.country_id']"

                                        :disabled="loading"
                                    ></v-autocomplete>
                                    <label class="font-weight-bold">State</label>
                                    <v-autocomplete
                                        :items="states"
                                        v-model="user.userCompany.state_id"
                                        label="Islamabad"
                                        solo
                                        append-icon="keyboard_arrow_down"
                                        class="custom_dropdown"
                                        item-text="name"
                                        item-value="id"
                                        :error-messages="errors['userCompany.state_id']"

                                        :disabled="loading"
                                    ></v-autocomplete>
                                </v-col>
                            </v-row>
                        </v-card-text>

                        <v-card-actions class="text-right float-right">
                            <v-btn class="caption mr-3 text-capitalize" large>Button</v-btn>
                            <v-btn
                                type="submit"
                                color="primary"
                                class="caption text-capitalize"
                                large
                            >Submit</v-btn>
                        </v-card-actions>
                    </v-flex>
                </v-form>
            </v-row>
        </v-card>
    </v-flex>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    import Form from '~/mixins/form'
    import ImageInput from '../../general/ImageInput';
    export default {
        mixins: [Form],
        components:{
            ImageInput: ImageInput
        },
        data: () => ({
            rules: [
                value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
            ],

            user: {
                first_name: null,
                last_name: null,
                email: null,
                userCompany: {
                    name: null,
                    website: null,
                    phone: null,
                    niche_id:null,
                    country_id:null,
                    timezone:null,
                    state_id:null,
                    address:null,
                    logo:null,
                }

            },
            file: {
                imageFile: null,
                imageURL: null
            },
        }),

        computed: {
            ...mapGetters({
                auth: 'auth/user',
                countries: 'settings/countries',
                states: 'settings/states',
                niches: 'settings/niches',
                userCompany: 'settings/userCompany',
            })
        },
        methods: {
            ...mapActions({
                getCountries: 'settings/getCountries',
                getStates: 'settings/getStates',
                updateProfile: 'settings/updateProfile',
                getNiches: 'settings/getNiches',
                getUserCompany: 'settings/getUserCompany'
            }),
            getLogo() {
                this.file =  Object.assign(this.file, {"imageURL":'/images/'+this.userCompany.logo});
            },
            async submit() {
                if (this.$refs.form.validate()) {
                    this.loading = true
                    this.user.userCompany = this.userCompany;
                    let formData = new FormData();
                    formData.append("user", JSON.stringify(this.user));
                    formData.append("logo", this.file.imageFile);

                    let response = await this.updateProfile(formData);
                    if (response.status === 200) {
                        this.$toast.success('Your profile successfully updated.')
                    } else {

                        this.handleErrors(response.details)
                    }
                    this.loading = false
                }
            }
        },
        created() {
            console.log(this.user,"data");
            this.form = Object.assign(this.user);
        },
        async mounted() {
            this.user = Object.assign(this.user, this.auth);
            await this.getUserCompany();
            await this.getCountries();
            await this.getNiches();
            if(this.userCompany.state_id !== null) {
                await this.getStates(this.userCompany);
                this.getLogo();
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
