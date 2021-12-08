<template>
    <div class="card bg-dark text-white container mt-lg-5 mt-4">
        <div class="card-body">
            <component v-bind:is="tab"></component>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Card",
        props: {
            tab: {
                type: String
            }
        }
    }
</script>

<style scoped>

</style>
