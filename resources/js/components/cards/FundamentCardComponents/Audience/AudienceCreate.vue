<template>
    <form class="card-body">

        <cardHeader>Создать аудиторию</cardHeader>

        <hr>

        <inputText code="createAud" alias="Название" inputName="createName"/>

        <div class="row mt-4">
            <CreateButton @clickButton="create"/>
            <ResetButton/>
        </div>

    </form>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "AudienceCreate",
        methods: {
            ...mapActions(['createAudience']),
            create() {
                const data = {
                    name: $('div.audiences input[name=createName]').val()
                };
                this.createAudience(data);
            }
        }
    }
</script>

<style scoped>

</style>
