<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="prepodEdit" @keypress.enter="openModalSave">

            <inputText code="surname" alias="Фамилия" inputName="surname" :valueInput="getCurrentPrepod.surname"/>
            <inputText code="name" alias="Имя" inputName="name" :valueInput="getCurrentPrepod.name"/>
            <inputText code="middle_name" alias="Отчество" inputName="middle_name" :valueInput="getCurrentPrepod.middle_name"/>

            <div class="row mt-4">
                <SaveButton target="#saveConfirm"/>
                <DeleteButton target="#deleteConfirm"/>
            </div>

        </form>

        <BootstrapModalConfirm id="saveConfirm" @confirmEvent="save"></BootstrapModalConfirm>
        <BootstrapModalConfirm id="deleteConfirm" @confirmEvent="deleteD"></BootstrapModalConfirm>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    export default {
        name: "PrepodEdit",
        computed: {
            ...mapGetters(['getCurrentPrepod'])
        },
        methods: {
            ...mapActions(['savePrepod', 'deletePrepod']),
            save() {
                const data = {
                    surname: $('form#prepodEdit input[name=surname]').val(),
                    name: $('form#prepodEdit input[name=name]').val(),
                    middle_name: $('form#prepodEdit input[name=middle_name]').val(),
                    code: this.getCurrentPrepod.code
                };

                this.savePrepod(data);
            },
            deleteD() {
                const data = {
                    code: this.getCurrentPrepod.code
                };
                this.deletePrepod(data);
            },
            openModalSave() {
                $('#saveConfirm').modal('show');
            }
        }
    }
</script>

<style scoped>

</style>
