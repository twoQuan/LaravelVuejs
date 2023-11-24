<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import {useRouter} from 'vue-router'
const router  = useRouter()
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();

const user = authStore.getUser();
const form = ref({
    email: "",
    password: "",
    password_confirmation: "",
});

const updateForm = () => {
  setTimeout(() => {
    form.value.email = authStore.user.email;
  }, 2500);
};
onMounted(updateForm);

</script>

<template>
    <!-- ====== Forms Section Start -->
    <section class="bg-[#F4F7FF] py-20 lg:py-[120px]">
        <div class="container mx-auto">
            <div class="-mx-4 flex flex-wrap">
                <div class="w-full px-4">
                    <div
                        class="
              relative
              mx-auto
              max-w-[525px]
              overflow-hidden
              rounded-lg
              bg-white
              py-16
              px-10
              text-center
              sm:px-12
              md:px-[60px]
            "
                    >
                        <div class="mb-10 text-center md:mb-16">Change Password</div>
                        <form @submit.prevent="authStore.handleResetPassword(form)">
                            <div class="mb-6">
                                <input
                                    :hidden="true"
                                    type="email"
                                    placeholder="Email"
                                    v-model="form.email"
                                    class="
                    bordder-[#E9EDF4]
                    w-full
                    rounded-md
                    border
                    bg-[#FCFDFE]
                    py-3
                    px-5
                    text-base text-body-color
                    placeholder-[#ACB6BE]
                    outline-none
                    focus:border-primary
                    focus-visible:shadow-none
                  "
                                />
                                <div v-if="authStore.errors.email" class="flex">
                  <span class="text-red-400 text-sm m-2 p-2">{{
                          authStore.errors.email[0]
                      }}</span>
                                </div>
                            </div>
                            <div class="mb-6">
                                <input
                                    type="password"
                                    placeholder="Password"
                                    v-model="form.password"
                                    class="
                    bordder-[#E9EDF4]
                    w-full
                    rounded-md
                    border
                    bg-[#FCFDFE]
                    py-3
                    px-5
                    text-base text-body-color
                    placeholder-[#ACB6BE]
                    outline-none
                    focus:border-primary
                    focus-visible:shadow-none
                  "
                                />
                                <div v-if="authStore.errors.password" class="flex">
                  <span class="text-red-400 text-sm m-2 p-2">{{
                          authStore.errors.password[0]
                      }}</span>
                                </div>
                            </div>
                            <div class="mb-6">
                                <input
                                    type="password"
                                    placeholder="Password Confirmation"
                                    v-model="form.password_confirmation"
                                    class="
                    bordder-[#E9EDF4]
                    w-full
                    rounded-md
                    border
                    bg-[#FCFDFE]
                    py-3
                    px-5
                    text-base text-body-color
                    placeholder-[#ACB6BE]
                    outline-none
                    focus:border-primary
                    focus-visible:shadow-none
                  "
                                />
                            </div>
                            <div class="mb-10">
                                <button
                                    type="submit"
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
                                    Submit{{authStore.error}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
