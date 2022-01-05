<template>
    <button class="btn btn-outline-danger text-white col-12"
            type="button" data-toggle="modal" :data-target="target"
            :disabled="isDisabled">Удалить</button>
</template>

<script>
    export default {
        name: "DeleteButton",
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
