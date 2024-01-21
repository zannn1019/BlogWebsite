<template>
    <div class="w-full h-96 flex justify-center items-center text-center flex-col gap-6">
        <h1 class="font-bold text-6xl">Welcome to <b class="text-teal-400">.blog</b></h1>
        <h2 class="text-xl text-gray-400">The place where we explore new ideas, inspirations, and
            insights together.</h2>
    </div>
    <div class="w-full h-screen flex flex-col my-5">
        <header class="p-5 text-xl flex gap-5 border-b border-black">
            <nuxt-link class="hover:underline cursor-pointer" @click=" changeCategory('All')">All</nuxt-link>
            <div v-for="category in dataCategories">
                <nuxt-link class="hover:underline cursor-pointer" @click="changeCategory(category.id)">
                    {{ category }}
                </nuxt-link>
            </div>
        </header>
        <main class="w-full h-full">

        </main>
    </div>
</template>

<script setup>
const config = useRuntimeConfig();

const category = ref('All');
const dataCategories = ref('all');
const dataPosts = ref(null);

onMounted(async () => {
    fetchDataCategories();
});

async function fetchDataCategories() {
    dataCategories.value = await useFetch(`${config.public.apiBase}/api/category`);
}

// async function fetchDataCategories() {
// }

// async function fetchDataPosts() {
//     try {
//         dataPosts.value = await useFetch(`${config.public.apiBase}/api/category/${category.value}`);
//     } catch (error) {
//         console.error('Error fetching posts:', error);
//     }
// }

// function changeCategory(categoryName) {
//     category.value = categoryName;
//     fetchDataPosts();
// }

// console.log(dataPosts);

</script>