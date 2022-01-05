<template>
    <button class="btn btn-outline-secondary text-white col-12 mb-2" type="button" @click="click">Редактировать</button>
</template>

<script>
    export default {
        name: "editButton",
        methods: {
            click(event) {
                this.$emit('clickButton', event);
            }
        }
    }
</script>

<style scoped>

</style>
