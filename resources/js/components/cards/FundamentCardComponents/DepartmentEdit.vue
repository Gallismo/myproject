<template>
    <form class="card-body">

        <cardHeader>
            Выбрать отделение
            <Dropdown id="DepartmentDropdown" :header="getCurrentDepartment.name"
                      :items="getDepartmentDropdown" @clickEvent="switcher"/>
        </cardHeader>

        <hr>

        <inputText :code="getCurrentDepartment.code"
                   :valueInput="getCurrentDepartment.name"
                   alias="Название" inputName="editName"/>

        <div class="row">
            <SaveButton target="#save"/>
            <DeleteButton target="#delete"/>
        </div>

        <BootstrapModalConfirm id="save" @confirmEvent="save"></BootstrapModalConfirm>
        <BootstrapModalConfirm id="delete" @confirmEvent="deleteD"></BootstrapModalConfirm>

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

                $(`input[name=editName]`).val() ? data.name = $('input[name=editName]').val() : false;

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
