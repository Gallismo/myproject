<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Панель администратора</a>
            <CollapseToggler target_id="#navbar"></CollapseToggler>
            <NavbarCollapse id="navbar"></NavbarCollapse>
        </nav>
    </header>
</template>

<script>
    export default {
        name: "Header"
    }
</script>

<style scoped>

</style>
