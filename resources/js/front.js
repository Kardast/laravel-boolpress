require('./bootstrap');

// window.Vue = require('vue');             importiamo la libreria Vue

import Vue from 'vue';                  // importiamo la libreria Vue (versione moderna di scriverlo)
import VueRouter from 'vue-router';     // importiamo la libreria vue-router
import App from './App.vue'; // importiamo il componente base App.vue e lo assegniamo alla variabile App

// importiamo tutti i componenti delle pagine
import PageHome from './pages/PageHome.vue';
import PageBlog from './pages/PageBlog.vue';
import PageAbout from './pages/PageAbout.vue';
import PageContacts from './pages/PageContacts.vue';
import PageShow from './pages/PageShow.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: PageHome,
    },
    {
        path: '/blog',
        name: 'blog',
        component: PageBlog,
    },
    {
        path: '/about',
        name: 'about',
        component: PageAbout,
    },
    {
        path: '/contacts',
        name: 'contacts',
        component: PageContacts,
    },
    {
        path: '/blog/:post',
        name: 'show',
        component: PageShow,
        props: true
    },
];

const router = new VueRouter({
    routes
});

Vue.use(VueRouter);                     // diciamo a Vue di usare il plugin vue-router

const app = new Vue({
    el: '#root',                        // id del componente nel file HTML dentro il quale opererà Vue
    render: h => h(App),                 // monta il componente App nell'elemento root
    router,
});
