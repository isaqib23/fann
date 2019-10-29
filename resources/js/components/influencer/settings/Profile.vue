<template>
    <v-flex class="my-12 mx-auto card_wrapper">
        <div class="subtitle-1 mb-2 text-uppercase"><strong>Influender's Profile</strong></div>
        <v-card class="pa-6">
            <v-row class="mx-auto">
                <v-flex xl12 lg12 md12 sm12 sx12 class="mr-12">
                    <v-card-title>
                        <div class="subtitle-1 mb-2"><strong>Personal Details</strong></div>
                    </v-card-title>
                    <v-card-text>
                        <v-row justify="start">
                            <v-col cols="12" sm="3">
                                <image-input v-model="avatar">
                                    <div slot="activator">
                                        <v-avatar size="175px" v-ripple v-if="!avatar" class="grey lighten-3 mb-3" tile min-height="180" min-width="160" max-height="180" max-width="160">
                                            <v-img
                                                class="white--text align-end"
                                                src="/images/icons/user_placeholder.svg"
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
                                                :src="avatar.imageURL" alt="avatar">
                                            </v-img>
                                            <p class="placeholder_text pt-1 white--text" style="position: absolute">
                                                <v-icon class="body-2 d-inline white--text">mdi-camera</v-icon>
                                                <span class="caption">Upload Profile Picture</span>
                                            </p>
                                        </v-avatar>
                                    </div>
                                </image-input>
                            </v-col>
                            <v-col cols="12" sm="8">
                                <v-row justify="start">
                                    <v-col cols="12" sm="6" class="py-0">
                                        <label class="font-weight-bold">First Name</label>
                                        <v-text-field
                                            v-model="user.name"
                                            label="First Name"
                                            solo
                                            class="mt-1 custom_dropdown"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" class="py-0">
                                        <label class="font-weight-bold">Last Name</label>
                                        <v-text-field
                                            label="Last Name"
                                            solo
                                            class="mt-1 custom_dropdown"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row justify="start">
                                    <v-col cols="12" sm="6" class="py-0">
                                        <label class="font-weight-bold">Email</label>
                                        <v-text-field
                                            v-model="user.email"
                                            label="First Name"
                                            solo
                                            class="mt-1 custom_dropdown"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" class="py-0">
                                        <label class="font-weight-bold">Bio</label>
                                        <v-text-field
                                            label="Write About Yourself"
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
                                    solo
                                    class="mt-1 custom_dropdown"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4" class="py-0">
                                <label class="font-weight-bold">Niche</label>
                                <v-select
                                    :items="items"
                                    label="Health & fitness"
                                    solo
                                    class="custom_dropdown"
                                    append-icon="keyboard_arrow_down"
                                ></v-select>
                            </v-col>
                        </v-row>

                        <v-row justify="start">
                            <v-col cols="12" sm="4" class="py-0">
                                <label class="font-weight-bold">Phone</label>
                                <v-text-field
                                    label="123456789"
                                    solo
                                    class="mt-1 custom_dropdown"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4" class="py-0">
                                <label class="font-weight-bold">Time Zone</label>
                                <v-text-field
                                    label="Europe"
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
                                    rows="7"
                                    class="custom_dropdown"
                                ></v-textarea>
                            </v-col>
                            <v-col cols="12" sm="4" class="py-0">
                                <label class="font-weight-bold">State</label>
                                <v-select
                                    :items="items"
                                    label="Islamabad"
                                    solo
                                    append-icon="keyboard_arrow_down"
                                    class="custom_dropdown"
                                ></v-select>
                                <label class="font-weight-bold">Country</label>
                                <v-select
                                    :items="items"
                                    label="Pakistan"
                                    solo
                                    class="custom_dropdown"
                                    append-icon="keyboard_arrow_down"
                                ></v-select>
                            </v-col>
                        </v-row>
                    </v-card-text>

                    <v-card-actions class="text-right float-right">
                        <v-btn class="caption mr-3 text-capitalize" large height="40" depressed>Back</v-btn>
                        <v-btn color="primary" class="caption text-capitalize" large height="40" depressed>Submit</v-btn>
                    </v-card-actions>
                </v-flex>
            </v-row>
        </v-card>
    </v-flex>
</template>

<script>
    import {mapGetters} from 'vuex'
    import ImageInput from '../../general/ImageInput';

    export default {
        components:{
            ImageInput: ImageInput
        },
        data: () => ({
            rules: [
                value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
            ],
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            user: {
                name: null,
                email: null,
            },
            avatar: null,
            saving: false,
            saved: false
        }),

        computed: mapGetters({
            auth: 'auth/user'
        }),

        mounted() {
            this.user = Object.assign(this.user, this.auth)
        },
        methods:{
            uploadImage() {
                this.saving = true;
                setTimeout(() => this.savedAvatar(), 1000)
            },
            savedAvatar() {
                this.saving = false;
                this.saved = true;
            }
        },
        watch:{
            avatar: {
                handler: function() {
                    this.saved = false
                },
                deep: true
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
