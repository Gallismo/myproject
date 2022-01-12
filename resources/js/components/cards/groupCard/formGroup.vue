<template>
    <div class="form-group">
        <label :for="name">{{title}}</label>
        <input type="text" class="form-control btn-secondary" :disabled="isDisabled"
               :id="name" aria-describedby="emailHelp"
               v-model="value"
               @input="throwValue"
               v-if="inputType"
               autocomplete="off"
               :placeholder="title"
        >
        <select class="form-control btn-secondary" :disabled="isDisabled"
                :id="name" aria-describedby="emailHelp"
                v-model="value"
                @change="throwValue"
                v-else
         >
            <option value="Выберите отделение" disabled selected class="text-secondary">Выберите отделение</option>
            <option v-for="(name, code) in getDepartmentDropdown" :key="code" :value="name" :id="code">{{name}}</option>
        </select>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "formGroup",
        mounted() {
            if (this.name === 'department_name') {
                this.inputType = false
            }
        },
        computed: {
            getCurrentGroup: function () {
                return this.$store.getters[this.getter]
            },
            ...mapGetters(['getDepartmentDropdown'])
        },
        watch: {
            getCurrentGroup: function () {
                if (this.getCurrentGroup) {
                    this.isDescription ? this.value = this.getCurrentGroup[this.name] : false;
                }
            },
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
                default: false
            },
            isDescription: {
                type: Boolean,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
