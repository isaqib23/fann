<template>
    <v-row justify="center">
        <v-dialog
            v-model="fundDialog"
            max-width="290"
            persistent
            transition="slide-y-reverse-transition"
        >
            <v-card>
                <v-card-title class="headline text-center" prominent>
                    <v-icon color="red" class="mx-auto display-2 pa-3" style="border: 1px solid red; border-radius: 50%">mdi-exclamation</v-icon>
                </v-card-title>

                <v-card-text class="display-1 text-center mt-2">
                    Are you sure!
                </v-card-text>
                <v-card-text class="text-center">
                    {{ msg }}
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn
                        color="darken-1"
                        text
                        @click="cancel"
                    >
                        cancel
                    </v-btn>

                    <v-btn
                        color="green darken-1"
                        text
                        @click="agree"
                    >
                        agree
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>


    </v-row>
</template>

<script>
  export default {
    data: ()=> ({

    }),
    props: {
        fundDialog: { type: Boolean, default: false },
        msg: '',
        payment: null
    },
    methods: {
        cancel() {
            this.$emit('updateFundDialog', {status: false, payment: null});
        },
        agree() {
            this.$emit('updateFundDialog', {status: true, payment: this.payment});
        }
    }
  }
</script>
