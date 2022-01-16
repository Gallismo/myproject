<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="prepodCreate" @keypress.enter="create">

            <inputText code="surname" alias="Фамилия" inputName="surname"/>
            <inputText code="name" alias="Имя" inputName="name"/>
            <inputText code="middle_name" alias="Отчество" inputName="middle_name"/>

            <div class="row mt-4">
                <CreateButton @clickButton="create"/>
                <ResetButton/>
            </div>

        </form>
    </div>
</template>

<script>
    import {mapActions} from "vuex";
    export default {
        name: "PrepodCreate",
        methods: {
            ...mapActions(['createPrepod']),
            create() {
                const data = {
                    surname: $('form#prepodCreate input[name=surname]').val(),
                    name: $('form#prepodCreate input[name=name]').val(),
                    middle_name: $('form#prepodCreate input[name=middle_name]').val()
                };

                this.createPrepod(data);
            }
        }
    }
</script>

<style scoped>

</style>
