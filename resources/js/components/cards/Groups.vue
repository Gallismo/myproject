<template >
    <div class="align-items-center">
        <groupDescription class="col-4">
            <Dropdown id="GroupDropdown" class="mb-1 col-6"></Dropdown>
        </groupDescription>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    export default {
        name: "Groups",
        async mounted() {
            this.getGroups()
        },
        methods: {
            ...mapActions(['getGroups'])
        },
        computed: {
            ...mapGetters(['getCurrentGroup'])
        }
    }
</script>

<style scoped>

</style>
