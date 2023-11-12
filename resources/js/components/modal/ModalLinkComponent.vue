<template>
    <span>
        <span v-if="item"></span>

        <span>
            <button
                v-if="!tipo || (tipo != 'button' && tipo != 'link')"
                type="button"
                :class="css || 'btn btn-primary'"
                data-toggle="modal"
                :data-target="'#' + nome"
                v-on:click="preencheFormulario()"
            >
                {{ titulo }}
            </button>

            <button
                v-if="tipo == 'button'"
                type="button"
                :class="css || 'btn btn-primary'"
                data-toggle="modal"
                :data-target="'#' + nome"
                v-on:click="preencheFormulario()"
            >
                {{ titulo }}
            </button>
            <a
                v-if="tipo == 'link'"
                href="#"
                :class="css || ''"
                data-toggle="modal"
                :data-target="'#' + nome"
                v-on:click="preencheFormulario()"
            >
                {{ titulo }}</a
            >
        </span>
    </span>
</template>

<script>
export default {
    props: ["tipo", "nome", "titulo", "css", "item", "url"],
    methods: {
        preencheFormulario: function() {
            axios.get(this.url + this.item.id).then(res => {
                console.log(res.data);
                this.$store.commit("setItem", res.data);
            });
            // this.$store.commit("setItem", this.item);
        }
    }
};
</script>

<style></style>
