<template>
    <v-flex>
        <v-dialog v-model="dialog" persistent max-width="30%" transition="slide-y-reverse-transition">
            <v-card>
                <v-toolbar dark color="primary" flat>
                    <v-toolbar-title>Credit Card Information</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn small icon @click.stop="show">
                        <v-icon>mdi-close-circle</v-icon>
                    </v-btn>
                </v-toolbar>
                <v-form ref="form" @submit.prevent="submit" lazy-validation>
                <v-card-text>
                        <inline-credit-card-field
                            v-model="card"
                            @change="onChange"
                        ></inline-credit-card-field>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        type="submit"
                        :loading="loading"
                        :disabled="valid"
                        color="primary"
                        class="mr-4 mb-4"
                    >
                        Submit
                    </v-btn>
                </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
    </v-flex>
</template>

<script>
    import {mapGetters} from 'vuex'
    import Form from '~/mixins/form'
    import axios from 'axios'
    import { api } from '~/config'

    export default {
        mixins: [Form],
        props: {
            dialog: { type: Boolean, default: false }
        },
        components: {
            InlineCreditCardField: () => import('vue-credit-card-field/src/Components/InlineCreditCardField'),
        },
        computed: {
            ...mapGetters({
                auth: 'auth/user'
            })
        },
        data: () => ({
            card: null,
            valid:true
        }),
        methods: {
            onChange() {
                this.valid = (arguments[0].input.valid) ? false : true;
                if(!this.valid){
                    this.card.expMonth = arguments[0].card.expMonth;
                    this.card.expYear = arguments[0].card.expYear;
                }
            },

            submit() {
                this.loading = true

                axios.post(api.path('setting.saveUserCard'), this.card)
                    .then(res => {
                        this.$toast.success('User Card added Successfully!');
                        this.$emit('updateDialog', false);
                    })
                    .catch(err => {
                        this.handleErrors(err.response.data.errors)
                    })
                    .then(() => {
                        this.loading = false
                    })
            },



            show() {
                this.$emit('updateDialog', false);
            }
        }
    }
</script>
