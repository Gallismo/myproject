<template>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            :data-target="target_id" :aria-controls="target_id"
            aria-expanded="false" aria-label="Переключатель навигации"
    >
        <span class="navbar-toggler-icon"></span>
    </button>
</template>

<script>
    export default {
        name: "CollapseToggler",
        props: {
            target_id: {
                type: String,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
