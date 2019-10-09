<template>
    <div class="tabs_div">
        <!--<v-tab >
            Setup
            <v-icon left>mdi-settings</v-icon>
        </v-tab>-->
        <v-tab >
            Create
            <v-icon left>mdi-account-plus</v-icon>
        </v-tab>
        <v-tab>
            invite
            <v-icon left>mdi-lock</v-icon>
        </v-tab>
        <v-tab>
            promote
            <v-icon left>mdi-access-point</v-icon>
        </v-tab>
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
    >>>.v-tabs-items, >>>.v-card{
        background-color:#F7F7FF !important;
    }
    >>>.v-card{
        box-shadow:none !important;
    }


</style>
