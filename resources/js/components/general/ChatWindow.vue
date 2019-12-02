<template>
    <!--v-if="showChatWindow"-->
    <div :class="{ chatbox_min: isMinimize }" >
<!--        <v-layout row wrap align-end justify-end>-->

<!--            <v-flex lg2>-->
                <v-card class="mt-auto">
                    <v-list-item>
                        <v-list-item-avatar
                            height="50"
                            width="50"
                        >
                            <v-img :src="this.propItem.avatar" :tile="false"></v-img>
                        </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title>
                                    <strong>{{ this.propItem.title }}</strong>
                                </v-list-item-title>
                                <v-list-item-subtitle>
                                    {{type}}
                                </v-list-item-subtitle>
                            </v-list-item-content>
                            <v-btn text icon @click="minimize">
                                <v-icon>minimize</v-icon>
                            </v-btn>
                            <v-btn text icon @click.stop="closeWindow">
                                <v-icon>clear</v-icon>
                            </v-btn>
                    </v-list-item>

                    <v-divider></v-divider>

                    <div class="pa-5" style="height:200px;overflow:auto;">
                        <div class="d-block  col-md-4 pa-2  my-message accent-4 white--text" v-for="me in messages">
                            {{ me.msg }}</div>
                        <div class="d-block col-md-4  pa-2  message black--text" style="float:right">their</div>
                    </div>

                    <v-divider></v-divider>

                    <v-card-text style="height:20px;">
                        <v-text-field
                            v-model="textMsg"
                            placeholder="Type your message here..."
                            single-line
                            background-color="white"
                            flat
                            full-width
                            class="userinput input-field input-color"
                            :light="true"
                            ref="input"

                        >
                        </v-text-field>
                   </v-card-text>
                    <v-card-text>
                        <v-btn icon class="input-icons input-color">
                            <v-icon>attachment</v-icon>
                        </v-btn>
                        <v-btn icon class="input-icons input-color">
                            <v-icon>local_movies</v-icon>
                        </v-btn>
                        <v-btn icon class="input-icons input-color">
                            <v-icon>tag_faces</v-icon>
                        </v-btn>
                        <v-btn icon class="input-icons input-color" style="float:right;" @click="sendMsg">
                            <v-icon>send</v-icon>
                        </v-btn>
                    </v-card-text>
                 </v-card>
<!--            </v-flex>-->
<!--        </v-layout>-->
    </div>
</template>
<script>
    export default{

        props:{
            propItem:{},
            // showChatWindow:{},
            header : {},
            item : ''
        },
        mounted(){
            console.info(this.propItem.title)
        },
        data(){
            return {
                textMsg : '',
                messages : [
                    {
                        msg:'first message'
                    }
                        ],
                avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
                title: 'Brunch',
                type: 'influncer',
                isMinimize : false,
                theirMessage : []

            }
        },
        methods:{
            sendMsg(){
                 this.messages.push({
                     msg: this.textMsg,
                 });
                this.textMsg = '';
                this.$refs['input'].innerHTML = ''
            },

            minimize(){
                this.isMinimize = !this.isMinimize ;
            },
            closeWindow(){

                this.$emit('close-window',{

                    'chatBox' : this.propItem
                    // 'showChatWindow' : !this.showChatWindow,
                })
            }
      }
    }
</script>
<style scoped>
    >>>.my-message{
        background-color:#4e8cff !important;
        border-radius:10px !important;
    }
    >>>.message{
        border-radius:10px !important;
        background-color: #eaeaea !important;
    }
    >>>.input-field.v-input input{
        max-height:0px !important;
        padding-bottom: 10px !important;
    }
    >>>.input-icons{
        height:30px !important;
        width:30px !important;
    }
    >>>.input-icons .v-icon{
        font-size: 20px !important;
    }
    >>>.input-color{
        color:#1473e6 !important;
    }
    >>>::placeholder{
        color:#1473e6 !important;
    }
</style>
