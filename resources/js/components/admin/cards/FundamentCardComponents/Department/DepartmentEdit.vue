<template>
    <form class="card-body" @keypress.enter="save">

        <cardHeader>
            Выбрать отделение
            <Dropdown id="DepartmentDropdown" :header="getCurrentDepartment.name"
                      :items="getDepartmentDropdown" @clickEvent="switcher"/>
        </cardHeader>

        <hr>

        <inputText code="editDep"
                   :valueInput="getCurrentDepartment.name"
                   alias="Название" inputName="editName"/>

        <div class="row">
            <SaveButton target="#saveDep"/>
            <DeleteButton target="#deleteDep"/>
        </div>

        <BootstrapModalConfirm id="saveDep" @confirmEvent="save"></BootstrapModalConfirm>
        <BootstrapModalConfirm id="deleteDep" @confirmEvent="deleteD"></BootstrapModalConfirm>

    </form>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "DepartmentCard",
        computed: {
            ...mapGetters(['getCurrentDepartment', 'getDepartmentDropdown'])
        },
        methods: {
            ...mapActions(['switchDepartment', 'saveDepartment', 'deleteDepartment']),
            switcher(event) {
                this.switchDepartment(event.target.id);
            },
            save() {
                const data = {
                    code: this.getCurrentDepartment.code
                }

                $(`div.departments input[name=editName]`).val() ? data.name = $('div.departments input[name=editName]').val() : false;

                this.saveDepartment(data);
            },
            deleteD() {
                const data = {
                    code: this.getCurrentDepartment.code
                }
                this.deleteDepartment(data);
            }
        }
    }
</script>

<style scoped>

</style>
