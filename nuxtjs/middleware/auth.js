export default defineNuxtRouteMiddleware((to, from) => {
    const toast = useToast();
    const apiToken = useCookie("api_token");
    const loggedIn = apiToken.value;

    if (!loggedIn) {
        return navigateTo('/register')
    }
});
