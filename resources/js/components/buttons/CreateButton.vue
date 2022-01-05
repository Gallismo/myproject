<template>
    <button class="btn btn-outline-success text-white col-12"
            type="button" @click="$emit('clickButton')">Создать</button>
</template>

<script>
    export default {
        name: "CreateButton"
    }
</script>

<style scoped>

</style>
