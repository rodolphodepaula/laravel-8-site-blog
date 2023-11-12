/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue';
import Vuex from 'Vuex';
Vue.use(Vuex);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/* Vuex */
const store = new Vuex.Store({
    state: {
        item:{}
    },
    mutations: {
        setItem(state, obj) {
            state.item = obj;
        }
    }
});

/* Vue.component('example-component', require('./components/ExampleComponent.vue').default); */
Vue.component('ckeditor', require('vue-ckeditor2').default);
Vue.component('topo-component', require('./components/TopoComponent.vue').default);
Vue.component('painel-component', require('./components/PainelComponent.vue').default);
Vue.component('caixa-component', require('./components/CaixaComponent.vue').default);
Vue.component('pagina-component', require('./components/PaginaComponent.vue').default);
Vue.component('tabela-lista-component', require('./components/TabelaListaComponent.vue').default);
Vue.component('migalhas-component', require('./components/MigalhasComponent.vue').default);
Vue.component('modal-component', require('./components/Modal/ModalComponent.vue').default);
Vue.component('modal-link-component', require('./components/Modal/ModalLinkComponent.vue').default);
Vue.component('formulario-component', require('./components/FormularioComponent.vue').default);
Vue.component('busca-component', require('./components/BuscaComponent.vue').default);
Vue.component('rodape-component', require('./components/RodapeComponent.vue').default);
Vue.component('artigo-card-component', require('./components/ArtigoCardComponent.vue').default);





/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    mounted: function(){
        console.log("Inicio do página");
        document.getElementById('app').style.display = "block";

    }
});
