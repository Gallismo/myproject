<template>
    <button class="btn btn-outline-success text-white col-12"
            type="button" @click="$emit('clickButton')">{{name}}</button>
</template>

<script>
    export default {
        name: "CreateButton",
        props: {
            name: {
                type: String,
                default: 'Создать'
            }
        }
    }
</script>

<style scoped>

</style>
