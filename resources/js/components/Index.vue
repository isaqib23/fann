<template></template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        computed: mapGetters({
            auth: 'auth/user'
        }),
        mounted() {
            if (this.auth) {
                if (this.auth.type == 'influencer') {
                  return  this.$router.push({name: 'influencer-index'})
                }

                this.$router.push({name: 'businessOwner-index'})

            } else {
                this.$router.push({name: 'login'})
            }
        }
    }
</script>
