<template>
    <form class="card-body" @keypress.enter="create">

        <cardHeader>Создать подгруппу</cardHeader>

        <hr>

        <inputText code="createGroupPart" alias="Название" inputName="createName"/>

        <div class="row mt-4">
            <CreateButton @clickButton="create"/>
            <ResetButton/>
        </div>

    </form>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "GroupPartCreate",
        methods: {
            ...mapActions(['createGroupPart']),
            create() {
                const data = {
                    name: $('div.group-parts input[name=createName]').val()
                };
                this.createGroupPart(data);
            }
        }
    }
</script>

<style scoped>

</style>
