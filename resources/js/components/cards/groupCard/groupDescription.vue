<template>
    <div class="card bg-dark text-white">
        <form class="card-body">
            <div class="card-text row align-items-center justify-content-around">
                Выбрать группу
                <GroupDropdown id="GroupDropdown" class="mb-1 col-6" :key="dropdownKey"></GroupDropdown>
            </div>
            <hr>
            <formGroup
                :getter="getter" :name="name"
                :title="input.title" :isDisabled="formDisabled"
                v-for="(input, name) in inputs"
                :key="name"
                @throwValue="commitValue"
            />
            <div class="row">
                <button class="btn btn-outline-secondary text-white col-12 mb-2" type="button" @click="allowEditSwitch">Редактировать</button>
                <button class="btn btn-outline-secondary text-white col-12" type="button" @click="submitChanges" :disabled="formDisabled">Сохранить</button>
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
                dropdownKey: 0,
                formDisabled: true,
                getter: 'getCurrentGroup',
            }
        },
        computed: {
            ...mapGetters(['getCurrentGroup']),
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
            ...mapActions(['editGroup', 'getGroups']),
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
                this.inputs.department_name.value ? data['department_name'] = this.inputs.department_name.value : false;
                this.inputs.start_year.value ? data['start_year'] = this.inputs.start_year.value : false;
                this.inputs.end_year.value ? data['end_year'] = this.inputs.end_year.value : false;
                this.editGroup(data);
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
