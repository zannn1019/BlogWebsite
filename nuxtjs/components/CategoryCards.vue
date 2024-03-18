<template>
    <div ref="alertCover"
        class="max-w-sm bg-black border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative overflow-hidden">
        <div class="relative flex justify-center items-center overflow-hidden">
            <NuxtImg class="rounded-t-lg hover:scale-150 brightness-50 transition-all duration-300 hover:brightness-75"
                :src="props.url" @click="showAction" width="500" height="375" crossorigin="anonymous"
                :alt="props.category" />
            <p class="font-bold text-white bg-transparent text-4xl z-10 absolute text-center" >
                {{ props.category }}
            </p>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    category: String,
    id: String,
    url: String,
})
// const toast = useToast()

// const config = useRuntimeConfig();

// const action = ref(false);
// const editAction = ref(false);

// const inputCategory = ref(null);
// const inputColor = ref("white");

// function showAction() {
//     action.value = !action.value;
// }

// function handleEdit(e) {
//     editAction.value = !editAction.value;
//     e.target.classList.toggle('bg-yellow-400');
//     e.target.classList.toggle('hover:bg-yellow-500');
//     e.target.classList.toggle('bg-green-400');
//     e.target.classList.toggle('hover:bg-green-500');
//     e.target.innerText = editAction.value ? "Done" : "Edit"
//     if (!editAction.value) {
//         handleChange();
//     }
// }

// function handleInput(e) {
//     inputCategory.value = e.target.innerText;
// }

// async function handleDelete(e) {
//     action.value = true;
//     const apiResponse = await $fetch(config.public.apiBase + "/api/category/" + props.id, {
//         method: "DELETE"
//     });
//     if (apiResponse.success) {
//         toast.add({
//             title: apiResponse.message,
//             icon: 'i-heroicons-check-circle',
//             color: 'primary'
//         })
//     } else {
//         Object.keys(apiResponse).forEach((key) => {
//             toast.add({
//                 title: apiResponse[key][0],
//                 icon: 'i-heroicons-x-circle',
//                 color: 'red'
//             })
//         });
//     }
//     e.target.parentElement.parentElement.parentElement.remove()
// }

// async function handleChange() {
//     if (inputCategory.value) {
//         const apiResponse = await $fetch(config.public.apiBase + "/api/category/" + props.id, {
//             method: "PATCH",
//             params: {
//                 category: inputCategory.value
//             }
//         });
//         if (apiResponse.success == true) {
//             toast.add({
//                 title: apiResponse.message,
//                 icon: 'i-heroicons-check-circle',
//                 color: 'primary'
//             })
//         } else {
//             Object.keys(apiResponse).forEach((key) => {
//                 toast.add({
//                     title: apiResponse[key][0],
//                     icon: 'i-heroicons-x-circle',
//                     color: 'red'
//                 })
//             });
//         }
//     } else {
//         console.error('Input field not available.');
//     }
// }

// const categoryInputStyle = computed(() => ({
//     border: editAction.value ? '5px solid ' + inputColor.value : '2px solid transparent',
//     borderRadius: '5px',
// }));
</script>
