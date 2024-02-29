<template>
    <div class="h-screen overflow-auto w-full flex">
        <LayoutsSidebar />
        <div class="p-4 mt-14 sm:ml-64 w-full">
            <slot />
        </div>
    </div>
</template>

<script setup>
const authUser = useCookie('user');
</script>