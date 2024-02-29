<template>
    <div>
        <UPopover v-model:open="showPopover" :popper="{ placement: 'top-end' }">
            <UAvatar :alt="authUser.name" size="md" class="bg-zinc-300 cursor-pointer"
                @click="showPopover = !showPopover" />
            <template #panel>
                <div class="p-2 flex flex-col gap-1 w-48">
                    <nuxt-link to="/dashboard" class="p-2 px-4 hover:bg-gray-200 rounded-md flex items-center gap-2">
                        <UIcon name="i-heroicons-computer-desktop-solid" />
                        Dashboard
                    </nuxt-link>
                    <UButton icon="i-heroicons-arrow-left-start-on-rectangle"
                        class="bg-white shadow-none px-4 py-2 text-red-500 rounded-md hover:shadow-xl hover:bg-red-500 hover:text-white "
                        @click="logoutConfirm = true" v-if="apiToken" label="Logout" />
                </div>
            </template>
        </UPopover>
        <UModal v-model="logoutConfirm">
            <div class="p-4 py-10 flex flex-col items-center gap-2">
                <UIcon name="i-heroicons-exclamation-triangle" class="text-6xl text-red-500" />
                <h1 class="text-xl font-semibold">Do you really wish to log out?</h1>
                <div class="flex gap-2">
                    <UButton label="Yes, Log Out"
                        class="bg-green-400 px-4 py-2 text-white rounded-md shadow-xl hover:bg-green-500" @click="logout" />
                    <UButton label="No, Cancel"
                        class="bg-red-400 px-4 py-2 text-white rounded-md shadow-xl hover:bg-red-500"
                        @click="logoutConfirm = false" />
                </div>
            </div>
        </UModal>
    </div>
</template>

<script setup>
const authUser = useCookie("user");
const showPopover = ref(false);
const apiToken = useCookie("api_token");
const logoutConfirm = ref(false);
const toast = useToast();
const auth = useAuth();

function logout() {
    auth.logout()
    toast.add({
        title: "User is logout successfully",
        color: "primary",
        icon: 'i-heroicons-check-circle'
    })
    logoutConfirm.value = false;
}
</script>