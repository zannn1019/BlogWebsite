export default defineNuxtRouteMiddleware((to, from) => {
    const toast = useToast();
    const apiToken = useCookie("api_token");

    if (apiToken.value) {
        toast.add({
            title: "Unauthorized",
            icon: 'i-heroicons-x-circle',
            color: 'red',
        })
        return navigateTo('/')
    }
});
