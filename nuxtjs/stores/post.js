export const usePost = defineStore("post", () => {
    const config = useRuntimeConfig()
    const { $showAlert } = useNuxtApp();

    async function add() {

    }

    async function destroy(postUuid, refresh) {
        const apiResponse = await $fetch(config.public.apiBase + "/api/post/" + postUuid, {
            method: "DELETE",
            headers: {
                Authorization: `Bearer ${useCookie('api_token').value}`
            }
        });
        if (refresh) {
            refresh()
        }
        $showAlert(apiResponse);
    }
    return { add, destroy }
})
