<template>
    <div class="card bg-dark text-white">
        <form class="card-body">

            <div class="card-text row align-items-center justify-content-around">
                Выбрать отделение
                <Dropdown id="DepartmentDropdown" class="mb-1 col-6"
                :header="getCurrentDepartment.name" :items="getDepartmentDropdown"
                @clickEvent="switcher"/>
            </div>

            <hr>

            <inputText :code="getCurrentDepartment.code"
                       :valueInput="getCurrentDepartment.name"
                       alias="Название" inputName="name"/>

            <div class="row">
                <SaveButton target="#save"/>
                <DeleteButton target="#delete"/>
            </div>

        </form>

        <BootstrapModalConfirm id="save" @confirmEvent="save"></BootstrapModalConfirm>
        <BootstrapModalConfirm id="delete" @confirmEvent="deleteD"></BootstrapModalConfirm>
    </div>
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

                $('input[name=name]').val() ? data.name = $('input[name=name]').val() : false;

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
