// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: {
    enabled: true,
  },
  app: {
    head: {
      title: "dotBlog",
      charset: "utf-8",
      viewport: "width=device-width, initial-scale=1",
      meta: [
        {
          name: "description",
          content:
            "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        },
      ],
    },
  },
  modules: [
    "@nuxt/image",
    '@nuxt/ui',
    '@formkit/auto-animate/nuxt',
    [
      '@pinia/nuxt',
      {
        autoImports: ['defineStore', 'acceptHMRUpdate'],
      },
    ],
  ],
  imports: {
    dirs: ['stores'],
  },
  runtimeConfig: {
    public: {
      apiBase: "http://127.0.0.1:8000",
    },
  },
  image: {
    quality: 10,
  },
  colorMode: {
    preference: 'light'
  },
  plugins: [
    '~/plugins/ShowAlert'
  ],
});
