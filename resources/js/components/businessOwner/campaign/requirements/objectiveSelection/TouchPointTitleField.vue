<template>
    <div>
        <v-text-field
            v-model="touchPoint.name"
            label="Create a unboxing video on youtube"
            solo
            dense
            :prepend-inner-icon="icon"
            class="custom_dropdown"
        ></v-text-field>
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
                icon      :null
            }
        },
        mounted () {
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
