<template>
    <div>
        <div class="w-full py-2 flex justify-between">
            <span>Posts</span>
            <NuxtLink to="/dashboard/post/create">
                <UButton variant="outline" class="hover:bg-green-500 hover:text-white" icon="i-heroicons-plus"
                    label="Create post" />
            </NuxtLink>
        </div>
        <div class="flex flex-col gap-2" v-auto-animate>
            <div v-for="( post, index ) in  posts.data " :key="post.id">
                <DashboardItemList :title="post.title" :no="index + 1" :data="post" :descriptions="post.content"
                    v-on:isEdit="handleEdit" v-on:isDelete="handleDelete" v-on:isShow="handleShow" :showDetailBtn="true"
                    :image="post.thumbnail">
                </DashboardItemList>
            </div>
        </div>
        <UModal v-model="showModal">
            <div class="p-4 flex flex-col gap-2">
                <div class="w-full h-72">
                    <img :src="postData.thumbnail ? config.public.apiBase + '/storage/posts_thumbnail/' + postData.thumbnail : 'https://img.freepik.com/free-photo/colorful-design-with-spiral-design_188544-9588.jpg'"
                        alt="" class="object-cover h-full rounded shadow-inner">
                </div>
                <div class="bg-slate-200 p-2">
                    <h1 class="font-semibold text-xl capitalize">{{ postData.title }}</h1>
                    <span class="capitalize text-gray-500">{{ postData.category }}</span>
                </div>
                <p class="w-full">{{ postData.content }}</p>
            </div>
        </UModal>
        <UModal v-model="editModal">
            <form @submit.prevent="editPost" class="p-4 flex flex-col gap-2">
                <div class="w-full h-64">
                    <div
                        class="flex items-center justify-center w-full relative overflow-hidden shadow-xl rounded-xl hover:brightness-50 transition-all duration-300">
                        <img v-if="previewUrl" :src="previewUrl" alt="Preview"
                            class="absolute left-0 w-full border shadow-xl select-none pointer-events-none" />
                        <img v-else
                            :src="postData.thumbnail ? config.public.apiBase + '/storage/posts_thumbnail/' + postData.thumbnail : 'https://img.freepik.com/free-photo/colorful-design-with-spiral-design_188544-9588.jpg'"
                            alt=""
                            class="object-cover h-full rounded shadow-inner absolute left-0 pointer-events-none w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 ">
                            <div class="flex flex-col items-center justify-center pt-5">
                                <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="text-sm text-gray-500"><span class="font-semibold">Click to
                                        upload</span></p>
                                <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" accept="image/*"
                                @change="handleFileChange" />
                        </label>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <UInput color="gray" size="md" variant="outline" placeholder="Title" v-model="postData.title" />
                    <UInputMenu v-model="selectedCategory" :selected="selectedCategory" :options="categories.data"
                        value-attribute="id" option-attribute="category" />
                </div>
                <UTextarea class="w-full" v-model="postData.content" :autoresize="true" />
                <UButton icon="i-heroicons-pencil-square" size="sm" color="primary" variant="solid" label="Submit"
                    :trailing="false" class="text-center flex justify-center" type="submit" />
            </form>
        </UModal>
        <UModal v-model="deleteModal">
            <div class="p-4">
                <div class="p-4 py-10 flex flex-col items-center gap-2">
                    <UIcon name="i-heroicons-exclamation-triangle" class="text-6xl text-red-500" />
                    <h1 class="text-xl font-semibold">Do you really wish to delete this data?</h1>
                    <div class="flex gap-2">
                        <UButton label="Yes, Delete!"
                            class="bg-green-400 px-4 py-2 text-white rounded-md shadow-xl hover:bg-green-500"
                            @click="deletePost" />
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
definePageMeta({
    layout: "dashboard-layout",
    middleware: "auth"
})

const showModal = ref(false)
const deleteModal = ref(false)
const editModal = ref(false)
const config = useRuntimeConfig()
const selectedCategory = ref(null)
const postStore = usePost()
const previewUrl = ref(null);
const filename = ref(null);
const { $showAlert } = useNuxtApp();

const { data: posts, refresh, pending } = await useFetch(config.public.apiBase + "/api/post");
const { data: categories } = await useFetch(config.public.apiBase + "/api/category")

const postData = ref({
    id: "",
    title: "",
    content: "",
    category: "",
    thumbnail: "",
})

const handleFileChange = (event) => {
    const input = event.target;
    if (input.files.length > 0) {
        const file = input.files[0];
        previewUrl.value = URL.createObjectURL(file);
        filename.value = file.name;

        const render = new FileReader();
        render.onload = () => {
            postData.value.thumbnail = file;
        };

        render.readAsDataURL(file);
    } else {
        previewUrl.value = null;
    }
};

function handleShow(data) {
    showModal.value = data.status_show
    postData.value.id = data.data.id
    postData.value.title = data.data.title
    postData.value.content = data.data.content
    postData.value.category = data.data.category
    postData.value.thumbnail = data.data.thumbnail
}

function handleDelete(data) {
    deleteModal.value = data.status_delete
    postData.value.id = data.data.id
}

function handleEdit(data) {
    editModal.value = data.status_edit
    postData.value.id = data.data.id
    postData.value.title = data.data.title
    postData.value.content = data.data.content
    postData.value.category = data.data.category
    postData.value.thumbnail = data.data.thumbnail
    categories.value.data.filter(e => {
        if (e.category === postData.value.category) {
            selectedCategory.value = e.id
        }
    })

}

function deletePost() {
    postStore.destroy(postData.value.id);
    deleteModal.value = false
}

async function editPost() {
    const formData = new FormData()
    formData.append('title', postData.value.title);
    formData.append('content', postData.value.content);
    formData.append('category_id', selectedCategory);
    const request = await $fetch(config.public.apiBase + '/api/post/' + postData.value.id + "?_method=PATCH", {
        method: "POST",
        body: {
            title: postData.value.title,
            category_id: selectedCategory.value,
            content: postData.value.content
        },
        headers: {
            Authorization: `Bearer ${useCookie('api_token').value}`
        }
    });
    $showAlert(request);
    editModal.value = false;
}
</script>