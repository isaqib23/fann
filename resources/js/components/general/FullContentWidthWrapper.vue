<template>
    <div class="fill-height appBG">
        <app-nav :mini="mini" @nav-toggle="navToggle"></app-nav>
        <top-menu @nav-toggle="navToggle"></top-menu>
        <v-content fluid>
                <transition name="fade" mode="out-in">
                    <router-view></router-view>
                </transition>

                <chat-box
                    class="float-right checker"
                    v-for="(box, boxIndex) in listOfChatBox"
                    :key="boxIndex"
                    :propItem="box"
                    :minBottom="(3 - boxIndex)*(3 - boxIndex) * 20"
                    v-on:close-window="closeWindow"
                    :style="$vuetify.breakpoint.smAndUp ? {right: boxIndex*19 +'%'} : {right: boxIndex*0 +'%'}"
                >
                </chat-box>
        </v-content>
        <app-footer></app-footer>
    </div>
</template>

<script>
    import AppNav from '../businessOwner/shared/AppNav'
    import TopMenu from '../businessOwner/shared/TopMenu'
    import AppFooter from '../businessOwner/shared/AppFooter'
    import { mapGetters,mapActions } from "vuex";
    import chatBox from  '../general/ChatWindow';

    export default {
        data: () => ({
            mini: false,
            listOfChatBox  : []
        }),
        components: {
            AppNav,
            TopMenu,
            AppFooter,
            chatBox,
        },
        mounted() {
            this.chatBoxes();
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
            navToggle() {
                this.mini = !this.mini
            },
            chatBoxes() {
                this.listOfChatBox = this.chatBox;
            },
            closeWindow(e) {
                let toRemove = _.findIndex(this.listOfChatBox, function (obj) {
                    return obj.id === e.chatBox.id;
                });

                this.deleteChatBox(toRemove)
            }
        }
    }
</script>
<style scoped>
    .checker{
        bottom: 0;
        position: fixed;
        max-width:18%;
        flex: 0 0 18%;
    }
    >>>.chatbox_min {
        margin-bottom: -285px;
    }
    >>>.chatbox_min .chatbox-avatar {
        width:50px;
        height:50px;
    }
    >>>.chatbox_min .chat-box-title {
        padding:0 0 0 75px;
    }

</style>
