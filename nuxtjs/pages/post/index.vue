<template>
    <div class="w-full h-full">
        <div v-if="pending">
            <Loading />
        </div>
        <div v-else>
            <DataNotFound v-if="posts.length == 0" />
            <div class="grid grid-cols-4 place-items-center gap-5 max-lg:grid-cols-2 max-sm:grid-cols-1" v-else>
                <div v-for="post in posts" :key="post.id">
                    <Card :images="post.thumbnail" :title="post.title" :category="post.category" :content="post.content"
                        :id="post.id" :author="post.author" />
                </div>
            </div>
            <div class="flex justify-center items-center w-full h-20">
                <UPagination v-model="page" :page-count="posts && posts.meta ? posts.meta.per_page : 0"
                    :total="posts && posts.meta ? posts.meta.total : 0"
                    :ui="{ rounded: 'first-of-type:rounded-s-md last-of-type:rounded-e-md' }">
                    <template #first="{ onClick }">
                        <UTooltip text="First page">
                            <UButton icon="i-heroicons-arrow-uturn-left" color="primary" :ui="{ rounded: 'rounded-full' }"
                                class="rtl:[&_span:first-child]:rotate-180 me-2" @click="onClick" />
                        </UTooltip>
                    </template>
                    <template #last="{ onClick }">
                        <UTooltip text="Last page">
                            <UButton icon="i-heroicons-arrow-uturn-right-20-solid" color="primary"
                                :ui="{ rounded: 'rounded-full' }" class="rtl:[&_span:last-child]:rotate-180 ms-2"
                                @click="onClick" />
                        </UTooltip>
                    </template>
                </UPagination>
            </div>
        </div>
    </div>
</template>

<script setup>
const config = useRuntimeConfig();
const page = ref(1)

const { data: posts, pending } = await $fetch(config.public.apiBase + "/api/post", {
    query: {
        page
    },
    watch: [page]
});
console.log(posts);
</script>
