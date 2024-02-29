export const useAuth = defineStore('auth', () => {
    const config = useRuntimeConfig();
    const { $showAlert } = useNuxtApp();
    const jwtToken = useCookie("api_token");
    const authUser = useCookie("user");

    async function login(email, password) {
        const response = await $fetch(config.public.apiBase + '/api/login', {
            method: "POST",
            body: {
                email: email,
                password: password
            }
        })
        if (response.success) {
            jwtToken.value = response.data.token;
            authUser.value = JSON.stringify(response.data.user);
        }
        $showAlert(response);
    }

    function logout() {
        jwtToken.value = null;
        reloadNuxtApp({
            force: true
        })
        return jwtToken.value == null
    }
    return { login, logout }
})