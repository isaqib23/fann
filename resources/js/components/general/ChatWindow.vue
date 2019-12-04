<template>
    <div :class="{ chatbox_min: isMinimize }">
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

            <div class="pa-5 msg-box">
                <div class="d-block col-md-6 pa-2 mb-2 my-message white--text" v-for="me in messages" >
                    {{ me }}
                </div>
                <div class="d-block col-md-6  pa-2 mb-2 message black--text float-right">their</div>
            </div>

            <v-divider></v-divider>

            <v-card-text class="pa-0">
                <v-text-field
                    v-model="textMsg"
                    placeholder="Type your message here..."
                    single-line
                    background-color="white"
                    flat
                    full-width
                    class="input-field input-color"
                    :light="true"
                    ref="input"
                    @keyup.enter="sendMsg"
                >
                </v-text-field>
           </v-card-text>
            <v-card-text>
                <v-btn icon class="input-icons input-color" @click="$refs.file.click()">
                    <v-icon>attachment</v-icon>
                </v-btn>

                <input type='file' id='file-input' ref="file" @change="handleFile" class="d-none"/>

                <v-btn icon class="input-icons input-color" @click="$refs.image.click()">
                    <v-icon>local_movies</v-icon>
                </v-btn>

                <input type="file" ref="image" @change="handleImage" class="d-none" accept="image/*"/>

                <emoji-picker @emoji="insert" :search="search" class="d-inline float-left">
                    <div
                        class="emoji-invoker d-inline"
                        slot="emoji-invoker"
                        slot-scope="{ events: { click: clickEvent } }"
                        @click.stop="clickEvent"
                    >
                        <v-btn icon class="input-icons input-color">
                            <v-icon>tag_faces</v-icon>
                        </v-btn>

                    </div>
                    <div slot="emoji-picker" slot-scope="{ emojis, insert, display }">
                        <div class="emoji-picker" >
                            <div class="emoji-picker__search">
                                <input type="text" v-model="search">
                            </div>
                            <div>
                                <div v-for="(emojiGroup, category) in emojis" :key="category">
                                    <h5>{{ category }}</h5>
                                    <div class="emojis">
                                        <span
                                            v-for="(emoji, emojiName) in emojiGroup"
                                            :key="emojiName"
                                            @click="insert(emoji)"
                                            :title="emojiName"
                                        >{{ emoji }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </emoji-picker>

                <v-btn icon  class="input-icons input-color d-inline float-right"  @click="sendMsg">
                    <v-icon>send</v-icon>
                </v-btn>
            </v-card-text>
         </v-card>
    </div>
</template>
<script>
    import EmojiPicker from 'vue-emoji-picker'

    export default {
        components: {
            EmojiPicker,
        },
        props: {
            propItem:{},
        },
        data() {
            return {
                textMsg     : '',
                messages    : [],
                type        : 'influencer',
                isMinimize  : false,
                theirMessage: [],
                file        : null,
                image       : null,
                search      : ''
            }
        },
        methods: {
            sendMsg() {
                this.messages.push(this.textMsg);
                this.textMsg = '';
                this.$refs['input'].innerHTML = '';
            },
            insert(emoji) {
                this.textMsg += emoji
            },
            handleFile(e) {
                this.file = e.target.files[0];
                this.textMsg = this.file.name;
            },
            handleImage(e) {
                if (e.target.files[0].type === 'image/jpeg' || e.target.files[0].type === 'image/png' || e.target.files[0].type === 'image/jpg') {
                    this.image = e.target.files[0];
                    this.textMsg = this.image.name;
                }
            },
            minimize() {
                this.isMinimize = !this.isMinimize ;
            },
            closeWindow() {
                this.$emit('close-window',{
                    'chatBox' : this.propItem
                })
            }
         }
    }
</script>
<style scoped>
    >>>.emoji-picker {
        position: absolute ;
        z-index: 1 ;
        font-family: Montserrat ;
        border: 1px solid #ccc ;
        width: 15rem ;
        height: 20rem ;
        overflow: scroll ;
        padding: 1rem ;
        box-sizing: border-box ;
        border-radius: 0.5rem ;
        background: #fff ;
        box-shadow: 1px 1px 8px #c7dbe6 ;
        bottom:60px !important;
    }
    >>>.emoji-picker__search {
        display: flex;
    }
    >>>.emoji-picker__search > input {
        flex: 1;
        border-radius: 10rem;
        border: 1px solid #ccc;
        padding: 0.5rem 1rem;
        outline: none;
    }
    >>>.emoji-picker h5 {
        margin-bottom: 0;
        color: #b1b1b1;
        text-transform: uppercase;
        font-size: 0.8rem;
        cursor: default;
    }
    >>>.emoji-picker .emojis {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    >>>.emoji-picker .emojis:after {
        content: "";
        flex: auto;
    }
    >>>.emoji-picker .emojis span {
        padding: 0.2rem;
        cursor: pointer;
        border-radius: 5px;
    }
    >>>.emoji-picker .emojis span:hover {
        background: #ececec;
        cursor: pointer;
    }
    .msg-box {
        height:200px;
    }
    .my-message {
        word-wrap: break-word;
        background-color:#4e8cff !important;
        border-radius:10px !important;
    }
    .message {
        border-radius:10px !important;
        background-color: #eaeaea !important;
    }
    >>>.input-field{
        height:20px !important;
    }
    >>>.input-field.v-input input {
        max-height:0px !important;
        padding-bottom: 10px !important;
    }
    .input-icons {
        height:30px !important;
        width:30px !important;
    }
    .input-icons .v-icon {
        font-size: 20px !important;
    }
    .input-color {
        color:#1473e6 !important;
    }
    >>>::placeholder {
        color:#1473e6 !important;
    }
</style>
