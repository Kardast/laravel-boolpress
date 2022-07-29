<template>
    <div class="col-sm-6 col-md-4">

        <div class="card h-100">
            <img :src="post.image" class="card-img-top" :alt="post.title">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text mb-auto">{{ post.excerpt }}</p>
                <router-link :to="{name: 'show', params: {slug: post.slug} }" class="btn btn-primary">Read</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CardPost',
    props: {
        post: Object,
    }
}
</script>

<style lang="scss" scoped>

</style>
