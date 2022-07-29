<template>
    <div>
        <h1 class="text-center">Boolpress</h1>
        <div class="row g-2">
            <div v-for="post in posts" :key="post.id" class="col-sm-6 col-md-4">
                <div class="card h-100">
                    <img :src="post.image" class="card-img-top" :alt="post.title">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ post.title }}</h5>
                        <p class="card-text mb-auto">{{ post.excerpt }}</p>
                        <a :href="baseUrl + '/posts/' + post.slug" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>

    export default {
        name: 'PageBlog',
        data(){
            return{
                baseUrl: window.location.origin,
                posts: [],
                // page: 1
            }
        },
        created(){
            axios.get('api/posts') //http://localhost:8000/
                .then(res => {
                    this.posts= res.data.response.data;
                    // this.page= res.data.response.current_page;
                    console.log(res);
                })
                .catch(error => console.log('errore!'));
        }
    }
</script>

<style lang="scss" scoped>

</style>
