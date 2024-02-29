<template>
    <div class="w-full bg-white">
        <nav class="flex justify-between w-full px-5 items-center shadow-md">
            <nuxt-link to="/">
                <img src="assets/img/logo.png" class="w-24" alt="">
            </nuxt-link>
            <div class="nuxtlinks flex space-x-5">
                <nuxt-link exact-active-class="font-bold" class="hover:underline" to="/">Homepages</nuxt-link>
                <nuxt-link exact-active-class="font-bold" class="hover:underline" to="/categories">Categories</nuxt-link>
                <nuxt-link exact-active-class="font-bold" class="hover:underline" to="/post">Posts</nuxt-link>
            </div>
            <div class="flex space-x-2">
                <div v-if="!apiToken">
                    <nuxt-link to="/register" class="px-4 py-2 text-sm font-semibold hover:underline">Register</nuxt-link>
                    <UButton label="Login" @click="isOpen = true"
                        class="bg-blue-400 px-4 py-2 text-white rounded-md shadow-xl hover:bg-blue-500" />
                </div>
                <div v-else>
                    <UserAvatar />
                </div>
            </div>
        </nav>
        <UModal v-model="isOpen">
            <LoginForm v-on:is-loged-in="isOpen = false" />
        </UModal>
    </div>
</template>

<script setup>
const isOpen = ref(false);
const apiToken = useCookie("api_token");
</script>