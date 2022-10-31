<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="userCreate" @keypress.enter="create">

            <inputText code="login" alias="Логин" placeholder="Логин" inputName="login"/>
            <inputText code="name" alias="ФИО" placeholder="ФИО" inputName="name"/>
            <div class="pass-div">
                <inputText code="password" alias="Пароль" placeholder="Пароль" inputName="password">
                    <button type="button" class="btn btn-outline-secondary random-password" @click="generatePassword">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-dice-5" viewBox="0 0 16 16">
                            <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h10zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3H3z"/>
                            <path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm4-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                        </svg>
                    </button>
                </inputText>
            </div>
            <label for="selectRole">Роль</label>
            <SelectComp id="selectRole" :items="getRolesData" defaultTitle="Роль" defaultValue="0"
                        :isDisabled="true" @clickEvent="roleChanged"/>
            <label for="selectGroup">Группа</label>
            <SelectComp id="selectGroup" :items="getGroupDropdown" defaultTitle="Группа" defaultValue="0" :isDisabled="true" disabled/>
            <small class="form-text text-muted">Для роли "Староста"</small>

            <div class="row mt-4">
                <CreateButton @clickButton="create"/>
                <ResetButton/>
            </div>

        </form>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    export default {
        name: "PrepodCreate",
        methods: {
            ...mapActions(['createUser']),
            create() {
                const data = {
                    login: $('form#userCreate input[name=login]').val(),
                    name: $('form#userCreate input[name=name]').val(),
                    password: $('form#userCreate input[name=password]').val(),
                    role_id: $('form#userCreate select#selectRole').val()
                };

                $('form#userCreate select#selectGroup').val() && $('form#userCreate select#selectGroup').val() != 0 ?
                    data.group_code = $('form#userCreate select#selectGroup').val() : false;

                this.createUser(data);
            },
            generatePassword() {
                let length = Math.floor(Math.random() * 8) + 8,
                    charset = "0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                    retVal = "";

                for (let i = 0, n = charset.length; i < length; ++i) {
                    retVal += charset.charAt(Math.floor(Math.random() * n));
                }

                $('form#userCreate input[name=password]').val(retVal)
            },
            roleChanged() {
                if ($('form#userCreate select#selectRole').val() != 3) {
                    $('form#userCreate select#selectGroup').attr('disabled', 'disabled');
                    $('form#userCreate select#selectGroup').val('0');
                    $('form#userCreate select#selectGroup').change();
                } else {
                    $('form#userCreate select#selectGroup').removeAttr('disabled');
                }
            }
        },
        computed: {
            ...mapGetters(['getRolesData', 'getGroupDropdown'])
        }
    }
</script>

<style scoped>

</style>
