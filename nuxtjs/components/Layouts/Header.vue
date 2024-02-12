<template>
    <div class="w-full">
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
                <nuxt-link exact-active-class="bg-blue-600" class="bg-blue-400 px-4 py-2 text-white rounded-md shadow-xl"
                    to="/post/create">Create a
                    post</nuxt-link>
            </div>
        </nav>
    </div>
</template>