<template>
    <form class="card-body" @keypress.enter="create">

        <cardHeader>Создать отделение</cardHeader>

        <hr>

        <inputText code="createDep" alias="Название" inputName="createName"/>

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
                    name: $('div.departments input[name=createName]').val()
                };
                this.createDepartment(data);
            }
        }
    }
</script>

<style scoped>

</style>
