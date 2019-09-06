<template>
    <v-container >
        <v-card class="ma-12">
            <v-card-text>
                <v-layout row wrap>
                    <v-flex lg12 sm12 xs12>
                        <transition name="fade" mode="out-in">
                            <router-view></router-view>
                        </transition>
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>

    export default {
        data: () => ({
            items: []
        }),

        mounted() {

        },

        methods: {

        }
    }
</script>
