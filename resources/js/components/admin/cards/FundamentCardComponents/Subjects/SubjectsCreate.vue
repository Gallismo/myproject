<template>
    <form class="card-body" @keypress.enter="create">

        <cardHeader>Создать предмет</cardHeader>

        <hr>

        <inputText code="createSubject" alias="Название" inputName="createName"/>

        <div class="row mt-4">
            <CreateButton @clickButton="create"/>
            <ResetButton/>
        </div>

    </form>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "SubjectCreate",
        methods: {
            ...mapActions(['createSubject']),
            create() {
                const data = {
                    name: $('div.subjects input[name=createName]').val()
                };
                this.createSubject(data);
            }
        }
    }
</script>

<style scoped>

</style>
