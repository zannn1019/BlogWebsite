<template>
    <div ref="alertCover" v-auto-animate
        class="max-w-sm bg-black border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative overflow-hidden">
        <div class="action flex gap-1 absolute left-0 top-0 z-20 m-2" v-if="action">
            <button class="bg-yellow-400 px-4 py-2 text-white rounded-md shadow-xl hover:bg-yellow-500"
                @click="handleEdit">Edit</button>
            <button class="bg-red-500 px-4 py-2 text-white rounded-md shadow-xl hover:bg-red-600"
                @click="handleDelete">Delete</button>
        </div>
        <div class="relative flex justify-center items-center overflow-hidden">
            <NuxtImg class="rounded-t-lg hover:scale-150 brightness-50 transition-all duration-300 hover:brightness-75"
                :src="props.url" @click="showAction" width="500" height="375" crossorigin="anonymous"
                :alt="props.category" />
            <input class="font-bold text-white bg-transparent text-4xl z-10 absolute text-center" :value="props.category"
                :disabled="!editAction" :style="categoryInputStyle" @change="handleChange" ref="categoryInput" />
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    category: String,
    id: String,
    url: String,
})
const toast = useToast()


const config = useRuntimeConfig();

const action = ref(false);
const editAction = ref(false);

function showAction() {
    action.value = !action.value;
}

const categoryInput = ref(null)
function handleEdit() {
    editAction.value = !editAction.value;
}
async function handleDelete(e) {
    action.value = true;
    const apiResponse = await $fetch(config.public.apiBase + "/api/category/" + props.id, {
        method: "DELETE"
    });
    if (apiResponse.success) {
        toast.add({
            title: apiResponse.message,
            icon: 'i-heroicons-check-circle',
            color: 'primary'
        });
    } else {
        Object.keys(apiResponse).forEach((key) => {
            toast.add({
                title: apiResponse[key][0],
                icon: 'i-heroicons-x-circle',
                color: 'red'
            })
        });
    }
    // e.target.parentElement.parentElement.parentElement.remove();
    e.target.closest('div').remove();

}

const inputCategory = ref(null);
const inputColor = ref("white");
async function handleChange() {
    if (inputCategory.value) {
        const value = inputCategory.value.value;
        const apiResponse = await $fetch(config.public.apiBase + "/api/category/" + props.id, {
            method: "PATCH",
            body: JSON.stringify({
                category: value
            }),
            headers: {
                'Content-Type': 'application/json'
            },
        });

        if (apiResponse.success) {
            inputColor.value = "green";
            inputCategory.value.value = value;
        } else {
            console.error('Failed to update category:', apiResponse.statusText);
        }
    } else {
        console.error('Input field not available.');
    }
}

const categoryInputStyle = computed(() => ({
    border: editAction.value ? '5px solid ' + inputColor.value : '2px solid transparent',
    borderRadius: '5px',
}));
</script>
