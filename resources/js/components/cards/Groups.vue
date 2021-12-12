<template >
    <div>
        <groupDescription class="col-4" v-if="getGroupsData[0]">
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
