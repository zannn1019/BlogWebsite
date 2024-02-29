<template>
    <div>
        <form @submit.prevent="handleLogin" class="p-10 flex flex-col gap-2 relative">
            <h1 class="text-xl font-semibold">Login</h1>
            <span class="w-14 h-1 bg-orange-400 mb-5"></span>
            <div class="flex items-center border-b mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                </svg>
                <UInput color="white" variant="none" placeholder="Email address" size="xl" v-model="data.email"
                    class="w-full" required />
            </div>
            <div class="flex items-center border-b mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M21 10h-8.35A5.99 5.99 0 0 0 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6a5.99 5.99 0 0 0 5.65-4H13l2 2l2-2l2 2l4-4.04zM7 15c-1.65 0-3-1.35-3-3s1.35-3 3-3s3 1.35 3 3s-1.35 3-3 3" />
                </svg>
                <UInput color="white" variant="none" placeholder="Password" type="password" size="xl" class="w-full"
                    v-model="data.password" required />
            </div>
            <div class="flex justify-between items-center mb-5">
                <input type="submit" value="LOGIN"
                    class="bg-slate-700 text-white px-5 py-2 w-24 cursor-pointer hover:bg-slate-950">
                <nuxt-link to="/" class="hover:underline">Forgot password?</nuxt-link>
            </div>
        </form>
    </div>
</template>

<script setup>
const emit = defineEmits(['isLogedIn'])
const auth = useAuth()
const data = ref({
    email: '',
    password: ''
})

async function handleLogin() {
    try {
        auth.login(data.value.email, data.value.password);
    } catch (e) {
        console.error(e);
    } finally {
        emit('isLogedIn', true);
    }
}

</script>