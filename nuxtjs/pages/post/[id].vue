<template>
    <div class="container mx-auto md:px-6">
        <div v-if="pending">
            <Loading />
        </div>
        <div v-else>
            <div class="mb-32 px-5 max-md:px-0">
                <div class="w-full mb-5">
                    <label for="title" class="block mb-2 text-xl font-medium text-gray-900">Thumbnail</label>
                    <div class="flex items-center justify-center w-full relative overflow-hidden shadow-xl rounded-xl  transition-all duration-300 h-[40em]"
                        :class="contentEditable ? 'hover:brightness-50 cursor-pointer' : 'pointer-events-none'">
                        <NuxtImg v-if="!previewUrl"
                            v-bind:src="config.public.apiBase + '/storage/posts_thumbnail/' + (post.data.thumbnail == null ? 'null.jpg' : post.data.thumbnail)"
                            class="rounded-lg shadow-lg dark:shadow-black/20 border w-full h-full object-cover absolute pointer-events-none"
                            :alt="post.data.thumbnail" />
                        <NuxtImg v-else v-bind:src="previewUrl"
                            class="rounded-lg shadow-lg dark:shadow-black/20 border w-full h-full object-cover absolute pointer-events-none"
                            :alt="previewUrl" />
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 ">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                        upload</span></p>
                                <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden h-full w-full" accept="image/*"
                                @change="handleFileChange" data-ref="thumbnail" />
                        </label>
                    </div>
                    <h1 class="text-center" id="filename">{{ filename }}</h1>
                </div>
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <span> Published at <u>{{ formatDate(post.data.created_at) }}</u></span>
                        <h1><b>Category : </b> {{ post.data.category }}</h1>
                    </div>
                    <div class="action flex gap-1">
                        <button
                            class="bg-yellow-400 px-4 py-2 transition-all text-white rounded-md shadow-md hover:shadow-xl"
                            @click="handleEdit">Edit</button>
                        <button class="bg-red-500 px-4 py-2 text-white rounded-md shadow-md hover:shadow-xl"
                            @click="handleDelete">Delete</button>
                    </div>
                </div>
                <h1 class="mb-6 text-3xl font-bold py-2 px-1" :contenteditable="contentEditable"
                    :class="contentEditable ? 'outline' : ''" @input="handleInput" data-ref="title">
                    {{ post.data.title }}
                </h1>
                <p :contenteditable="contentEditable" class="py-2 px-1 break-words" v-html="post.data.content"
                    :class="contentEditable ? 'outline' : ''" @input="handleInput" data-ref="content">
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
const route = useRoute();
const config = useRuntimeConfig();
const toast = useToast();
const contentEditable = ref(false);
const { data: post, pending, refresh } = await useFetch(config.public.apiBase + '/api/post/' + route.params.id, {
    server: false,
});

const previewUrl = ref(null);
const filename = ref(null);
const data = ref({
    thumbnail: null,
    title: null,
    content: null
});

const handleInput = (event) => {
    const value = event.target.innerText;
    const dataset = event.target.dataset.ref;
    data.value[dataset] = value;
};

const submitEdit = async () => {
    const requestData = {};

    Object.keys(data.value).forEach(key => {
        if (data.value[key] !== null) {
            requestData[key] = data.value[key];
        }
    });

    const request = await $fetch(config.public.apiBase + '/api/post/' + route.params.id, {
        method: "PATCH",
        params: requestData
    });
    if (request.success) {
        toast.add({
            title: request.message,
            icon: 'i-heroicons-check-circle',
            color: 'primary'
        });
    } else {
        Object.keys(request).forEach((key) => {
            toast.add({
                title: request[key][0],
                icon: 'i-heroicons-x-circle',
                color: 'red'
            })
        });
    }
};


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

const handleEdit = (e) => {
    contentEditable.value = !contentEditable.value;
    e.target.classList.add('bg-green-400');
    e.target.classList.toggle('bg-yellow-400');
    e.target.innerText = contentEditable.value ? "Done" : "Edit";

    if (!contentEditable.value) {
        submitEdit();
        e.target.disabled = true;
        let i = 5;
        const countdownInterval = setInterval(() => {
            e.target.innerText = i--;
            if (i < 0) {
                clearInterval(countdownInterval);
                e.target.innerText = contentEditable.value ? "Done" : "Edit";
            }
        }, 1000);
        setTimeout(() => {
            e.target.disabled = false;
        }, 6000);
    }
};

const handleDelete = () => {
    toast.add({
        title: "Click confirm to delete this post!",
        icon: 'i-heroicons-information-circle',
        color: 'red',
        actions
    })
};

const actions = ref([{
    color: 'red',
    label: 'Confirm',
    click: () => formDelete()
}]);

const formDelete = async () => {
    const apiResponse = await $fetch(config.public.apiBase + "/api/post/" + route.params.id, {
        method: "DELETE"
    });

    if (apiResponse.success) {
        toast.add({
            title: apiResponse.message,
            icon: 'i-heroicons-check-circle',
            color: 'primary'
        })
        return navigateTo('/post');
    } else {
        Object.keys(apiResponse).forEach((key) => {
            toast.add({
                title: apiResponse[key][0],
                icon: 'i-heroicons-x-circle',
                color: 'red'
            })
        });
    }
};

const formatDate = (date) => {
    const dateTime = new Date(date)
    const months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    const day = dateTime.getDate();
    const month = months[dateTime.getMonth()];
    const year = dateTime.getFullYear();

    return `${day} ${month} ${year}`;
};
</script>
