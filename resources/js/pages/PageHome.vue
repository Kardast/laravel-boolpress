<template>
    <div>
    <h1 class="text-center">Benvenuti in Boolpress</h1>
    <div>
        <div class="row g-2">
            <!-- <CardPost v-for="post in posts" :key="post.id" :post="post" /> -->
            <div v-for="post in posts" :key="post.slug" class="col-sm-6 col-md-4">
                <router-link :to="{name: 'show', params: {slug: post.slug} }">
                    <img :src="post.image" :alt="post.title" class="img-fluid">
                </router-link>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
    name: 'PageHome',
        data() {
        return {
            posts: [],
        }
    },
    created() {
        axios.get('/api/posts/random')
            .then(res => {
                if (res.data.success) {
                    this.posts = res.data.result
                }
            })
    }
}
</script>

<style lang="scss" scoped>

</style>
