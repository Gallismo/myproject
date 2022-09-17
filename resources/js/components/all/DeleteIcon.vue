<template>
    <div class="delete-icon" @click="deleteEvent">
        <img src="/img/delete-icon.svg">
    </div>
</template>

<script>
export default {
    name: "DeleteIcon",
    methods: {
        deleteEvent(event) {
            this.$emit('clickDelete', event)
        }
    }
}
</script>

<style scoped>

</style>
