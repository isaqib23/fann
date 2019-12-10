<template>
    <div>
       <instagramProfile v-if="platform === 1" :platform="1"></instagramProfile>
       <youTubeProfile v-if="platform === 2" :platform="2"></youTubeProfile>
    </div>
</template>

<script>
import instagramProfile from "./instagramProfile";
import youtubeProfile from "./youtubeProfile";
import { mapGetters } from  'vuex'

    export default {
        components:{
            instagramProfile : instagramProfile,
            youtubeProfile : youtubeProfile
        },

        data: () => {
           return  {
               platform : 1
            }
        },
        computed:{
          ...mapGetters({
              campaignPlacement : 'campaign/campaignPlacement'
          })
        },
        mounted() {

            // this.platform = this.campaignPlacement['platform'];
        },
        methods: {

        }
    }
</script>


