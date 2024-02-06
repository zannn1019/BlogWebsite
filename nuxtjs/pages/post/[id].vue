<template>
    <div class="container mx-auto md:px-6">
        <div v-if="pending">
            <Loading />
        </div>
        <div v-else>
            <div class="mb-32 px-5 max-md:px-0">
                <NuxtImg v-bind:src="config.public.apiBase + '/storage/posts_thumbnail/' + post.data.thumbnail"
                    class="mb-6 rounded-lg shadow-lg dark:shadow-black/20 border w-full max-h-[40em] object-cover"
                    :alt="post.data.thumbnail" />
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <span> Published <u>{{ formatDate(post.data.created_at) }}</u></span>
                    </div>
                    <div class="action flex gap-1">
                        <button
                            class="bg-yellow-400 px-4 py-2 transition-all text-white rounded-md shadow-md hover:shadow-xl"
                            @click="handleEdit">Edit</button>
                        <button class="bg-red-500 px-4 py-2 text-white rounded-md shadow-md hover:shadow-xl">Delete</button>
                    </div>
                </div>
                <h1 class="mb-6 text-3xl font-bold py-2 px-1" :contenteditable="contenteditable"
                    :class="contenteditable ? 'outline' : ''" @input="handleInput" data-ref="title">
                    {{ post.data.title }}
                </h1>
                <p :contenteditable="contenteditable" class="py-2 px-1 break-words"
                    :class="contenteditable ? 'outline' : ''" @input="handleInput" data-ref="content">
                    {{ post.data.content }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
const route = useRoute();
const config = useRuntimeConfig();
const contenteditable = ref(false);
const { data: post, pending } = await useFetch(config.public.apiBase + '/api/post/' + route.params.id, {
    server: false,
    lazy: true
});

const data = ref({
    thumbnail: null,
    title: null,
    content: null
});

function handleInput(event) {
    let value = event.target.innerText;
    let dataset = event.target.dataset.ref;
    data.value[dataset] = value;
}

async function formEdit() {
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
}


function handleEdit(e) {
    contenteditable.value = !contenteditable.value;
    e.target.classList.add('bg-green-400');
    e.target.classList.toggle('bg-yellow-400');
    e.target.innerText = contenteditable.value ? "Done" : "Edit"
    if (!contenteditable.value) {
        formEdit();
    }
}

function formatDate(date) {
    const dateTime = new Date(date)
    const months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    const day = dateTime.getDate();
    const month = months[dateTime.getMonth()];
    const year = dateTime.getFullYear();

    return `${day} ${month} ${year}`;
}
</script>