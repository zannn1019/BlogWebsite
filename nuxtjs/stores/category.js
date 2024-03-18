export const useCategory = defineStore("category", () => {
    const config = useRuntimeConfig()
    const { $showAlert } = useNuxtApp();
    const toast = useToast()

    async function add(categoryName, refresh = null) {
        if (categoryName) {
            const formData = new FormData();
            formData.append('category', categoryName)
            const apiResponse = await $fetch(config.public.apiBase + "/api/category", {
                method: "POST",
                body: formData,
                headers: {
                    Authorization: `Bearer ${useCookie('api_token').value}`
                }
            });
            if (refresh) {
                refresh()
            }
            $showAlert(apiResponse);
        } else {
            toast.add({
                title: "Category name is required!",
                color: "red",
                icon: "i-heroicons-x-circle"
            })
        }
    }

    async function update(categoryUuid, categoryName, refresh) {
        const apiResponse = await $fetch(config.public.apiBase + "/api/category/" + categoryUuid, {
            method: "PATCH",
            body: {
                category: categoryName
            },
            headers: {
                Authorization: `Bearer ${useCookie('api_token').value}`
            }
        });
        if (refresh) {
            refresh()
        }
        $showAlert(apiResponse);
    }

    async function destroy(categoryUuid, refresh) {
        const apiResponse = await $fetch(config.public.apiBase + "/api/category/" + categoryUuid, {
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
    return { add, update, destroy }
})