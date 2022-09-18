<template>
    <select class="form-control btn-secondary" @change="change">
        <option :value="defaultValue" :disabled="isDisabled" v-if="defaultValue || defaultTitle">{{defaultTitle}}</option>
        <option v-for="(name, id) in items" :selected="name === select" :key="'drop'+id" :value="id" :data-id="id">{{name}}</option>
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
