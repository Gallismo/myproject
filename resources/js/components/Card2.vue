<template>
    <div class="card bg-dark text-white">
        <div class="card-header">
            {{group.name}}
        </div>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Card",
        props: {
            group: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
