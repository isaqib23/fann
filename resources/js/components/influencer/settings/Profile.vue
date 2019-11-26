<template>
    <v-flex class="my-12 mx-auto card_wrapper">
        <div class="subtitle-1 mb-2 text-uppercase"><strong>Influencer's Profile</strong></div>
        <v-card class="pa-6">
            <v-row class="mx-auto">
                <v-flex xl12 lg12 md12 sm12 sx12 class="mr-12">
                    <v-form ref="form" @submit.prevent="submit" enctype="multipart/form-data">
                        <v-card-title>
                            <div class="subtitle-1 mb-2"><strong>Personal Details</strong></div>
                        </v-card-title>
                        <v-card-text>
                            <v-row justify="start">
                                <v-col cols="12" sm="3">
                                    <image-input v-model="file">
                                        <div slot="activator">
                                            <v-avatar size="175px" v-ripple v-if="!file.imageURL" class="grey lighten-3 mb-3" tile min-height="180" min-width="160" max-height="180" max-width="160">
                                                <v-img
                                                    class="white--text align-end"
                                                    src="/images/icons/user_placeholder.png"
                                                >
                                                    <p class="placeholder_text pt-1 white--text">
                                                        <v-icon class="body-2 d-inline white--text">mdi-camera</v-icon>
                                                        <span class="caption">Upload Profile Picture</span>
                                                    </p>
                                                </v-img>
                                            </v-avatar>
                                            <v-avatar size="175px" v-else class="mb-3" tile min-height="180" min-width="160" max-height="180" max-width="160">
                                                <v-img
                                                    class="white--text align-end"
                                                    :src="file.imageURL" alt="avatar">
                                                    <p class="placeholder_text pt-1 white--text">
                                                        <v-icon class="body-2 d-inline white--text">mdi-camera</v-icon>
                                                        <span class="caption">Change Profile Picture</span>
                                                    </p>
                                                </v-img>
                                            </v-avatar>
                                        </div>
                                    </image-input>
                                </v-col>
                                <v-col cols="12" sm="8">
                                    <v-row justify="start">
                                        <v-col cols="12" sm="6" class="py-0">
                                            <label class="font-weight-bold">First Name</label>
                                            <v-text-field
                                                v-model="form.first_name"
                                                label="First Name"
                                                solo
                                                class="mt-1 custom_dropdown"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" class="py-0">
                                            <label class="font-weight-bold">Last Name</label>
                                            <v-text-field
                                                label="Last Name"
                                                v-model="form.last_name"
                                                solo
                                                class="mt-1 custom_dropdown"
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row justify="start">
                                        <v-col cols="12" sm="6" class="py-0">
                                            <label class="font-weight-bold">Email</label>
                                            <v-text-field
                                                v-model="form.email"
                                                label="First Name"
                                                solo
                                                class="mt-1 custom_dropdown"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" class="py-0">
                                            <label class="font-weight-bold">Bio</label>
                                            <v-text-field
                                                label="Write About Yourself"
                                                v-model="userDetail.bio"
                                                solo
                                                class="mt-1 custom_dropdown"
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-col>
                            </v-row>

                            <v-row justify="start">
                                <v-col cols="12" sm="4" class="py-0">
                                    <label class="font-weight-bold">Website</label>
                                    <v-text-field
                                        label="www.abc.com"
                                        v-model="userDetail.website"
                                        solo
                                        class="mt-1 custom_dropdown"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="4" class="py-0">
                                    <label class="font-weight-bold">Niche</label>
                                    <v-select
                                        :items="niches"
                                        label="Health & fitness"
                                        v-model="userDetail.niche_id"
                                        solo
                                        class="custom_dropdown"
                                        append-icon="keyboard_arrow_down"
                                        item-text="name"
                                        item-value="id"
                                    ></v-select>
                                </v-col>
                            </v-row>

                            <v-row justify="start">
                                <v-col cols="12" sm="4" class="py-0">
                                    <label class="font-weight-bold">Phone</label>
                                    <v-text-field
                                        label="123456789"
                                        v-model="userDetail.phone"
                                        solo
                                        class="mt-1 custom_dropdown"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="4" class="py-0">
                                    <label class="font-weight-bold">Time Zone</label>
                                    <v-text-field
                                        label="Europe"
                                        v-model="userDetail.timezone"
                                        solo
                                        class="mt-1 custom_dropdown"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row justify="start">
                                <v-col cols="12" sm="4" class="py-0">
                                    <label class="font-weight-bold">Business Address</label>
                                    <v-textarea
                                        solo
                                        name="input-7-4"
                                        label="Solo textarea ......"
                                        v-model="userDetail.address"
                                        rows="7"
                                        class="custom_dropdown"
                                    ></v-textarea>
                                </v-col>
                                <v-col cols="12" sm="4" class="py-0">
                                    <label class="font-weight-bold">Country</label>
                                    <v-autocomplete
                                        :items="countries"
                                        label="Pakistan"
                                        solo
                                        class="custom_dropdown"
                                        append-icon="keyboard_arrow_down"
                                        v-model="userDetail.country_id"
                                        item-text="name"
                                        @change="getStates(userDetail)"
                                        item-value="id"
                                    ></v-autocomplete>
                                    <label class="font-weight-bold">State</label>
                                    <v-autocomplete
                                        :items="states"
                                        label="Islamabad"
                                        solo
                                        append-icon="keyboard_arrow_down"
                                        v-model="userDetail.state_id"
                                        class="custom_dropdown"
                                        item-text="name"
                                        item-value="id"
                                    ></v-autocomplete>
                                </v-col>
                            </v-row>
                        </v-card-text>

                        <v-card-actions class="text-right float-right">
                            <v-btn class="caption mr-3 text-capitalize" large height="40" depressed>Back</v-btn>
                            <v-btn type="submit" :loading="loading" color="primary" class="caption text-capitalize" large height="40" depressed>Submit</v-btn>
                        </v-card-actions>
                    </v-form>
                </v-flex>
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
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            form: {
                first_name: null,
                last_name: null,
                email: null,
            },
            file: {
                imageFile: null,
                imageURL: null
            },
            saving: false,
            saved: false
        }),

        computed: mapGetters({
            auth: 'auth/user',
            countries: 'settings/countries',
            states: 'settings/states',
            niches: 'settings/niches',
            userDetail: 'settings/userDetail',
        }),
        methods:{
            ...mapActions({
                getCountries: 'settings/getCountries',
                getStates: 'settings/getStates',
                getNiches: 'settings/getNiches',
                getUserDetail: 'settings/getUserDetail',
                saveUserDetail: 'settings/saveUserDetail'
            }),
            getLogo(){
                this.file =  Object.assign(this.file, {"imageURL":'/images/'+this.userDetail.picture});
            },
            async submit() {
                this.loading = true
                this.form.userDetail = this.userDetail;
                let formData = new FormData();
                formData.append("user", JSON.stringify(this.form));
                formData.append("logo", this.file.imageFile);

                let response = await this.saveUserDetail(formData);
                if(response !== undefined) {
                    this.$toast.success('Your profile successfully updated.')
                }
                this.loading = false

            }
        },
        async mounted() {
            this.form = Object.assign(this.form, this.auth);
            await this.getUserDetail();
            await this.getCountries();
            await this.getNiches();
            if(this.userDetail.state_id !== null) {
                await this.getStates(this.userDetail.country_id);
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
    >>>.placeholder_text{
        background: rgb(117,119,120);
        background: -moz-linear-gradient(90deg, rgba(117,119,120,0.8827906162464986) 100%, rgba(117,119,120,1) 100%);
        background: -webkit-linear-gradient(90deg, rgba(117,119,120,0.8827906162464986) 100%, rgba(117,119,120,1) 100%);
        background: linear-gradient(90deg, rgba(117,119,120,0.8827906162464986) 100%, rgba(117,119,120,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#757778",endColorstr="#757778",GradientType=1);
        height: 30px;
        width: 100%;
        margin: 0 auto;
        margin-top: 145px;
    }
</style>
