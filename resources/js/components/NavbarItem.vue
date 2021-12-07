<template>
    <li class="nav-item">
        <a class="nav-link" href="#">{{name}}</a>
    </li>
</template>

<script>
    export default {
        name: "NavbarItem",
        props: {
            name: String
        }
    }
</script>

<style scoped>

</style>
