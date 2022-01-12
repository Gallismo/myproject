<template>
    <button class="btn btn-outline-success text-white" :class="col"
            type="button" @click="$emit('clickButton')">{{name}}</button>
</template>

<script>
    export default {
        name: "CreateButton",
        props: {
            name: {
                type: String,
                default: 'Создать'
            },
            col: {
                type: String,
                default: 'col-12'
            }
        }
    }
</script>

<style scoped>

</style>
