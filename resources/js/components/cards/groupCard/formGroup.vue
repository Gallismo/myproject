<template>
    <div class="form-group">
        <label :for="name">{{title}}</label>
        <input type="text" class="form-control btn-secondary" :disabled="isDisabled"
               :id="name" aria-describedby="emailHelp"
               ref="kutak" v-model="value"
               @input="throwValue"
               v-if="inputType"
        >
        <select class="form-control btn-secondary" :disabled="isDisabled"
                :id="name" aria-describedby="emailHelp"
                ref="kutak" v-model="value"
                @input="throwValue"
                v-else
         >
            <option>{{value}}</option>
        </select>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "formGroup",
        mounted() {
            this.value = this.getCurrentGroup[this.name]
            if (this.name === 'department_name') {
                this.inputType = false
            }
        },
        computed: {
            getCurrentGroup: function () {
                return this.$store.getters[this.getter]
            }
        },
        watch: {
            getCurrentGroup: function () {
                this.value = this.getCurrentGroup[this.name]
            }
        },
        data() {
            return {
                value: '',
                inputType: true
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
