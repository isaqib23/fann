<template>
  <v-flex sm8 md6 lg3>
    <v-card>
      <v-toolbar dark color="primary" flat>
        <v-toolbar-title>Login</v-toolbar-title>
      </v-toolbar>
      <v-card-text>
        <login-form @success="success"></login-form>
      </v-card-text>
    </v-card>

    <div class="text-center mt-4">Don't have an account?
      <router-link :to="{ name: 'register' }" class="purple--text">Register</router-link>
    </div>
  </v-flex>
</template>

<script>
    import LoginForm from './LoginForm'

    export default {
        components: {
            LoginForm
        },

        methods: {
            success(data) {
                this.$store.dispatch('auth/saveToken', data)
                this.$store.dispatch('auth/setUser', data)
                this.$router.push({name: data.user.type+'-index'})
            }
        },
        created() {

        }
    }
</script>
