<template>
    <div class="py-5">
        <div class="w-full py-2 flex justify-between">
            <span>Categories</span>
            <div>
                <UButton icon="i-heroicons-plus" label="Add Category" @click="isOpen = !isOpen" />
            </div>
        </div>
        <div class="flex justify-between w-full gap-2" v-if="isOpen">
            <UInput placeholder="Enter your category" icon="i-heroicons-inbox-stack-16-solid" size="xl"
                class="mb-4 flex-grow" v-model="categoryNameInputValue" required />
            <UButton icon="i-heroicons-plus" class="h-11 px-4" @click="category.add(categoryNameInputValue, refresh)"
                type="submit" />
        </div>
        <div class="flex flex-col gap-2" v-auto-animate>
            <div v-for="( category, index ) in  categories.data " :key="category.id">
                <DashboardItemList :title="category.category" :no="index + 1" image="" />
            </div>
        </div>
    </div>
</template>
<script setup>
definePageMeta({
    layout: "dashboard-layout",
    middleware: "auth"
})

const category = useCategory()
const categoryNameInputValue = ref(null)
const config = useRuntimeConfig()
const { data: categories, refresh, pending } = await useFetch(config.public.apiBase + "/api/category");
const isOpen = ref(false)
</script>