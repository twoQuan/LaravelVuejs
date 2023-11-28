<script setup>
import { ref } from "vue";
import axios from "axios";
import {useRouter} from 'vue-router'
const router  = useRouter()
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();

const user = authStore.getUser();

</script>
<template>
    <div v-if="authStore.user.twitch == 1" class="container mx-auto flex flex-wrap items-center justify-between">
      <iframe
        :src="`https://player.twitch.tv/?channel=${authStore.user.name}&parent=localhost&muted=true`"
        height="380"
        width="900"
        allowfullscreen>
        </iframe>
      <iframe :src="`https://www.twitch.tv/embed/${authStore.user.name}/chat?parent=localhost`"
            height="380"
            width="350">
      </iframe>
    </div>
    <h1>video</h1>
    <iframe
    src="https://player.twitch.tv/?video=1978486457&parent=localhost&autoplay=false"
    height="380"
    width="350"
    allowfullscreen>
</iframe>
     <div
            class="container mx-auto flex flex-wrap items-center justify-between"
            bis_skin_checked="1"
        >
    <div>
    <h1 class="mt-4">name: {{authStore.user.name}}</h1>
    <h1 class="mt-4">phone:{{authStore.user.phone}}</h1></div>
    <div>
    <h1 class="mt-4">email: {{authStore.user.email}}</h1>
    <h1 class="mt-4">address: {{authStore.user.address}}</h1>
    </div>
    <div
                class="hidden w-full md:block md:w-auto"
                id="navbar-default"
                bis_skin_checked="1"
            >
                <ul
                    class="
            mt-4
            flex flex-col
            rounded-lg
            p-4
            md:mt-0 md:flex-row md:space-x-8 md:text-sm md:font-medium
          "
                >
    <div class="mb-10">'<a class="
                    w-full
                    px-4
                    py-3
                    bg-indigo-500
                    hover:bg-indigo-700
                    rounded-md
                    text-white
                  "
                href="http://localhost:3000/profile/change">Change Profile</a></div>
    <div class="mb-10"><a class="
                    w-full
                    px-4
                    py-3
                    bg-indigo-500
                    hover:bg-indigo-700
                    rounded-md
                    text-white
                  "
                href="http://localhost:3000/profile/passwordreset">Change Password</a></div>
            </ul>
    </div>
    </div>
</template>
