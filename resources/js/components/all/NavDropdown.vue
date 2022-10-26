<template>
    <li class="nav-item dropdown admin-dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        >
            {{ dropdown.name }}
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#"
               v-for="(item,index) in dropdown.items" :key="index"
               @click="switchTab"
               :id="index"
            >{{ item }}</a>
        </div>
    </li>
</template>

<script>
    import {mapActions} from "vuex";

    export default {
        name: "NavDropdown",
        methods: {
            ...mapActions(['switchTab'])
        },
        props: {
            id: String,
            dropdown: Object
        }
    }
</script>

<style scoped>

</style>
