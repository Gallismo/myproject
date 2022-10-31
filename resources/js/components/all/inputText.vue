<template>
    <div class="form-group">
        <label v-if="code" :for="code">{{alias}}<slot></slot></label>
        <input type="text" class="form-control btn-secondary" :placeholder="placeholder" :id="code" autocomplete="off"
               :name="inputName" :value="valueInput" @keypress.enter="change" @input="change" :disabled="isDisabled">
    </div>
</template>

<script>
    export default {
        name: "inputText",
        props: {
            alias: {
                type: String,
                default: ''
            },
            valueInput: {
                default: ''
            },
            inputName: {
                type: String,
                default: '...'
            },
            code: {
                type: String
            },
            placeholder: {
                type:String
            },
            isDisabled: {
                type: Boolean
            }
        },
        methods: {
            change(event) {
                event.preventDefault();
                this.$emit('changeEvent', event);
            },

        }
    }
</script>

<style scoped>

</style>
