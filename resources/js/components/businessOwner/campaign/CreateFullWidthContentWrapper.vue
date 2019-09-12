<template>
    <v-container class="ma-0 pa-0">
        <v-flex lg12 sm12 xs12>
            <transition name="fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </v-flex>
    </v-container>
</template>

<script>

    export default {
        data: () => ({
            items: []
        }),

        mounted() {

        },

        methods: {}
    }
</script>
