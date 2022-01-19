<template>
    <select class="form-control btn-secondary" :disabled="isDisabled" @change="change">
        <option :value="defaultValue" selected>{{defaultTitle}}</option>
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
        defaultTitle: {
            type: String,
            default: 'Выберите'
        },
        defaultValue: {
            type: Number,
            default: ''
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
