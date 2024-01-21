<template>
    <nav class="w-full px-10 py-3 h-20 flex justify-between items-center gap-5 ">
        <a href="/" class="w-28">
            <img src="/assets/img/logo.png" alt="blog logo" />
        </a>
        <div class="links flex flex-row gap-5">
            <nuxt-link to="/" class="hover:underline">Homepage</nuxt-link>
            <nuxt-link to="/posts" class="hover:underline">Posts</nuxt-link>
            <nuxt-link to="/categories" class="hover:underline">Categories</nuxt-link>
        </div>
        <button id="createPostBtn" class="px-5 py-2 bg-blue-500 text-white font-bold rounded shadow-xl hover:bg-blue-600">
            Create Post
        </button>
    </nav>
    <div class="w-full h-full px-10">
        <slot />
    </div>
</template>

<script setup>
useHead({
    "title": "Dot Blog"
})

</script>