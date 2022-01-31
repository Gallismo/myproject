<template>
    <form class="card-body"  @keypress.enter="save">

        <cardHeader>
            Выбрать аудиторию
            <Dropdown id="DepartmentDropdown" :header="getCurrentAudience.name"
                      :items="getAudienceDropdown" @clickEvent="switcher"/>
        </cardHeader>

        <hr>

        <inputText code="editAud"
                   :valueInput="getCurrentAudience.name"
                   alias="Название" inputName="editName"/>

        <div class="row">
            <SaveButton target="#saveAud"/>
            <DeleteButton target="#deleteAud"/>
        </div>

        <BootstrapModalConfirm id="saveAud" @confirmEvent="save"></BootstrapModalConfirm>
        <BootstrapModalConfirm id="deleteAud" @confirmEvent="deleteD"></BootstrapModalConfirm>

    </form>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "AudienceEdit",
        computed: {
            ...mapGetters(['getCurrentAudience', 'getAudienceDropdown'])
        },
        methods: {
            ...mapActions(['switchAudience', 'saveAudience', 'deleteAudience']),
            switcher(event) {
                this.switchAudience(event.target.id);
            },
            save() {
                const data = {
                    code: this.getCurrentAudience.code
                }

                $(`div.audiences input[name=editName]`).val() ? data.name = $('div.audiences input[name=editName]').val() : false;

                this.saveAudience(data);
            },
            deleteD() {
                const data = {
                    code: this.getCurrentAudience.code
                }
                this.deleteAudience(data);
            }
        }
    }
</script>

<style scoped>

</style>
