<template>
    <div class="flex flex-col gap-5">
        <div class="flex flex-col gap-2">
            <button class="bg-green-400 px-4 py-2 self-start text-white rounded-md shadow-xl" @click="show">New
                Category</button>
            <form method="post" @submit.prevent="categoryForm" v-if="showForm">
                <label for="title" class="block mb-2 text-xl font-medium text-gray-900">Category</label>
                <div class="w-full flex gap-2">
                    <input type="text" v-model="data.category"
                        class="bg-gray-50 border border-gray-500 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Enter your category name here!" required>
                    <button class="bg-blue-500 px-4 py-2 self-start text-white rounded-md shadow-xl">Submit</button>
                </div>
            </form>
        </div>
        <div v-if="pending">
            <Loading />
        </div>
        <section v-else
            class="w-full h-full p-5 border-t border-black grid grid-cols-4 place-items-center gap-5 max-lg:grid-cols-2 max-sm:grid-cols-1 ">
            <DataNotFound v-if="categories.categories.length == 0" />
            <div v-else v-for="category in categories.categories" :key="category.id" v-auto-animate>
                <CategoryCards :category="category.category" :id="category.id"
                    :url="`https://source.unsplash.com/800x600/?category=${category.category}`" ref="categoryCard" />
            </div>
        </section>
    </div>
</template>

<script setup>
const showForm = ref(false);
const toast = useToast()
const config = useRuntimeConfig();
const { data: categories, pending, refresh } = await useFetch(config.public.apiBase + "/api/category", {
    server: false
});

function show() {
    if (showForm.value) {
        showForm.value = false;
    } else {
        showForm.value = true;
    }
}

const data = ref({
    category: '',
});

async function categoryForm() {
    const formData = new FormData();
    formData.append('category', data.value.category)

    const apiResponse = await $fetch(config.public.apiBase + "/api/category", {
        method: "POST",
        body: formData
    });

    if (apiResponse.success == true) {
        data.value.category = '';
        toast.add({
            title: apiResponse.message,
            icon: 'i-heroicons-check-circle',
            color: 'primary'
        })
        refresh()
    } else {
        data.value.category = '';
        Object.keys(apiResponse).forEach((key) => {
            toast.add({
                title: apiResponse[key][0],
                icon: 'i-heroicons-x-circle',
                color: 'red'
            })
        });
    }
}

</script>