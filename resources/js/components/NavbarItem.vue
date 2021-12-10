<template>
    <li class="nav-item">
        <a class="nav-link" href="#" @click="switchTab" :id="name[0]">{{name[1]}}</a>
    </li>
</template>

<script>
    import {mapGetters, mapActions, mapMutations, mapState} from 'vuex';
    export default {
        name: "NavbarItem",
        props: {
            name: {
                type: Array,
                required: true
            }
        },
        methods: {
            switchTab: function (event) {
                if (event.target.id === 'Logout') {
                    alert('Logout');
                    return;
                }
                this.switchAction(event);
            },
            ...mapActions({
                switchAction: 'switchTab'
            })
        }
    }
</script>

<style scoped>

</style>
