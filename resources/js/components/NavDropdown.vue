<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" :id="id" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        >
            {{ dropdown.name }}
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#" v-for="item in dropdown.items" :key="item">{{ item }}</a>
        </div>
    </li>
</template>

<script>
    export default {
        name: "NavDropdown",
        props: {
            id: String,
            dropdown: Object
        }
    }
</script>

<style scoped>

</style>
