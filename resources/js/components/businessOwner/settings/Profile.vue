<template>
    <v-flex class="my-12 mx-auto card_wrapper">
        <div class="subtitle-1 mb-2"><strong>Business Profile</strong></div>
        <v-card class="pa-6">
            <v-row class="mx-auto">
                <v-flex xl12 lg12 md12 sm12 sx12 class="mr-12">
                    <v-card-title>
                        <div class="subtitle-1 mb-2"><strong>Business Profile</strong></div>
                    </v-card-title>
                    <v-card-text>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum maiores modi quidem veniam, expedita quis laboriosam, ullam facere adipisci, iusto, voluptate sapiente corrupti asperiores rem nemo numquam fuga ab at.</p>

                        <div class="subtitle-1 mb-2"><strong>Personal Business</strong></div>
                        <v-row>
                            <v-col cols="12" sm="4">
                                <label class="font-weight-bold">First Name</label>
                                <v-text-field
                                    v-model="user.name"
                                    label="First Name"
                                    solo
                                    class="mt-1"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <label class="font-weight-bold">Last Name</label>
                                <v-text-field
                                    label="Last Name"
                                    solo
                                    class="mt-1"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <label class="font-weight-bold">Email</label>
                                <v-text-field
                                    v-model="user.email"
                                    label="First Name"
                                    solo
                                    class="mt-1"
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <div class="subtitle-1 mb-2"><strong>Company Details</strong></div>
                        <v-row>
                            <v-col cols="12" sm="4">
                                <label class="font-weight-bold">Upload Logo</label>
                                <v-file-input
                                    :rules="rules"
                                    accept="image/png, image/jpeg, image/bmp"
                                    placeholder="Pick an Company Logo"
                                    prepend-icon="mdi-camera"
                                    label="Company Logo"
                                ></v-file-input>
                            </v-col>
                        </v-row>

                        <v-row justify="start">
                            <v-col cols="12" sm="4">
                                <label class="font-weight-bold">Website</label>
                                <v-text-field
                                    label="www.abc.com"
                                    solo
                                    class="mt-1"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <label class="font-weight-bold">Niche</label>
                                <v-select
                                    :items="items"
                                    label="Health & fitness"
                                    solo
                                ></v-select>
                            </v-col>
                        </v-row>

                        <v-row justify="start">
                            <v-col cols="12" sm="4">
                                <label class="font-weight-bold">Phone</label>
                                <v-text-field
                                    label="123456789"
                                    solo
                                    class="mt-1"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <label class="font-weight-bold">Time Zone</label>
                                <v-text-field
                                    label="Europe"
                                    solo
                                    class="mt-1"
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
                                ></v-textarea>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <label class="font-weight-bold">State</label>
                                <v-select
                                    :items="items"
                                    label="Islamabad"
                                    solo
                                ></v-select>
                                <label class="font-weight-bold">Country</label>
                                <v-select
                                    :items="items"
                                    label="Pakistan"
                                    solo
                                ></v-select>
                            </v-col>
                        </v-row>
                    </v-card-text>

                    <v-card-actions class="text-right float-right">
                        <v-btn class="caption mr-3" large>Button</v-btn>
                        <v-btn color="primary" class="caption" large>Submit</v-btn>
                    </v-card-actions>
                </v-flex>
            </v-row>
        </v-card>
    </v-flex>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        data: () => ({
            rules: [
                value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
            ],
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            user: {
                name: null,
                email: null,
            }
        }),

        computed: mapGetters({
            auth: 'auth/user'
        }),

        mounted() {
            this.user = Object.assign(this.user, this.auth)
        }
    }
</script>
<style scoped>
    .card_wrapper{
        width: 90%;
    }
</style>
