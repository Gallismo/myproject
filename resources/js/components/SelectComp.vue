<template>
    <select class="form-control btn-secondary" @change="change">
        <option :value="defaultValue" :selected="defaultValue" :disabled="isDisabled" v-if="defaultValue || defaultTitle">{{defaultTitle}}</option>
        <option v-for="(name, code) in items" :selected="name === select" :key="code" :value="code" :id="code">{{name}}</option>
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
            default: ''
        },
        select: {
            type: String
        },
        defaultValue: {
            type: String || Number,
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
