<template>
    <div
        class="max-w-sm bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 shadow-lg grid grid-rows-2 overflow-hidden">
        <a href="#" class="h-60 overflow-hidden">
            <NuxtImg class="rounded-t-lg h-full object-cover w-full"
                v-bind:src="config.public.apiBase + '/storage/posts_thumbnail/' + (props.images == null ? 'null.jpg' : props.images)"
                loading="lazy" :alt="props.category" />
        </a>
        <div class="p-5 border flex flex-col items-start  bg-gray-100">
            <a href="#">
                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white truncate max-w-72">
                    {{
                        props.title }}
                </h5>
                <span class="mb-2  text-gray-500">{{ props.category }}</span>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 max-w-72 break-words"> {{
                props.content.slice(0, 100) }}{{ props.content.length > 100 ? '...' : '' }}
            </p>
            <NuxtLink :to="'/post/' + props.id"
                class="inline-flex items-center  px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Read more
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </NuxtLink>
        </div>
    </div>
</template>

<script setup>
const config = useRuntimeConfig()
const props = defineProps({
    images: String,
    title: String,
    category: String,
    content: String,
    id: String
})
</script>