<template>
    <button class="btn btn-outline-danger text-white col-12"
            type="button" data-toggle="modal" :data-target="target"
            :disabled="isDisabled" @click="click">Удалить</button>
</template>

<script>
    export default {
        name: "DeleteButton",
        props: {
            target: {
                type: String
            },
            isDisabled: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            click(event) {
                this.$emit('clickButton', event);
            }
        }
    }
</script>

<style scoped>

</style>
