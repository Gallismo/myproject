<template>
    <div class="card bg-dark text-white">
        <form class="card-body" id="LessonCreate" >
            <div class="form-group">
                <label for="department">Группа</label>
                <select-comp class="" id="group" :items="{
                    1: 'И-19-19',
                    2: 'исп-19-19',

                }"></select-comp>
            </div>
            <div class="form-group">
                <label for="department">Отделение</label>
                <select-comp class="" id="group" :items="{
                    1: 'И-19-19',
                    2: 'исп-19-19',

                }"></select-comp>
            </div>
            <div class="form-group">
                <label for="department">Отделение</label>
                <select-comp class="" id="group" :items="{
                    1: 'И-19-19',
                    2: 'исп-19-19',

                }"></select-comp>
            </div>
            <div class="row mt-4">
                <SaveButton target="#createConfirm"/>
            </div>

        </form>

        <BootstrapModalConfirm id="createConfirm"></BootstrapModalConfirm>
    </div>
</template>

<script>
export default {
    name: "SchedulAddLesson"
}
</script>

<style scoped>

</style>
