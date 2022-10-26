<template>
    <div class="collapse navbar-collapse" :id="id">
        <ul class="navbar-nav">
            <NavDropdown :id="index" :dropdown="item" v-for="(item, index) in this.getLinks.dropdowns"
                         :key="index"
            />
            <NavbarItem :name="[index, link]" v-for="(link, index) in this.getLinks.simpleLinks"
                        :key="index"
            />
            <li class="nav-item ml-lg-auto">
                <a class="nav-link" href="/logout">Выйти</a>
            </li>
        </ul>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    export default {
        name: "NavbarCollapse",
        props: ['id'],
        computed: {
            ...mapGetters(['getLinks'])
        }
    }
</script>

<style scoped>

</style>
