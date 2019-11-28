<template>
    <div>

        <v-layout row wrap align-end justify-end>
            <v-flex lg3>
            <v-card class="mt-auto">
                <v-list-item>
                    <v-list-item-avatar
                        height="50"
                        width="50"
                    >
                        <v-img :src="avatar" :tile="false"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>
                            <strong>{{ title }}</strong>
                        </v-list-item-title>
                        <v-list-item-subtitle>
                            {{type}}
                        </v-list-item-subtitle>
                    </v-list-item-content>
                    <v-btn icon>
                        <v-icon>clear</v-icon>
                    </v-btn>

                </v-list-item>

                <v-divider></v-divider>

                <v-card-text class="pa-2">
                    Chat content goes here
                </v-card-text>


                <v-divider></v-divider>

                <v-card-text>
                    <v-text-field placeholder="Type your message here..."></v-text-field>
                </v-card-text>

                <v-card-text>
                    <v-btn icon>
                        <v-icon>attachment</v-icon>
                    </v-btn>
                    <v-btn icon>
                        <v-icon>local_movies</v-icon>
                    </v-btn>
                    <v-btn icon>
                        <v-icon>tag_faces</v-icon>
                    </v-btn>
                </v-card-text>


            </v-card>
            </v-flex>

        </v-layout>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
                title: 'Brunch',
                type: 'influncer'

            }
        }
    }
</script>
