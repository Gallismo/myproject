<template>
    <form class="card-body" @keypress.enter="save">

        <cardHeader>
            Выбрать подгруппу
            <Dropdown id="GroupPartDropdown" :header="getCurrentGroupPart.name"
                      :items="getGroupPartDropdown" @clickEvent="switcher"/>
        </cardHeader>

        <hr>

        <inputText code="editGroupPart"
                   :valueInput="getCurrentGroupPart.name"
                   alias="Название" inputName="editName"/>

        <div class="row">
            <SaveButton target="#saveGroupPart"/>
            <DeleteButton target="#deleteGroupPart"/>
        </div>

        <BootstrapModalConfirm id="saveGroupPart" @confirmEvent="save"></BootstrapModalConfirm>
        <BootstrapModalConfirm id="deleteGroupPart" @confirmEvent="deleteD"></BootstrapModalConfirm>

    </form>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "GroupPartEdit",
        computed: {
            ...mapGetters(['getCurrentGroupPart', 'getGroupPartDropdown'])
        },
        methods: {
            ...mapActions(['switchGroupPart', 'saveGroupPart', 'deleteGroupPart']),
            switcher(event) {
                this.switchGroupPart(event.target.id);
            },
            save() {
                const data = {
                    id: this.getCurrentGroupPart.id
                }

                $(`div.group-parts input[name=editName]`).val() ? data.name = $('div.group-parts input[name=editName]').val() : false;

                this.saveGroupPart(data);
            },
            deleteD() {
                const data = {
                    id: this.getCurrentGroupPart.id
                }
                this.deleteGroupPart(data);
            }
        }
    }
</script>

<style scoped>

</style>
