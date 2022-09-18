<template>
    <div class="form-group">
        <div class="input-group date" :id="id">
            <label v-if="id" :for="id">{{alias}}<slot></slot></label>
            <input type="text" class="form-control btn-secondary" :placeholder="placeholder" autocomplete="off"
                   :name="inputName" :value="valueInput" @keypress.enter="change" @input="change" :disabled="isDisabled">
        </div>
    </div>
</template>

<script>
    export default {
        name: "inputTime",
        mounted() {
            $(this.id).datetimepicker({
                format: 'LT'
            })
        },
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
            id: {
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
