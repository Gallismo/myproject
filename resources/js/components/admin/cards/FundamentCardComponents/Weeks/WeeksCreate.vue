<template>
    <form class="card-body" @keypress.enter="create">

        <cardHeader>Создать день недели</cardHeader>

        <hr>

        <inputText code="createWeek" alias="Название" inputName="createName"/>

        <div class="row mt-4">
            <CreateButton @clickButton="create"/>
            <ResetButton/>
        </div>

    </form>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';
export default {
    name: "WeekCreate",
    methods: {
        ...mapActions(['createWeek']),
        create() {
            const data = {
                name: $('div.weeks input[name=createName]').val()
            };
            this.createWeek(data);
        }
    }
}
</script>

<style scoped>
</style>
