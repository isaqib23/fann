<template>
  <v-app id="app">
      <router-view></router-view>
  </v-app>
</template>

<script>
    import { mapGetters } from 'vuex'
export default {
    computed: mapGetters({
        auth: 'auth/user'
    }),
    mounted() {
        console.log(this.auth, this.$store.state.auth);
        //console.log(this.$store.state.auth);
        if(this.$store.state.auth){
            if(this.$store.state.auth.user.type == 'influencer'){
                this.$router.push({ name: 'influencer-index' })
            }else{
                this.$router.push({ name: 'businessOwner-index' })
            }
        }else{
            this.$router.push({ name: 'login' })
        }
    }
}
</script>
