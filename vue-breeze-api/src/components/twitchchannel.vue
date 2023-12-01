<script setup>
import { ref,onMounted} from "vue";
import {useAuthStore} from "../stores/auth.js";
import axios from "axios";

const authStore = useAuthStore();
const user = defineProps({
    username: String,
    // Các props khác nếu có
  });
// lấy 5 video nhiều view nhất hiện tại
const refreshVideo = ()=> {
      axios.get(`/profile/refreshvideo?username=${user.username}`)
      .then((response) =>{
            videos.value = response.data;
            window.location.reload();
      })
      .catch((error) => {
      // Xử lý lỗi nếu có
      console.error('Lỗi khi làm mới video:', error);
      });
}
const videos = ref([]);
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
const update = () => {
      console.log(videos.value);
      axios.put("/profile/editvideo",{
            username: user.username,
            videos: videos.value
      }).then((response) =>{
            console.log(response.data);
      })     
      .catch((error) =>{
            console.error('Lỗi khi edit video:', error);
      });
}
const handleButtonRefresh = () => {
      refreshVideo();
};
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
<table>
<draggable v-model="videos" tag="tr" class="draggable" @change="update">
    <template v-slot:item="{ element }">
        <td>
            <button class="w-full
                    px-4
                    py-3
                    bg-indigo-500
                    hover:bg-indigo-700
                    rounded-md
                    text-white">Drag</button>
          <iframe
            :src="`https://player.twitch.tv/?video=${element}&parent=localhost&&autoplay=false`"
            height="300"
            width="300"
          ></iframe>
        </td>
    </template>
  </draggable>    
</table>
<div class="flex justify-center items-center">
<button
@click="handleButtonRefresh"
                                    class="
                    px-4
                    py-3
                    bg-green-500
                    hover:bg-green-700
                    rounded-md
                    text-white
                    mt-8
                  "
                                >
                                    Get 5 most viewed videos
                                </button>
</div>
</template>

<script>
import draggable  from 'vuedraggable';
export default {
            components: {
                  draggable
            },
            props: ['videos'],

};

</script>