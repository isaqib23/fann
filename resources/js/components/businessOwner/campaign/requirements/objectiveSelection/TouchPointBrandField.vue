<template>
    <div>
        <v-row class="mx-auto my-1">
            <v-flex xl2 lg2 md2 sm1 xs2>
                <v-list-item-avatar height="50" min-width="100%" width="100%" class="ma-0 field_icon">
                    <img
                        :src="(userCompany !== null) ? '/images/'+userCompany.logo : ''"
                        @error="altImageSource($event)"
                    >
                </v-list-item-avatar>
            </v-flex>
            <v-flex xl10 lg10 md10 sm11 xs10>
                <v-select
                    :items="items"
                    v-model="touchPoint.productBrand"
                    label="User Company"
                    solo
                    dense
                    append-icon="keyboard_arrow_down"
                    class="brand_dropdown product_left_border"
                    item-text="name"
                    item-value="id"
                ></v-select>
            </v-flex>
        </v-row>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapMutations} from 'vuex';
    export default {
        props : {
            touchPoint    : {},
            paymentMethod : {},
        },
        data ()  {
            return  {
                items       : []
            }
        },
        computed: {
            ...mapGetters({
                userCompany: 'settings/userCompany',
            })
        },
        methods : {
            ...mapActions({
                getUserCompany              : 'settings/getUserCompany'
            }),
            altImageSource(event) {
                event.target.src = "/images/icons/company_placeholder.png"
            }
        },
        async mounted() {
            await this.getUserCompany();
            this.items.push(this.userCompany);
        }
    }
</script>

<style scoped>
    >>>.brand_dropdown .v-input__control{
        min-height: 50px !important;
    }
    >>>.brand_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    >>>.brand_dropdown .v-input__prepend-inner .v-input__icon, >>>.product_field .v-input__prepend-inner .v-input__icon{
        background: #EE6F6F;
        padding: 24px;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }
    >>>.brand_dropdown .v-input__prepend-inner .v-icon.v-icon, >>>.product_field .v-input__prepend-inner .v-icon.v-icon{
        color: #ffffff !important;
    }
    >>>.brand_dropdown .v-input__prepend-inner, >>>.product_field  .v-input__prepend-inner{
        margin-top: 0px !important;
        margin-left: -14px;
        margin-right: 10px;
    }
    >>>.brand_dropdown .v-input__control{
        min-height: 50px !important;
    }
    >>>.brand_dropdown .v-input__control > .v-input__slot{
        box-shadow: none !important;
        border: 1px solid #cccccc;
    }
    >>>.brand_dropdown .v-input__slot{
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
