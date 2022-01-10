<template>
    <select class="form-control btn-secondary" :disabled="isDisabled">
        <option :value="defaultValue" selected @click="change">{{defaultValue}}</option>
        <option v-for="(name, code) in items" :key="code" :value="name" :id="code" @click="change">{{name}}</option>
    </select>
</template>

<script>
export default {
    name: "SelectComp",
    props: {
        isDisabled: {
            type: Boolean,
            default: false
        },
        items: {
            type: Object,
            required: true
        },
        defaultValue: {
            type: String,
            default: 'Выберите'
        }
    },
    methods: {
        change(event) {
            this.$emit('clickEvent', event)
        }
    }
}
</script>

<style scoped>

</style>
