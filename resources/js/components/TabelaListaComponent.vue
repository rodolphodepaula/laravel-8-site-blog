<template>
    <div>
        <div class="row">
            <div class="col-sm-9">
                <a v-if="criar && !modal" :href="criar">Criar</a>
                <modal-link-component
                    v-if="criar && modal"
                    tipo="link"
                    nome="adicionar"
                    titulo="Criar"
                    css=""
                ></modal-link-component>
            </div>
            <div class="col-sm-3">
                <input
                    type="search"
                    placeholder="Buscar"
                    class="form-control"
                    v-model="buscar"
                />{{ buscar }}
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th
                        style="cursor: pointer"
                        v-on:click="ordenaColuna(index)"
                        v-for="(titulo, index) in titulos"
                        :key="index"
                    >
                        {{ titulo }}
                    </th>
                    <th v-if="detalhe || editar || deletar">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in lista" :key="index">
                    <td v-for="i in item" :key="i">{{ i | formataData }}</td>
                    <td v-if="detalhe || editar || deletar">
                        <form
                            v-bind:id="index"
                            v-if="deletar && token"
                            v-bind:action="deletar + item.id"
                            method="post"
                        >
                            <input
                                type="hidden"
                                name="_method"
                                value="DELETE"
                            />
                            <input
                                type="hidden"
                                name="_token"
                                v-bind:value="token"
                            />
                            <a v-if="detalhe && !modal" :href="detalhe"
                                >Detalhe |</a
                            >
                            <modal-link-component
                                v-if="detalhe && modal"
                                tipo="link"
                                nome="detalhe"
                                titulo="Detalhe |"
                                css=""
                                :item="item"
                                :url="detalhe"
                            ></modal-link-component>
                            <a v-if="editar && !modal" :href="editar">
                                Editar |</a
                            >
                            <modal-link-component
                                v-if="editar && modal"
                                tipo="link"
                                nome="editar"
                                titulo=" Editar |"
                                css=""
                                :item="item"
                                :url="editar"
                            ></modal-link-component>
                            <a href="#" v-on:click="executaForm(index)">
                                Deletar</a
                            >
                        </form>
                        <span v-if="!token">
                            <a v-if="detalhe && !modal" :href="detalhe"
                                >Detalhe |</a
                            >
                            <modal-link-component
                                v-if="detalhe && modal"
                                tipo="link"
                                nome="detalhe"
                                titulo="Detalhe |"
                                css=""
                                :item="item"
                                :url="detalhe"
                            ></modal-link-component>
                            <a v-if="editar && !modal" :href="editar">
                                Editar</a
                            >
                            <modal-link-component
                                v-if="editar && modal"
                                tipo="link"
                                nome="editar"
                                titulo=" Editar |"
                                css=""
                                :item="item"
                                :url="editar"
                            ></modal-link-component>
                        </span>

                        <span v-if="token && !deletar">
                            <a v-if="detalhe && !modal" :href="detalhe"
                                >Detalhe |</a
                            >
                            <modal-link-component
                                v-if="detalhe && modal"
                                tipo="link"
                                nome="detalhe"
                                titulo="Detalhe |"
                                css=""
                                :item="item"
                                :url="detalhe"
                            ></modal-link-component>
                            <a v-if="editar && !modal" :href="editar">
                                Editar</a
                            >
                            <modal-link-component
                                v-if="editar && modal"
                                tipo="link"
                                nome="editar"
                                titulo=" Editar |"
                                css=""
                                :item="item"
                                :url="editar"
                            ></modal-link-component>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: [
        "titulos",
        "itens",
        "criar",
        "detalhe",
        "editar",
        "deletar",
        "token",
        "ordem",
        "ordemcol",
        "modal"
    ],
    data: function() {
        return {
            buscar: "",
            ordemAux: this.ordem || "asc",
            ordemAuxCol: this.ordemcol || 0
        };
    },
    //Metodos, ação feita pelo usuário. Click
    methods: {
        executaForm: function(index) {
            document.getElementById(index).submit();
        },
        ordenaColuna: function(coluna) {
            this.ordemAuxCol = coluna;
            if (this.ordemAux.toLowerCase() == "asc") {
                this.ordemAux = "desc";
            } else {
                this.ordemAux = "asc";
            }
        }
    },
    filters: {
        formataData: function(valor) {
            if (!valor) return "";
            valor = valor.toString();
            if (valor.split("-").length == 3) {
                valor = valor.split("-");
                return valor[0] + "/" + valor[1] + "/" + valor[2];
            }
            return valor;
        }
    },
    computed: {
        lista: function() {
            /*ORDENAÇÃO*/
            let ordem = this.ordemAux;
            let ordemCol = this.ordemAuxCol;
            let lista = this.itens.data;

            ordem = ordem.toLowerCase();
            ordemCol = parseInt(ordemCol);

            if (ordem == "asc") {
                lista.sort(function(a, b) {
                    if (
                        Object.values(a)[ordemCol] > Object.values(b)[ordemCol]
                    ) {
                        return 1;
                    }
                    if (
                        Object.values(a)[ordemCol] < Object.values(b)[ordemCol]
                    ) {
                        return -1;
                    }
                    return 0;
                });
            } else {
                lista.sort(function(a, b) {
                    if (
                        Object.values(a)[ordemCol] < Object.values(b)[ordemCol]
                    ) {
                        return 1;
                    }
                    if (
                        Object.values(a)[ordemCol] > Object.values(b)[ordemCol]
                    ) {
                        return -1;
                    }
                    return 0;
                });
            }

            if (this.buscar) {
                // let busca = "php";
                return lista.filter(res => {
                    let keys = Object.keys(res);
                    for (let k = 0; k < keys.length; k++) {
                        if (
                            (res[keys[k]] + "")
                                .toLowerCase()
                                .indexOf(this.buscar.toLowerCase()) >= 0
                        ) {
                            return true;
                        }
                    }
                    return false;
                });
            }

            return lista;
        }
    }
};
</script>
