<template>
    <div>
        <Header @switchTab="switchTab"></Header>
        <Card :tab="currentTab"></Card>
    </div>
</template>

<script>
    export default {
        name: "admin",
        data: function () {
            return {
                currentTab: "Groups"
            }
        },
        methods: {
            switchTab: function (name) {
                this.currentTab = name;
            }
        }
    }
</script>

<style scoped>

</style>
