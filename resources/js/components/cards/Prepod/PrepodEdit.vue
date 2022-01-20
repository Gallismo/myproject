<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="prepodEdit" @keypress.enter="openModalSave">

            <inputText code="name"alias="ФИО" placeholder="Иванов Иван Иванович" inputName="name" :valueInput="getCurrentPrepod.name"/>
            <label for="selectUser">Пользователь</label>
            <SelectComp :items="getUserDropdown" :select="getCurrentPrepod.login" id="selectUser"/>

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
            ...mapGetters(['getCurrentPrepod', 'getUserDropdown', 'getCurrentUser'])
        },
        methods: {
            ...mapActions(['savePrepod', 'deletePrepod']),
            save() {
                const data = {
                    name: $('form#prepodEdit input[name=name]').val(),
                    user_id: $('form#prepodEdit select').val(),
                    login: $('form#prepodEdit select option:selected').text(),
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
