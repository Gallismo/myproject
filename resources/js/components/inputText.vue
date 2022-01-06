<template>
    <div class="form-group">
        <label :for="code">{{alias}}</label>
        <input type="text" class="form-control btn-secondary" :id="code" :name="inputName" :value="valueInput">
    </div>
</template>

<script>
    export default {
        name: "inputText",
        props: {
            alias: {
                type: String,
                default: '...'
            },
            valueInput: {
                type: String,
                default: ''
            },
            inputName: {
                type: String,
                default: '...'
            },
            code: {
                type: String,
                default: 'await'
            },
        }
    }
</script>

<style scoped>

</style>
