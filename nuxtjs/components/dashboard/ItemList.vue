<template>
    <div
        class="border hover:shadow-xl transition-all duration-200 shadow h-16 rounded-xl bg-white flex justify-between w-full items-center overflow-hidden relative">
        <div class="flex h-full gap-2 relative">
            <div class="w-36 relative justify-center items-center flex">
                <h1 class="text-white absolute font-bold text-xl left-10 z-30">#{{ no }}</h1>
                <img :src="image ? config.public.apiBase + '/storage/posts_thumbnail/' + image : 'https://img.freepik.com/free-photo/colorful-design-with-spiral-design_188544-9588.jpg'"
                    alt="" class="object-cover w-full h-full brightness-50"
                    style="clip-path: polygon(0 0, 45% 0, 100% 100%, 0% 100%);">
            </div>
            <div class="flex flex-col p-2 z-10 justify-center">
                <span class="capitalize"><b>{{ title }}</b></span>
                <p class="text-sm text-gray-500 max-w-96 truncate">{{ descriptions }}</p>
            </div>
        </div>
        <div class="flex flex-wrap gap-2 p-2 px-4">
            <UButton icon="i-heroicons-eye" variant="outline" color="blue" class="hover:bg-blue-500 hover:text-white"
                @click="toggleEmitsValue(data, 0)" v-if="showDetailBtn" />
            <UButton icon="i-heroicons-pencil-square" variant="outline" class="hover:bg-green-500 hover:text-white"
                @click="toggleEmitsValue(data, 1)" />
            <UButton icon="i-heroicons-trash" variant="outline" color="red" class="hover:bg-red-500 hover:text-white"
                @click="toggleEmitsValue(data, 2)" />
        </div>
    </div>
</template>

<script setup>
const emits = defineEmits(['isEdit', 'isDelete', 'isShow']);
const props = defineProps({
    no: Number,
    title: String,
    descriptions: String,
    image: String,
    data: Object,
    showDetailBtn: Boolean
});
const config = useRuntimeConfig()

function toggleEmitsValue(data, type) {
    switch (type) {
        case 0:
            emits('isShow', { data: { ...data }, status_show: true });
            break;
        case 1:
            emits('isEdit', { data: { ...data }, status_edit: true });
            break;
        case 2:
            emits('isDelete', { data: { ...data }, status_delete: true });
            break;
        default:
            break;
    }
}
</script>
