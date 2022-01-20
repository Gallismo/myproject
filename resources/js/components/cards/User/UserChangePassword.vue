<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="userPassword" @keypress.enter="openModalSave">

            <h5 class="card-title">{{getCurrentUser.login}}</h5>
            <inputText code="password" alias="Новый пароль" placeholder="Пароль" inputName="password"/>

            <div class="row mt-4">
                <SaveButton target="#changeConfirm" title="Изменить пароль"/>
            </div>

        </form>

        <BootstrapModalConfirm id="changeConfirm" @confirmEvent="save"></BootstrapModalConfirm>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "UserEdit",
        methods: {
            ...mapActions(['changePassword']),
            openModalSave() {
                $('#saveConfirm').modal('show');
            },
            save() {
                const data = {
                    login: $('#userPassword .card-title').text(),
                    password: $('#userPassword input[name=password]').val(),
                };

                this.changePassword(data);
            },
        },
        computed: {
            ...mapGetters(['getCurrentUser'])
        }
    }
</script>

<style scoped>

</style>
