<template>
    <form class="card-body">

        <cardHeader>Создать отделение</cardHeader>

        <hr>

        <inputText code="createCard" alias="Название" inputName="createName"/>

        <div class="row mt-4">
            <CreateButton @clickButton="create"/>
            <ResetButton/>
        </div>

    </form>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "DepartmentCreate",
        methods: {
            ...mapActions(['createDepartment']),
            create() {
                const data = {
                    name: $('input[name=createName]').val()
                };
                this.createDepartment(data);
            }
        }
    }
</script>

<style scoped>

</style>
