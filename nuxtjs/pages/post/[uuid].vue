<template>
    <div>
        {{ uuid }}
    </div>
</template>

<script setup>
const { uuid } = useRoute().params
console.log(uuid)
</script>