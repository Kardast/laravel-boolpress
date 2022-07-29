<template>
    <div>
        <nav-bar></nav-bar>
        <div class="container">
            <router-view></router-view>
            <!-- grazie a questo router hai a disposizione tutti i paths specificati in front.js -->
        </div>
    </div>
</template>

<script>
import NavBar from './components/NavBar.vue';

    export default {
        name: 'App',
    components: {
        NavBar,
    }
    }
</script>

<style lang="scss">
    @import 'bootstrap/scss/bootstrap';
</style>
