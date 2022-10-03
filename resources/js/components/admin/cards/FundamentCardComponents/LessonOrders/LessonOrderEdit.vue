<template>
    <form class="card-body" @keypress.enter="save">

        <cardHeader>
            Выбрать пару
            <Dropdown id="LessonOrderDropdown" :header="getCurrentLessonOrder.name"
                      :items="getLessonOrderDropdown" @clickEvent="switcher"/>
        </cardHeader>

        <hr>

        <inputText code="editLessonOrder"
                   :valueInput="getCurrentLessonOrder.name"
                   alias="Название" inputName="editName"/>

        <div class="row">
            <SaveButton target="#saveLessonOrder"/>
            <DeleteButton target="#deleteLessonOrder"/>
        </div>

        <BootstrapModalConfirm id="saveLessonOrder" @confirmEvent="save"></BootstrapModalConfirm>
        <BootstrapModalConfirm id="deleteLessonOrder" @confirmEvent="deleteD"></BootstrapModalConfirm>

    </form>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "LessonOrderEdit",
        computed: {
            ...mapGetters(['getCurrentLessonOrder', 'getLessonOrderDropdown'])
        },
        methods: {
            ...mapActions(['switchLessonOrder', 'saveLessonOrder', 'deleteLessonOrder']),
            switcher(event) {
                this.switchLessonOrder(event.target.id);
            },
            save() {
                const data = {
                    id: this.getCurrentLessonOrder.id
                }

                $(`div.lesson-orders input[name=editName]`).val() ? data.name = $('div.lesson-orders input[name=editName]').val() : false;

                this.saveLessonOrder(data);
            },
            deleteD() {
                const data = {
                    id: this.getCurrentLessonOrder.id
                }
                this.deleteLessonOrder(data);
            }
        }
    }
</script>

<style scoped>

</style>
