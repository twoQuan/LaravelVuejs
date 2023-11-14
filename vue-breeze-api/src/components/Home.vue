<script setup>
import { ref,onMounted} from "vue";
import {useAuthStore} from "../stores/auth.js";

const authStore = useAuthStore();

onMounted(async ()=>{
    //get users
    const users= authStore.getUsers();
    authStore.getUser();
})
</script>


<template>
<div class="container mx-auto flex flex-wrap items-center justify-between">
<div v-for="user in authStore.users">
<iframe
        :src="`https://player.twitch.tv/?channel=${user.name}&parent=localhost&muted=true`"
        height="300"
        width="300">
</iframe>
<router-link :to="{ name: 'twitch', params: { username: user.name } }">
  <div class="mb-10">
                                <button
                                    
                                    class="
                    w-full
                    px-4
                    py-3
                    bg-indigo-500
                    hover:bg-indigo-700
                    rounded-md
                    text-white
                  "
                                >
                                    {{user.name}}
                                </button>
                                </div>
</router-link>
</div>
</div>


</template>
