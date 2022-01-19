<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="userEdit" @keypress.enter="openModalSave">

            <inputText code="login" alias="Логин" inputName="login" :valueInput="getCurrentUser.login"/>
            <SelectComp :defaultTitle="getCurrentUser.role.name" :defaultValue="getCurrentUser.role.id"
                        :items="getRolesData"/>

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
        name: "UserEdit",
        methods: {
            ...mapActions(['saveUser', 'deleteUser']),
            openModalSave() {
                $('#saveConfirm').modal('show');
            }
        },
        computed: {
            ...mapGetters(['getCurrentUser'])
        }
    }
</script>

<style scoped>

</style>
