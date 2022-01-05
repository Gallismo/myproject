<template>
    <div class="card bg-dark text-white">
        <form class="card-body" @keypress.enter="submit">

            <div class="card-text row align-items-center justify-content-around">
                Создать группу
            </div>

            <hr>

            <formGroup
                :getter="getter" :name="name"
                :title="input.title" :isDisabled="formDisabled"
                v-for="(input, name) in inputs"
                :key="name"
                @throwValue="commitValue"
                :isDescription="false"
            />

            <div class="row button mt-5">
                <CreateButton @clickButton="submit"/>
                <ResetButton />
            </div>

        </form>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    export default {
        name: "groupDescription",
        data() {
            return {
                formDisabled: false,
                getter: 'getCurrentGroup'
            }
        },
        computed: {
            ...mapGetters(['getCurrentGroup', 'getDepartmentDropdown']),
            inputs: function () {
                return {
                    name: {
                        title: 'Название группы',
                        value: ''
                    },
                    department_name: {
                        title: 'Отделение',
                        value: ''
                    },
                    start_year: {
                        title: 'Год поступления',
                        value: ''
                    },
                    end_year: {
                        title: 'Год окончания',
                        value: ''
                    }
                }
            }
        },
        methods: {
            ...mapActions(['createGroup']),
            submit() {
                const data = {};
                this.inputs.name.value ? data['name'] = this.inputs.name.value : false;
                if (this.inputs.department_name.value) {

                    data['department_code'] = Object.keys(this.getDepartmentDropdown)
                                                .find(key =>
                                                    this.getDepartmentDropdown[key] === this.inputs.department_name.value
                                                )
                }
                this.inputs.start_year.value ? data['start_year'] = this.inputs.start_year.value : false;
                this.inputs.end_year.value ? data['end_year'] = this.inputs.end_year.value : false;
                this.createGroup(data);
                this.dropdownKey++;
            },
            commitValue(data) {
                this.inputs[data.name].value = data.value
            }
        }
    }
</script>

<style scoped>
    .button {
        height: ;
    }
</style>
