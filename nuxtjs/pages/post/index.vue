<template>
    <div class="w-full h-full">
        <div v-if="pending">
            <Loading />
        </div>
        <div v-else class="w-full h-full">
            <DataNotFound v-if="posts.data.length == 0" />
            <div v-for="post in posts.data" :key="post.id" v-else
                class="grid grid-cols-4 place-items-center gap-5 max-lg:grid-cols-2 max-sm:grid-cols-1">
                <Card :images="post.thumbnail" :title="post.title" :category="post.category" :content="post.content"
                    :id="post.id" />
            </div>
        </div>
    </div>
</template>


<script setup>
const config = useRuntimeConfig();
const { data: posts, pending } = await useFetch(config.public.apiBase + "/api/post", {
    server: false
});
</script>