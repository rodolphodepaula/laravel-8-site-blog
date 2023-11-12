<template>
    <nav class="navbar navbar-expand-md navbar-light shadow-sm topo-st">
        <div class="container">
            <a class="navbar-brand" v-bind:href="url">
                {{ titulo }}
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <slot></slot>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    props: ["titulo", "url"]
};
</script>

<style>
.topo-st {
    background: #efefef;
}
.navbar-brand {
    font-weight: bold;
    font-size: 24px;
    font-style: italic;
}

.navbar-light .navbar-brand:hover {
    color: rgb(0 0 0 / 82%) !important;
}

.dropdown-item.active,
.dropdown-item:active {
    color: #000;
    text-decoration: none;
    background-color: #efefef !important;
}
</style>
