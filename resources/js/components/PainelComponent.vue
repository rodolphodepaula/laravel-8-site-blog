<template>
    <div class="card ">
        <div v-if="titulo" :class="defineCor">
            {{ titulo }}
        </div>

        <div class="card-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: ["titulo", "cor"],
    computed: {
        defineCor: function() {
            return "card-header " + (this.cor || " badge-light");
        }
    }
};
</script>
<style>
.blue {
    border-color: #d6e9d6;
}

.card-header {
    background: #f9f9f9;
}
.blue > .card-header {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}
.card-block {
    padding: 10px !important;
}
.card-title {
    font-weight: bold;
    text-transform: uppercase;
}
.card-text {
    font-size: 0.8rem;
}
</style>
