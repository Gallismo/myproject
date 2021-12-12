<template>
    <div class="form-group">
        <label :for="name">{{title}}</label>
        <input type="text" class="form-control bg-dark text-white" :disabled="isDisabled"
               :id="name" aria-describedby="emailHelp"
               ref="kutak" v-model="value"
               @input="throwValue"
        >
    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "formGroup",
        mounted() {
            this.value = this.$store.getters[this.getter][this.name]
        },
        data() {
            return {
                value: ''
            }
        },
        methods: {
            throwValue(event) {
                const data = {
                    name: event.target.id,
                    value: this.value
                };
                this.$emit('throwValue', data)
            }
        },
        props: {
            name: {
                type: String,
                required: true
            },
            getter: {
                type: String,
                required: true
            },
            title: {
                type: String,
                required: true
            },
            isDisabled: {
                type: Boolean,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
