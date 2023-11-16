<script setup>
import { ref,onMounted} from "vue";
import {useAuthStore} from "../stores/auth.js";

const authStore = useAuthStore();

onMounted(async ()=>{
    authStore.getUser();
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
</template>

<script>
export default {
      props: ['username'],
};
</script>