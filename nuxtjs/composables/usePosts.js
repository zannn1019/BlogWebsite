export default function usePosts() {
  const config = useRuntimeConfig();
  const pending = ref(false)

  const getPosts = (pageNum) => {
    const { data: posts, pending } = useFetch(config.public.apiBase + "/api/post", {
      query: { page: pageNum },
      watch: [pageNum]
    });
  }

  return {
    getPosts,
    pending
  };
}
