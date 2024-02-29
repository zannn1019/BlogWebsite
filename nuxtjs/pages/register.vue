<template>
    <div class="w-full h-full flex justify-center items-center">
        <div class="w-8/12 grid grid-cols-3 shadow-xl border rounded-xl overflow-hidden">
            <div class="w-full h-96">
                <img src="https://images.unsplash.com/photo-1503220317375-aaad61436b1b?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHRyYXZlbHxlbnwwfHwwfHx8MA%3D%3D"
                    alt="" class="h-full object-cover bg-center">
            </div>
            <form class="w-full col-span-2 p-5" @submit.prevent="handleRegister">
                <div class="w-full flex flex-col gap-2 mb-2">
                    <h1 class="text-xl font-semibold">Register</h1>
                    <span class="w-14 h-1 bg-orange-400"></span>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <UInput color="white" variant="outline" placeholder="Full name" size="xl" v-model="data.name"
                        required />
                    <UInput color="white" variant="outline" placeholder="Email" size="xl" type="email" v-model="data.email"
                        required />
                    <UInput color="white" variant="outline" placeholder="Password" size="xl" type="password"
                        v-model="data.password" required />
                </div>
                <input type="submit" value="REGISTER"
                    class="bg-slate-700 text-white px-5 py-2 cursor-pointer hover:bg-slate-950 mt-5">
            </form>
        </div>
    </div>
</template>

<script setup>
definePageMeta({
    middleware: ['guest']
})
const { $showAlert } = useNuxtApp()
const config = useRuntimeConfig();
const data = ref({
    name: '',
    email: '',
    password: ''
});

async function handleRegister() {
    const formData = new FormData();
    formData.append("name", data.value.name);
    formData.append("email", data.value.email);
    formData.append("password", data.value.password);
    const response = await $fetch(config.public.apiBase + "/api/register", {
        method: "POST",
        body: formData
    });

    $showAlert(response);
    if (response.success) {
        data.value = {
            name: '',
            email: '',
            password: ''
        }
    }
}
</script>