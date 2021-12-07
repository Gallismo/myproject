<template>
    <div>
        <Header></Header>
        <component v-bind:is="currentTab"></component>
    </div>
</template>

<script>
    export default {
        name: "admin",
        data: function () {
            return {
                currentTab: "Card2"
            }
        }
    }
</script>

<style scoped>

</style>
