<template>
    <form class="card-body" @keypress.enter="save">

        <cardHeader>
            Выбрать день недели
            <Dropdown id="WeekDropdown" :header="getCurrentWeek.name"
                      :items="getWeekDropdown" @clickEvent="switcher"/>
        </cardHeader>

        <hr>

        <inputText code="editWeek"
                   :valueInput="getCurrentWeek.name"
                   alias="Название" inputName="editName"/>

        <div class="row">
            <SaveButton target="#saveWeek"/>
            <DeleteButton target="#deleteWeek"/>
        </div>

        <BootstrapModalConfirm id="saveWeek" @confirmEvent="save"></BootstrapModalConfirm>
        <BootstrapModalConfirm id="deleteWeek" @confirmEvent="deleteD"></BootstrapModalConfirm>

    </form>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';
export default {
    name: "WeekEdit",
    computed: {
        ...mapGetters(['getCurrentWeek', 'getWeekDropdown'])
    },
    methods: {
        ...mapActions(['switchWeek', 'saveWeek', 'deleteWeek']),
        switcher(event) {
            this.switchWeek(event.target.id);
        },
        save() {
            const data = {
                id: this.getCurrentWeek.id
            }
            $(`div.weeks input[name=editName]`).val() ? data.name = $('div.weeks input[name=editName]').val() : false;
            this.saveWeek(data);
        },
        deleteD() {
            const data = {
                id: this.getCurrentWeek.id
            }
            this.deleteWeek(data);
        }
    }
}
</script>

<style scoped>
</style>
