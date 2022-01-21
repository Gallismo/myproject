<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="captainCreate" @keypress.enter="create">

            <inputText code="name" alias="ФИО" placeholder="Иванов Иван Иванович" inputName="name"/>
            <label for="selectGroup">Группа</label>
            <SelectComp id="selectGroup" :items="getGroupDropdown" defaultTitle="Группа" defaultValue="0" :isDisabled="true"/>
            <label for="selectUser">Пользователь</label>
            <SelectComp id="selectUser" :items="getUserDropdown" defaultTitle="Пользователь" defaultValue="0" :isDisabled="true"/>

            <div class="row mt-4">
                <CreateButton @clickButton="create"/>
                <ResetButton/>
            </div>

        </form>
    </div>
</template>

<script>
    import {mapActions,mapGetters} from "vuex";

    export default {
        name: "CaptainCreate",
        methods: {
            ...mapActions(['createCaptain']),
            create() {
                const data = {
                    name: $('#captainCreate input[name=name]').val(),
                    user_id: $('#captainCreate select#selectUser').val(),
                    group_code: $('#captainCreate select#selectGroup').val()
                }
                this.createCaptain(data);
            }
        },
        computed: {
            ...mapGetters(['getGroupDropdown', 'getUserDropdown'])
        }
    }
</script>

<style scoped>

</style>
