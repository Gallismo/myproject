<template>
    <div class="card bg-dark text-white">
        <form class="card-body">
            <div class="card-text row align-items-center justify-content-around">
                Выбрать группу
                <GroupDropdown id="GroupDropdown" class="mb-1 col-lg-6"></GroupDropdown>
            </div>
            <formGroup
                :getter="getter" :name="name"
                :title="input.title" :isDisabled="formDisabled"
                v-for="(input, name) in inputs"
                :key="name"
                @throwValue="commitValue"
            >
            </formGroup>
            <button class="btn btn-outline-secondary text-white" type="button" @click="allowEditSwitch">Редактировать</button>
            <button class="btn btn-outline-secondary text-white" type="submit" @click="submitChanges">Сохранить</button>
        </form>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    export default {
        name: "groupDescription",
        data() {
            return {
                formDisabled: true,
                getter: 'getCurrentGroup',
                inputs: {
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
        computed: {
            ...mapGetters(['getCurrentGroup']),
        },
        methods: {
            ...mapActions(['editGroup', 'getGroups']),
            allowEditSwitch(event) {
                if (this.formDisabled) {
                    event.target.innerText = "Отменить редактирование"
                } else {
                    event.target.innerText = "Редактировать"
                }
                this.formDisabled=!this.formDisabled
            },
            submitChanges() {
                const data = {
                    name: this.getCurrentGroup.name,
                    name_new: this.inputs.name.value
                };
                this.editGroup(data);
            },
            commitValue(data) {
                this.inputs[data.name].value = data.value
            }
        }
    }
</script>

<style scoped>

</style>
