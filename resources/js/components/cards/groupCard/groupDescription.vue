<template>
    <div class="card bg-dark text-white">

        <a name="groups"/>

        <form class="card-body" @keypress.enter="submitChanges">

            <div class="card-text row align-items-center justify-content-around">
                Выбрать группу
                <GroupDropdown id="GroupDropdown" class="mb-1 col-6" :key="dropdownKey"/>
            </div>

            <hr>

            <formGroup
                :getter="getter" :name="name"
                :title="input.title" :isDisabled="formDisabled"
                v-for="(input, name) in inputs"
                :key="name"
                @throwValue="commitValue"
                :isDescription="true"
            />

            <div class="row">
                <editButton @clickButton="allowEditSwitch"/>
                <SaveButton target="#submitChanges" :isDisabled="formDisabled"/>
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
            ...mapGetters(['getCurrentGroup', 'getDepartmentDropdown', 'getGroupsData']),
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
            confirm() {

            },
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
