<template>
    <div class="flex flex-col items-center">
        <div class="w-11/12 max-lg:w-full">
            <h1 class="font-semibold text-3xl mb-10">Create a post</h1>
            <form @submit.prevent="postForm" class="flex gap-5 w-full h-full flex-col" enctype="multipart/form-data">
                <div class="w-full">
                    <label for="category" class="block mb-2 text-xl font-medium text-gray-900">Category</label>
                    <select id="countries" required name="category" v-model="data.category_id"
                        class="bg-gray-50 border border-gray-500 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="" selected>Choose a category</option>
                        <option value="" selected v-if="pending">Pending</option>
                        <option v-else v-for="cat in categories.data" :key="cat.id" :value="cat.id">{{
                            cat.category }}
                        </option>
                    </select>
                    <span class="text-sm">or <nuxt-link to="/categories" class="underline text-blue-500">
                            Add category
                        </nuxt-link>
                    </span>
                </div>
                <div class="w-full">
                    <label for="title" class="block mb-2 text-xl font-medium text-gray-900">Title</label>
                    <input type="title" id="title" v-model="data.title"
                        class="bg-gray-50 border border-gray-500 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Enter your post title here!" required>
                </div>
                <div class="w-full">
                    <label for="title" class="block mb-2 text-xl font-medium text-gray-900">Thumbnail</label>
                    <div
                        class="flex items-center justify-center w-full relative overflow-hidden shadow-xl rounded-xl hover:brightness-50 transition-all duration-300">
                        <img v-if="previewUrl" :src="previewUrl" alt="Preview"
                            class="absolute left-0 -top-1/2 w-full border shadow-xl select-none pointer-events-none" />
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 ">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                        upload</span></p>
                                <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" accept="image/*"
                                @change="handleFileChange" />
                        </label>
                    </div>
                    <h1 class="text-center" id="filename">{{ filename }}</h1>
                </div>
                <div class="w-full">
                    <label for="content" class="block mb-2 text-xl font-medium text-gray-900">Content</label>
                    <textarea id="message" rows="4" v-model="data.content"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                        placeholder="Write your post content here..." required></textarea>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Submit</button>
            </form>
        </div>
    </div>
</template>

<script setup>
definePageMeta({
    middleware: ['auth']
})

const config = useRuntimeConfig();
const { data: categories, pending } = await useFetch(config.public.apiBase + "/api/category");

const { $showAlert } = useNuxtApp();
const previewUrl = ref(null);
const filename = ref(null);

const handleFileChange = (event) => {
    const input = event.target;
    if (input.files.length > 0) {
        const file = input.files[0];
        previewUrl.value = URL.createObjectURL(file);
        filename.value = file.name;

        const render = new FileReader();
        render.onload = () => {
            data.value.thumbnail = file;
        };

        render.readAsDataURL(file);
    } else {
        previewUrl.value = null;
    }
};

const data = ref({
    category_id: '',
    title: '',
    content: '',
    thumbnail: '',
});

const response = ref('');

async function postForm() {
    const formData = new FormData();
    formData.append('category_id', data.value.category_id);
    formData.append('title', data.value.title);
    formData.append('content', data.value.content);
    formData.append('thumbnail', data.value.thumbnail);

    const apiResponse = await $fetch(config.public.apiBase + "/api/post", {
        method: "POST",
        body: formData,
        headers: {
            Authorization: `Bearer ${useCookie('api_token').value}`
        }
    });

    $showAlert(apiResponse);
    if (apiResponse.success) {
        data.value = {
            category_id: '',
            title: '',
            content: '',
            thumbnail: '',
        };
        previewUrl.value = null;
        filename.value = null;
        response.value = apiResponse;
    }
}
</script>