<template>
    <div class="flex flex-col h-full justify-center items-center">
        <div class="flex gap-5 p-10">
            <div class="mr-auto place-self-center ">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    What Will You Discover Today? Explore Our Endless Blogosphere</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Answer
                    untold questions, uncover hidden gems, and embark on a journey of knowledge.
                    payment stack.</p>
                <NuxtLink to="/post"
                    class="inline-flex items-center bg-blue-500 justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Browse posts
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </NuxtLink>
                <NuxtLink to="/categories"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    See categories
                </NuxtLink>
            </div>
            <div class="hidden lg:mt-0 lg:flex w-5/12 relative">
                <img src="https://img-aws.ehowcdn.com/877x500p/s3-us-west-1.amazonaws.com/contentlab.studiod/getty/09f698e165f545fbb10f6c8fda98a174.jpg?type=webp"
                    alt="mockup" class="rounded-xl shadow-2xl">
                <img src="https://images.unsplash.com/photo-1503220317375-aaad61436b1b?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHRyYXZlbHxlbnwwfHwwfHx8MA%3D%3D"
                    alt="mockup" class="rounded-xl shadow-xl absolute top-16 -left-10 -z-30">
                <img src="https://media.cnn.com/api/v1/images/stellar/prod/210104133055-beginner-gaming-pc.jpg?q=w_1110,c_fill"
                    alt="mockup" class="rounded-xl shadow-xl absolute -top-16 left-8 -z-20">
            </div>
        </div>
    </div>
</template>
