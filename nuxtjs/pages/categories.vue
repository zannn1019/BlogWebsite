<template>
    <div class="flex flex-col gap-5">
        <div v-if="pending">
            <Loading />
        </div>
        <section v-else>
            <DataNotFound v-if="categories.data.length == 0" />
            <div v-else
                class="w-full h-full p-5 border-t border-black grid grid-cols-4 place-items-center gap-5 max-lg:grid-cols-2 max-sm:grid-cols-1 ">
                <div v-for="category in categories.data" :key="category.id" v-auto-animate>
                    <CategoryCards :category="category.category" :id="category.id"
                        :url="`https://source.unsplash.com/800x600/?category=${category.category}`" ref="categoryCard" />
                </div>
            </div>
            <div class="flex justify-center items-center w-full h-20">
                <UPagination v-model="page" :page-count="categories.meta.per_page" :total="categories.meta.total"
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
        </section>
    </div>
</template>

<script setup>
const showForm = ref(false);
const { $showAlert } = useNuxtApp();
const page = ref(1);
const config = useRuntimeConfig();

const { data: categories, pending, refresh } = await useFetch(config.public.apiBase + "/api/category", {
    query: {
        page
    },
    watch: [page]
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

    $showAlert(apiResponse);
    if (apiResponse.success == true) {
        data.value.category = '';
        refresh()
    }
}

</script>