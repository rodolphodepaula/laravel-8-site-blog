<template>
    <div :class="'col-sm-' + (sm || '6') + ' col-md-' + (md || '4')">
        <div class="thumbnail">
            <img
                alt="Bootstrap Image Preview"
                :src="imagem"
                class="img-thumbnail"
            />

            <div class="caption">
                <small>{{ data | formataData }} - {{ autor }}</small>
                <h3>{{ titulo }}</h3>
                <p>
                    {{ descricao }}
                </p>
                <p>
                    <a :href="link" class="btn btn-primary" role="button"
                        >Leia Mais</a
                    >
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        "titulo",
        "descricao",
        "link",
        "imagem",
        "data",
        "autor",
        "sm",
        "md"
    ],
    filters: {
        formataData: function(valor) {
            if (!valor) return "";
            valor = valor.toString();
            if (valor.split("-").length == 3) {
                valor = valor.substring(0, 10);
                valor = valor.split("-");

                return valor[2] + "/" + valor[1] + "/" + valor[0];
            }
            return valor;
        }
    }
};
</script>

<style>
.thumbnail {
    background: #fbfbfb;
}
.caption > h3 {
    font-weight: bold;
    text-transform: uppercase;
}
.caption > p {
    font-size: 0.9rem;
}
</style>
