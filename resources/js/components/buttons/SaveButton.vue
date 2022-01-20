<template>
    <button class="btn btn-outline-success text-white col-12 mb-2"
            type="button" data-toggle="modal" :data-target="target"
            :disabled="isDisabled">{{title}}</button>
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
            },
            title: {
                type: String,
                default: 'Сохранить'
            }
        }
    }
</script>

<style scoped>

</style>
