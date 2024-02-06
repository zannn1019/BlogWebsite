<template>
    <div v-if="showAlert" class="flex items-center p-4 mb-4 text-sm w-auto h-12"
        v-bind:class="props.succes ? 'text-green-500 border border-green-500 rounded-xl bg-green-100' : 'text-red-500 border border-red-500 rounded-xl bg-red-100'"
        role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            {{ props.message }}
        </div>
        <button @click="closeAlert" class="ml-auto">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.707 6.293a1 1 0 0 0 0 1.414L9.899 10l-3.192 3.293a1 1 0 0 0 1.414 1.414L11 11.414l3.293 3.192a1 1 0 1 0 1.414-1.414L12.414 10l3.192-3.293a1 1 0 1 0-1.414-1.414L11 8.586 7.707 5.293a1 1 0 0 0-1.414 0z">
                </path>
            </svg>
        </button>
    </div>
</template>

<script setup lang="ts">

const props = defineProps({
    succes: Boolean,
    message: String
})

const showAlert = ref(true);
const closeAlert = () => {
    showAlert.value = false;
}
</script>
