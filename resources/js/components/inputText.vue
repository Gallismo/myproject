<template>
    <div class="form-group">
        <label v-if="code" :for="code">{{alias}}</label>
        <input type="text" class="form-control btn-secondary" :placeholder="placeholder" :id="code" :name="inputName" :value="valueInput" @input="change">
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
                type: String,
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
            }
        },
        methods: {
            change(event) {
                this.$emit('changeEvent', event);
            },

        }
    }
</script>

<style scoped>

</style>
