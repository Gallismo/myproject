<template>
    <select class="form-control btn-secondary" :disabled="isDisabled" @change="change">
        <option value="" selected>{{defaultValue}}</option>
        <option v-for="(name, code) in items" :key="code" :value="code" :id="code">{{name}}</option>
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
