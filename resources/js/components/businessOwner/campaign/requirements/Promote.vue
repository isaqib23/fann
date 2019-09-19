<template>
    <div>
        <v-flex class="ma-12">
            <v-card class="mx-auto card_wrapper">
                <v-row class="py-12 mx-auto main_wrapper">
                    <v-flex lg12 sm12 m12>
                        <div class="subtitle-2 mb-2"><strong>Brand Mention</strong></div>
                        <div class="overline mb-2">Seperate with (,)</div>
                        <v-text-field
                            outlined
                            label="Nike,Nuchey"
                            prepend-icon="@"
                            class="tag_field"
                        ></v-text-field>
                    </v-flex>
                </v-row>
            </v-card>
        </v-flex>
    </div>
</template>

<script>

    export default {
        components: {

        },
        data: () => {
           return  {

            }
        },
        methods: {}
    }
</script>

<style scoped>
    .main_wrapper, .card_wrapper{
        width: 85%;
    }
    >>>.card_wrapper .v-badge__badge{
        margin-top: 20px !important;
        padding: 15px;
        border-radius: 50px;
        height:auto !important;
    }
    >>>.v-sheet{
        border-bottom-left-radius: 0px !important;
        border-bottom-right-radius: 0px !important;
    }
    >>>.gutterDark.v-sheet{
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
    >>>.v-rating .v-icon{
        padding:0px;
    }
    .inner_wrapper{
        max-width: 55% !important;
        float: left !important;
    }
    .image_wrapper{
        max-width: 17% !important;
        float: left !important;
    }
    .icons .custom_icon{
        padding: 4px 2px;
        border-radius: 50px;
        height: auto !important;
        background: #FDE0E1;
        border: 3px solid #fff;
        -webkit-box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.2);
        -moz-box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.2);
        box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.2);
    }
    .icons .custom_icon:nth-child(2) {
        background: #D8CEFD;
    }
    .icons .custom_icon:nth-child(3) {
        background: #FEF7DA;
    }
    .overline1{
        font-size: 11px;
    }
    .overline1 .custom_icon{
        padding: 8px 4px !important;
        border-radius: 50px;
        height: auto !important;
        background: #FDE0E1;
        border: none;
        box-shadow: none;
    }
    >>>.v-btn {
        font-size: 10px !important;
    }
    .action_class {
        border-top: 1px solid #ccc;
    }
</style>
