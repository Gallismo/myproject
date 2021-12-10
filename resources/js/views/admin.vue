<template>
    <div>
        <Header></Header>
        <Card :tab="currentTab"></Card>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    export default {
        name: "admin",
        computed: {
            ...mapGetters({
                currentTab: 'getCurrentTab'
            })
        }
    }
</script>

<style scoped>

</style>
