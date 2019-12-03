<template>
    <div>
        <v-card-title>
            <div class="subtitle-1 mb-2"><strong>Unboxing Product</strong></div>
        </v-card-title>
        <v-row class="mx-auto my-5">
            <v-flex xl2 lg2 md2 sm1 xs2>
                <v-list-item-avatar height="45" min-width="100%" width="100%" class="ma-0 field_icon">
                    <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg"></v-img>
                </v-list-item-avatar>
            </v-flex>
            <v-flex xl10 lg10 md10 sm11 xs10>
                <v-select
                    :items="items"
                    label="Instagram image post"
                    solo
                    dense
                    append-icon="keyboard_arrow_down"
                    class="custom_dropdown product_left_border"
                ></v-select>
            </v-flex>
        </v-row>
    </div>
</template>

<script>

    export default {
        props : {
            touchPoint : {},
            paymentMethod : {},
        },
        data ()  {
            return  {
                items                 : ['Foo', 'Bar', 'Fizz', 'Buzz'],
            }
        },
        mounted() {

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
    >>>.product_left_border .v-input__slot {
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .field_icon{
        border-radius: 0px;
        border-top-left-radius: 5px !important;
        border-bottom-left-radius: 5px !important;
    }
</style>
