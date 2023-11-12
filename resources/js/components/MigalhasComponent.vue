<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li
                v-for="(item, index) in lista"
                :key="index"
                class="breadcrumb-item"
            >
                <a v-if="item.url" :class="defineClass" :href="item.url">{{
                    item.titulo
                }}</a>
                <span v-if="!item.url">{{ item.titulo }}</span>
            </li>
        </ol>
    </nav>
</template>

<script>
export default {
    props: ["lista"],
    /* mounted: function() {
        console.log(this.lista);
    } */
    computed: {
        defineClass: function() {
            if (this.url) {
                return "breadcrumb-item active";
            } else {
                return "";
            }
        }
    }
};
</script>

<style></style>
