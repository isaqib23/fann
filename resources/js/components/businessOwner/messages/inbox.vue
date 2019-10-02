<template>
    <v-col cols="12" md="10" class="pa-0">
        <v-row justify="start">
            <v-col cols="12" md="4" class="vertical_border py-5 pr-0">
                <v-text-field
                    solo
                    label="Search Message or Name"
                    prepend-inner-icon="search"
                    class="search_fields"
                ></v-text-field>

                <v-list two-line class="top_border">
                    <template v-for="(item, index) in items">
                        <v-divider></v-divider>
                        <v-list-item :key="item.title" :class="item.activeClass" @click="">
                            <v-list-item-avatar>
                                <v-img :src="item.avatar"></v-img>
                            </v-list-item-avatar>

                            <v-list-item-content>
                                <v-list-item-title>
                                    {{item.title}}
                                    <span class="float-right caption font-weight-bold">Jan 5</span>
                                </v-list-item-title>
                                <v-list-item-subtitle v-html="item.subtitle"></v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-list>
            </v-col>
            <v-col cols="12" md="8" class="py-5 px-7">
                <div class="mail_header bottom_border mr-n4 ml-n7 pl-7 pr-4">
                    <div class="subtitle-1 mb-2">
                        <v-chip color="primary" class="mr-5">Fashion</v-chip>
                        <strong>Brunch this weekend?</strong>
                        <v-icon class="float-right">keyboard_arrow_down</v-icon>
                    </div>
                    <v-list-item>
                        <v-list-item-avatar>
                            <v-list-item-avatar class="mr-1">
                                <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg"></v-img>
                            </v-list-item-avatar>
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title class="body-2 font-weight-bold">Our Changing Planet
                                <span class="float-right caption font-weight-bold">25 August</span>
                            </v-list-item-title>
                            <v-list-item-subtitle>to <strong class="black--text">me</strong></v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </div>
                <div class="mail_content pa-8 body-2 gray--text">
                    <div>
                        Hey David,<br>
                        <br>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                </div>
                <div class="reply_box">
                    <v-textarea
                        filled
                        name="input-7-4"
                        label="Click here to Reply"
                    ></v-textarea>
                </div>
            </v-col>
        </v-row>
    </v-col>
</template>

<script>
import Proposal from '../popups/Proposal'
import TouchPoint from '../popups/TouchPoint'

    export default {
        components: {
            Proposal:Proposal,
            TouchPoint:TouchPoint
        },
        data: () => {
           return  {
               items: [
                   {
                       avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
                       title: 'Brunch this weekend?',
                       subtitle: "I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
                       activeClass: 'primary_border'
                   },
                   {
                       avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
                       title: 'Brunch this weekend?',
                       subtitle: "I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
                       activeClass: ''
                   },
                   {
                       avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
                       title: 'Brunch this weekend?',
                       subtitle: "I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
                       activeClass: 'warning_border'
                   },
                   {
                       avatar: 'https://cdn.vuetifyjs.com/images/lists/4.jpg',
                       title: 'Brunch this weekend?',
                       subtitle: "I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
                       activeClass: ''
                   },
                   {
                       avatar: 'https://cdn.vuetifyjs.com/images/lists/5.jpg',
                       title: 'Brunch this weekend?',
                       subtitle: "I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
                       activeClass: ''
                   },
                   {
                       avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
                       title: 'Brunch this weekend?',
                       subtitle: "I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
                       activeClass: 'warning_border'
                   },
                   {
                       avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
                       title: 'Brunch this weekend?',
                       subtitle: "I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
                       activeClass: ''
                   },
                   {
                       avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
                       title: 'Brunch this weekend?',
                       subtitle: "I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
                       activeClass: ''
                   },
                   {
                       avatar: 'https://cdn.vuetifyjs.com/images/lists/4.jpg',
                       title: 'Brunch this weekend?',
                       subtitle: "I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
                       activeClass: 'accent_border'
                   },
                   {
                       avatar: 'https://cdn.vuetifyjs.com/images/lists/5.jpg',
                       title: 'Brunch this weekend?',
                       subtitle: "I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
                       activeClass: ''
                   }
               ]
            }
        },
        methods: {}
    }
</script>

<style scoped>
    >>>.search_fields .v-input__slot{
        box-shadow: none !important;
    }
    >>>.search_fields .v-text-field__details {
        display: none;
    }
    .primary_border{
        border-left: 2px solid #EE6F6F !important;
    }
    .accent_border{
        border-left: 2px solid #403C79 !important;
    }
    .warning_border{
        border-left: 2px solid #FFC107 !important;
    }
    .vertical_border {
        border-right: 1px solid #EDEDED !important;
    }
    .top_border {
        border-top: 1px solid #EDEDED !important;
    }
    .bottom_border {
        border-bottom: 1px solid #EDEDED !important;
    }
</style>
