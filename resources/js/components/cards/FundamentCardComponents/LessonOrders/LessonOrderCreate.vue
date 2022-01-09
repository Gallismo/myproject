<template>
    <form class="card-body">

        <cardHeader>Создать пару</cardHeader>

        <hr>

        <inputText code="createLessonOrder" alias="Название" inputName="createName"/>

        <div class="row mt-4">
            <CreateButton @clickButton="create"/>
            <ResetButton/>
        </div>

    </form>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "LessonOrderCreate",
        methods: {
            ...mapActions(['createLessonOrder']),
            create() {
                const data = {
                    name: $('div.lesson-orders input[name=createName]').val()
                };
                this.createLessonOrder(data);
            }
        }
    }
</script>

<style scoped>

</style>
