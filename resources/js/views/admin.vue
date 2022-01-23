<template>
    <div>
        <Header/>
        <Card/>
        <NotificationBootstrap />
    </div>
</template>

<script>
    export default {
        name: "admin",
        mounted() {
            this.$store.dispatch('callAllData');
        }
    }
</script>

<style scoped>

</style>
