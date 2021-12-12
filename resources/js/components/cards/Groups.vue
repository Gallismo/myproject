<template >
    <div>
        <groupDescription class="col-12 col-md-6 col-lg-4">
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
            ...mapGetters(['getCurrentGroup', 'getGroupsData'])
        }
    }
</script>

<style scoped>

</style>
