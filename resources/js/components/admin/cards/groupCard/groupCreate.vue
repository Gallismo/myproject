<template>
    <div class="card bg-dark text-white">

        <form class="card-body" >

            <h5 class="card-title text-center text-danger" v-show="!getCurrentDepartment">
                Требуется наличие хотя бы одного отделения
            </h5>


            <formGroup
                :getter="getter" :name="name"
                :title="input.title" :isDisabled="formDisabled"
                v-for="(input, name) in inputs"
                :key="name"
                @throwValue="commitValue"
                :isDescription="false"
            />

            <div class="row button mt-2">
                <CreateButton @clickButton="submit" name="Добавить"/>
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
            ...mapGetters(['getCurrentGroup', 'getDepartmentDropdown', 'getCurrentDepartment']),
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

                    data['department_id'] = Object.keys(this.getDepartmentDropdown)
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

</style>
