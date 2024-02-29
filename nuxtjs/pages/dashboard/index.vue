<template>
    <div class="w-full h-full flex p-5 gap-2 max-lg:flex-col">
        <div class="flex flex-col w-1/2 max-lg:w-full -text-center h-full">
            <div class="w-full flex">
                <div class="p-4 md:w-1/2 sm:w-1/2 w-full">
                    <div
                        class="border-2 bg-white border-gray-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110 text-center">
                        <UIcon name="i-heroicons-newspaper-solid" class="text-6xl" />
                        <h2 class="title-font font-medium text-3xl text-gray-900">{{ post.data.length }}</h2>
                        <p class="leading-relaxed">Posts</p>
                    </div>
                </div>
                <div class="p-4 md:w-1/2 sm:w-1/2 w-full">
                    <div
                        class="border-2 bg-white border-gray-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110 text-center">
                        <UIcon name="i-heroicons-list-bullet-16-solid" class="text-6xl" />
                        <h2 class="title-font font-medium text-3xl text-gray-900">{{ categories.data.length }}</h2>
                        <p class="leading-relaxed">Categories</p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-500 w-full flex h-full">
            </div>
        </div>
        <div class=" bg-red-950 w-1/2 max-lg:w-full h-full"></div>
    </div>
</template>

<script setup>
definePageMeta({
    layout: "dashboard-layout",
    middleware: "auth"
})

const config = useRuntimeConfig();
const { data: post } = await useFetch(config.public.apiBase + '/api/post');
const { data: categories } = await useFetch(config.public.apiBase + '/api/category');
</script>