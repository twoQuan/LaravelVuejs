<script setup>
import { ref,onMounted} from "vue";
import {useAuthStore} from "../stores/auth.js";
import axios from "axios";

const authStore = useAuthStore();
const user = defineProps({
    username: String,
    // Các props khác nếu có
  });
const videos = ref([]);
console.log(user.username);
const getVideos = ()=> {
      axios.get(`/profile/getvideo?username=${user.username}`)
      .then((response) =>{
            videos.value = response.data;
      })
      .catch((error) => {
      // Xử lý lỗi nếu có
      console.error('Lỗi khi lấy video:', error);
      });


}
onMounted(async ()=>{
    const auth = authStore.getUser();
    getVideos();
})

</script>
<template>
<div class="container mx-auto flex flex-wrap items-center justify-between">
      <iframe
        :src="`https://player.twitch.tv/?channel=${username}&parent=localhost&muted=true`"
        height="480"
        width="900"
        allowfullscreen>
        </iframe>
      <iframe :src="`https://www.twitch.tv/embed/${username}/chat?parent=localhost`"
            height="480"
            width="350">
      </iframe>
</div>
<div class="mt-10 text-center font-bold text-xl text-red-500 md:mb-16">Video</div>
<div class="container mx-auto flex flex-wrap items-center justify-between">
<div v-for="video in videos">
<iframe
        :src="`https://player.twitch.tv/?video=${video}&parent=localhost&&autoplay=false`"
        height="300"
        width="250">
</iframe>
</div>
</div>
</template>

<script>

</script>