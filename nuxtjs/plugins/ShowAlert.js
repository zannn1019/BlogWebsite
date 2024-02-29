export default defineNuxtPlugin(() => {
    const toast = useToast();
    return {
        provide: {
            showAlert: (apiResponse) => {
                if (apiResponse && apiResponse.success === false && apiResponse.message) {
                    if (typeof apiResponse.message === 'string') {
                        toast.add({
                            title: apiResponse.message,
                            icon: 'i-heroicons-x-circle',
                            color: 'red'
                        })
                    } else if (typeof apiResponse.message === 'object') {
                        Object.keys(apiResponse.message).forEach((key) => {
                            toast.add({
                                title: apiResponse.message[key][0],
                                icon: 'i-heroicons-x-circle',
                                color: 'red'
                            })
                        });
                    }
                } else {
                    toast.add({
                        title: apiResponse.message,
                        icon: 'i-heroicons-check-circle',
                        color: 'primary'
                    })
                }
            }
        }
    }
})
