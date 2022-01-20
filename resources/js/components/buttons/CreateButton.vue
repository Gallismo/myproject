<template>
    <button class="btn btn-outline-success text-white" :class="col"
            type="button" @click="$emit('clickButton')">
        {{name}}
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-patch-plus" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
        </svg>
    </button>
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
