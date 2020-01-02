<template>
    <div class="fill-height appBG">
        <app-nav :mini="mini" @nav-toggle="navToggle"></app-nav>
        <top-menu @nav-toggle="navToggle"></top-menu>

        <v-content>
            <v-container fluid class="elevated pa-5">
                <transition name="fade" mode="out-in">
                    <router-view></router-view>
                </transition>
                <chatWindow
                    class="float-right checker"
                    v-for="(box, boxIndex) in listOfChatBox"
                    :key="boxIndex"
                    :propItem="box"
                    :minBottom="(3 - boxIndex)*(3 - boxIndex) * 20"
                    v-on:close-window="closeWindow"
                    :style="$vuetify.breakpoint.smAndUp ? {right: boxIndex*19 +'%'} : {right: boxIndex*0 +'%'}"
                >
                </chatWindow>
            </v-container>
        </v-content>

        <app-footer></app-footer>
    </div>
</template>

<script>
import AppNav from './shared/AppNav'
import TopMenu from './shared/TopMenu'
import AppFooter from './shared/AppFooter'
import { mapGetters,mapActions } from "vuex";
import chatBox from  '../general/ChatWindow';

export default {
    data: () => ({
        mini: false,
        listOfChatBox  : []
    }),
    components: {
        chatWindow : chatBox,
        AppNav,
        TopMenu,
        AppFooter
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
        chatBoxes(){
            this.listOfChatBox = this.chatBox;
        },
        closeWindow(e) {
            let toRemove = _.findIndex(this.listOfChatBox, function (obj) {
                return obj.id === e.chatBox.id;
            });

            this.deleteChatBox(toRemove)
        },
        navToggle() {
            this.mini = !this.mini
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

