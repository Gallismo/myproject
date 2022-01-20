<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="userCreate" @keypress.enter="create">

            <inputText code="login" alias="Имя пользователя" placeholder="Логин" inputName="login"/>
            <inputText code="password" alias="Пароль" placeholder="Пароль" inputName="password"/>
            <label for="selectRole">Роль</label>
            <SelectComp id="selectRole" :items="getRolesData" defaultTitle="Роль" defaultValue="0" :isDisabled="true"/>

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
                    password: $('form#userCreate input[name=password]').val(),
                    role_id: $('form#userCreate select').val()
                };

                this.createUser(data);
            }
        },
        computed: {
            ...mapGetters(['getRolesData'])
        }
    }
</script>

<style scoped>

</style>
