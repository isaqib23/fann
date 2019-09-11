<template>
    <div class="fill-height appBG">
        <app-nav :mini="mini" @nav-toggle="navToggle"></app-nav>
        <top-menu @nav-toggle="navToggle"></top-menu>
        <v-content fluid>
                <transition name="fade" mode="out-in">
                    <router-view></router-view>
                </transition>
        </v-content>

        <app-footer></app-footer>
    </div>
</template>

<script>
    import AppNav from '../businessOwner/shared/AppNav'
    import TopMenu from '../businessOwner/shared/TopMenu'
    import AppFooter from '../businessOwner/shared/AppFooter'

    export default {
        data: () => ({
            mini: false
        }),

        components: {
            AppNav,
            TopMenu,
            AppFooter
        },

        methods: {
            navToggle() {
                this.mini = !this.mini
            }
        }
    }
</script>
