<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Панель администратора</a>
            <CollapseToggler target_id="#navbar" ref="button"></CollapseToggler>
            <NavbarCollapse id="navbar"></NavbarCollapse>
        </nav>
    </header>
</template>

<script>
    import {mapGetters} from 'vuex';
    export default {
        name: "Header",
        computed: {
            ...mapGetters({
                currentTab: 'getCurrentTab'
            })
        },
        watch: {
            currentTab: function () {
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
