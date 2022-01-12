<template>
    <div class="card bg-dark text-white">

        <form class="card-body" @keypress.enter="submitChanges">

            <h5 class="card-title text-center text-danger" v-show="!getCurrentDepartment">
                Требуется наличие хотя бы одного отделения
            </h5>


            <formGroup
                :getter="getter" :name="name" :title="input.title"
                v-for="(input, name) in inputs" :key="name"
                @throwValue="commitValue"
                :isDescription="true"
            />

            <div class="row">
                <SaveButton target="#submitChanges"/>
                <DeleteButton target="#deleteThisGroup"/>
            </div>

        </form>


        <BootstrapModalConfirm id="submitChanges" @confirmEvent="submitChanges"></BootstrapModalConfirm>
        <BootstrapModalConfirm id="deleteThisGroup" @confirmEvent="deleteThisGroup"></BootstrapModalConfirm>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    export default {
        name: "groupDescription",
        data() {
            return {
                dropdownKey: 0,
                formDisabled: true,
                getter: 'getCurrentGroup'
            }
        },
        computed: {
            ...mapGetters(['getCurrentGroup', 'getDepartmentDropdown', 'getGroupsData', 'getCurrentDepartment']),
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
            ...mapActions(['editGroup', 'getGroups', 'deleteGroup']),
            allowEditSwitch(event) {
                if (this.formDisabled) {
                    event.target.innerText = "Отключить редактирование"
                } else {
                    event.target.innerText = "Редактировать"
                }
                this.formDisabled=!this.formDisabled
            },
            submitChanges() {
                const data = {
                    code: this.getCurrentGroup.code
                };
                this.inputs.name.value ? data['name'] = this.inputs.name.value : false;
                if (this.inputs.department_name.value) {

                    data['department_code'] = Object.keys(this.getDepartmentDropdown)
                                                .find(key =>
                                                    this.getDepartmentDropdown[key] === this.inputs.department_name.value
                                                )
                    data['department_name'] = this.inputs.department_name.value
                }
                this.inputs.start_year.value ? data['start_year'] = this.inputs.start_year.value : false;
                this.inputs.end_year.value ? data['end_year'] = this.inputs.end_year.value : false;
                this.editGroup(data);
                this.dropdownKey++;
            },
            deleteThisGroup() {
                const data = {
                    code: this.getCurrentGroup.code
                }
                this.deleteGroup(data)
            },
            commitValue(data) {
                this.inputs[data.name].value = data.value
            }
        }
    }
</script>

<style scoped>

</style>
