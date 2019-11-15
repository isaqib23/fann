<template>
  <v-content>
    <v-container fluid justify-center align-center class="fullBG" style="height: 100%">
      <v-layout row wrap justify-center align-center class="pageWrapper">
        <v-flex sm12 class="text-sm-center mt-10">
          <img src="/images/faan.png" class="siteLogo"/>
        </v-flex>
        <transition name="fade" mode="out-in">
          <router-view class="mb-10"></router-view>
        </transition>
      </v-layout>

    </v-container>
  </v-content>
</template>

<script>
export default {}
</script>
