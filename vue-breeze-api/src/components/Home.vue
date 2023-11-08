<script setup>
import { ref,onMounted} from "vue";
import {useAuthStore} from "../stores/auth.js";

const authStore = useAuthStore();

onMounted(async ()=>{
    //get user
    const user  = await authStore.getUser()
})
</script>

<template>
    <div v-if="authStore.user" class="container mx-auto flex flex-wrap items-center justify-between">
      <iframe
        :src="`https://player.twitch.tv/?channel=${authStore.user?.name}&parent=localhost&muted=true`"
        height="480"
        width="900"
        allowfullscreen>
        </iframe>
      <iframe :src="`https://www.twitch.tv/embed/${authStore.user?.name}/chat?parent=localhost`"
            height="480"
            width="350">
      </iframe>
    </div>


</template>
