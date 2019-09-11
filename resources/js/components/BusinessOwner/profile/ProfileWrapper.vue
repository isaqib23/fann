<template>
    <v-card>
        <v-card-text>
            <v-layout row justify-center wrap>
                <v-flex lg9 sm8 xs12>
                    <transition name="fade" mode="out-in">
                        <router-view></router-view>
                    </transition>
                </v-flex>
                <v-flex lg3 sm4 xs12 mt-12>
                    <sidemenu :threshold="67" :offset="90" :items="items"></sidemenu>
                </v-flex>
            </v-layout>
        </v-card-text>
    </v-card>
</template>

<script>
    import Sidemenu from '$comp/ui/Sidemenu'

    export default {
        components: {
            Sidemenu
        },

        data: () => ({
            items: []
        }),

        mounted() {
            this.navigation()
        },

        methods: {
            navigation() {
                this.items = [
                    {title: 'View', icon: 'visibility', to: {name: 'profile'}},
                    {title: 'Edit', icon: 'edit', to: {name: 'profile-edit'}},
                ]
            }
        }
    }
</script>
