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
            <UButton icon="i-heroicons-plus" class="h-11 px-4"
                @click="categoryStore.add(categoryNameInputValue, refresh)" type="submit" />
        </div>
        <div class="flex flex-col gap-2" v-auto-animate>
            <div v-for="( category, index ) in  categories.data " :key="category.id">
                <DashboardItemList :title="category.category" :no="index + 1" :data="category" v-on:isEdit="handleEdit"
                    v-on:isDelete="handleDelete">
                </DashboardItemList>
            </div>
        </div>
        <UModal v-model="editModal">
            <div class="p-4">
                <div class="flex flex-col gap-2">
                    <h1 class="text-xl font-semibold">Edit category</h1>
                    <UInput color="primary" variant="outline" placeholder="Category name" size="xl"
                        v-model="categoryData.category" />
                    <UInput type="hidden" v-model="categoryData.id" />
                    <UButton label="Edit" class="self-end px-5" size="md"
                        @click="categoryStore.update(categoryData.id, categoryData.category, refresh)" />
                </div>
            </div>
        </UModal>
        <UModal v-model="deleteModal">
            <div class="p-4">
                <div class="p-4 py-10 flex flex-col items-center gap-2">
                    <UIcon name="i-heroicons-exclamation-triangle" class="text-6xl text-red-500" />
                    <h1 class="text-xl font-semibold">Do you really wish to delete this data?</h1>
                    <div class="flex gap-2">
                        <UButton label="Yes, Delete!"
                            class="bg-green-400 px-4 py-2 text-white rounded-md shadow-xl hover:bg-green-500"
                            @click="deleteCategory" />
                        <UButton label="No, Cancel"
                            class="bg-red-400 px-4 py-2 text-white rounded-md shadow-xl hover:bg-red-500"
                            @click="deleteModal == false" />
                    </div>
                </div>
            </div>
        </UModal>
    </div>
</template>

<script setup>
const editModal = ref(false)
const deleteModal = ref(false)
definePageMeta({
    layout: "dashboard-layout",
    middleware: "auth"
})

const categoryStore = useCategory()
const categoryNameInputValue = ref(null)
const config = useRuntimeConfig()
const { data: categories, refresh, pending } = await useFetch(config.public.apiBase + "/api/category");
const isOpen = ref(false)

const categoryData = ref({
    id: "",
    category: ""
})

function handleEdit(data) {
    editModal.value = data.status_edit
    categoryData.value.id = data.data.id
    categoryData.value.category = data.data.category
}

function handleDelete(data) {
    deleteModal.value = data.status_delete
    categoryData.value.id = data.data.id
}

function deleteCategory() {
    categoryStore.destroy(categoryData.value.id, refresh)
    deleteModal.value = false
}

</script>