<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="prepodCreate" @keypress.enter="create">

            <inputText code="name" alias="ФИО" placeholder="Иванов Иван Иванович" inputName="name"/>
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
    import {mapActions, mapGetters} from "vuex";
    export default {
        name: "PrepodCreate",
        methods: {
            ...mapActions(['createPrepod']),
            create() {
                const data = {
                    name: $('form#prepodCreate input[name=name]').val(),
                    user_id: $('form#prepodCreate select').val()
                };

                this.createPrepod(data);
            }
        },
        computed: {
            ...mapGetters(['getUserDropdown'])
        }
    }
</script>

<style scoped>

</style>
