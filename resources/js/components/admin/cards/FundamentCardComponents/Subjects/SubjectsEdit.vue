<template>
    <form class="card-body" @keypress.enter="save">

        <cardHeader>
            Выбрать предмет
            <Dropdown id="SubjectDropdown" :header="getCurrentSubject.name"
                      :items="getSubjectDropdown" @clickEvent="switcher"/>
        </cardHeader>

        <hr>

        <inputText code="editSubject"
                   :valueInput="getCurrentSubject.name"
                   alias="Название" inputName="editName"/>

        <div class="row">
            <SaveButton target="#saveSubject"/>
            <DeleteButton target="#deleteSubject"/>
        </div>

        <BootstrapModalConfirm id="saveSubject" @confirmEvent="save"></BootstrapModalConfirm>
        <BootstrapModalConfirm id="deleteSubject" @confirmEvent="deleteD"></BootstrapModalConfirm>

    </form>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "SubjectEdit",
        computed: {
            ...mapGetters(['getCurrentSubject', 'getSubjectDropdown'])
        },
        methods: {
            ...mapActions(['switchSubject', 'saveSubject', 'deleteSubject']),
            switcher(event) {
                this.switchSubject(event.target.id);
            },
            save() {
                const data = {
                    id: this.getCurrentSubject.id
                }

                $(`div.subjects input[name=editName]`).val() ? data.name = $('div.subjects input[name=editName]').val() : false;

                this.saveSubject(data);
            },
            deleteD() {
                const data = {
                    id: this.getCurrentSubject.id
                }
                this.deleteSubject(data);
            }
        }
    }
</script>

<style scoped>

</style>
