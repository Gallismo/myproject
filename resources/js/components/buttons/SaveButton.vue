<template>
    <button class="btn btn-outline-success text-white col-12 mb-2"
            type="button" data-toggle="modal" :data-target="target"
            :disabled="isDisabled">Сохранить</button>
</template>

<script>
    export default {
        name: "SaveButton",
        props: {
            target: {
                type: String,
                required: true
            },
            isDisabled: {
                type: Boolean,
                default: false
            }
        }
    }
</script>

<style scoped>

</style>
