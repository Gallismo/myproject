<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Панель администратора</a>
            <CollapseToggler target_id="#navbar" ref="button"></CollapseToggler>
            <NavbarCollapse id="navbar" @switchTab="switchTab"></NavbarCollapse>
        </nav>
    </header>
</template>

<script>
    export default {
        name: "Header",
        methods: {
            switchTab: function (name) {
                this.$emit('switchTab', name);
                const elem = this.$refs.button.$el;
                if (elem.attributes.getNamedItem('aria-expanded').value === 'true') {
                    elem.click();
                }
            }
        }
    }
</script>

<style scoped>

</style>
