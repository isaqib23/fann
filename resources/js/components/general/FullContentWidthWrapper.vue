<template>
    <div class="fill-height appBG">
        <app-nav :mini="mini" @nav-toggle="navToggle"></app-nav>
        <top-menu @nav-toggle="navToggle"></top-menu>
        <v-content fluid>
                <transition name="fade" mode="out-in">
                    <router-view></router-view>

                </transition>
<!--            <v-layout row wrap align-end justify-end class="chatbox-holder">-->
                <chatWindow
                    class="col-md-3 float-right checker"
                    v-for="(box, boxIndex) in listOfChatBox"
                    :key="boxIndex"
                    :propItem="box"
                    v-on:close-window="closeWindow"
                >
                </chatWindow>
<!--            </v-layout>-->
        </v-content>

        <app-footer></app-footer>
    </div>
</template>

<script>
    import AppNav from '../businessOwner/shared/AppNav'
    import TopMenu from '../businessOwner/shared/TopMenu'
    import AppFooter from '../businessOwner/shared/AppFooter'
    import { mapGetters,mapActions } from "vuex";
    import chatWindows from "./ChatWindow";
    import chatBox from  '../general/ChatWindow';

    export default {
        data: () => ({
            mini: false,
            listOfChatBox  : [],
            positioning: 0,
        }),
        components: {
            chatWindow : chatBox,
            AppNav,
            TopMenu,
            AppFooter
        },

        computed : {
            ...mapGetters({
                chatBox : 'campaign/chatBox'
            }),

        },
        methods: {
            ...mapActions({
                deleteChatBox : 'campaign/deleteChatBox'
            }),
            closeWindow(e) {
                let toRemove = _.findIndex(this.listOfChatBox, function (obj) {
                    return obj.id === e.chatBox.id;
                });

                this.deleteChatBox(toRemove)
            },
            navToggle() {
                this.mini = !this.mini
            }
        },
        watch: {
            chatBox: function (val) {

                this.listOfChatBox = val;
                this.positioning= this.positioning+25;
            }
        }
    }
</script>
<style scoped>
    .checker{
        bottom: 0;
        position: fixed;
    }
    >>>.chatbox-holder {
        right:0;
        bottom:0;
        position:fixed;
        width:50%;
    }
    >>>.chatbox_min {
        margin-bottom: -300px;
    }
    >>>.chatbox_min .chatbox-avatar {
        width:50px;
        height:50px;
    }
    >>>.chatbox_min .chat-box-title {
        padding:0 0 0 75px;
    }

</style>
