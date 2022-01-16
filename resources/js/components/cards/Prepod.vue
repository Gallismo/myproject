<template>
    <div>
        <div class="row justify-content-between align-items-center">
            <h5 class="col">Преподаватели</h5>
            <CreateButton col="col-8 col-sm-6 col-lg-3" name="Добавить преподавателя" @clickButton="openModalCreate"/>
        </div>

        <hr>

        <div class="row justify-content-around mt-3">

            <div class="col-12 filter-string p-2">Фильтры</div>
            <div class="row justify-content-between col-12 mt-3 filters">
                <div class="col-12 col-sm-9 col-md-7 col-xl-4 d-flex justify-content-between justify-content-xl-around align-items-center mb-3">Фамилия <inputText class="w-50" placeholder="Фамилия" @changeEvent="queryPrepods" inputName="surname"/></div>
                <div class="col-12 col-sm-9 col-md-7 col-xl-4 d-flex justify-content-between justify-content-xl-around align-items-center mb-3">Имя <inputText class="w-50" placeholder="Имя" @changeEvent="queryPrepods" inputName="name"/></div>
                <div class="col-12 col-sm-9 col-md-7 col-xl-4 d-flex justify-content-between justify-content-xl-around align-items-center mb-3">Отчество <inputText class="w-50" placeholder="Отчество" @changeEvent="queryPrepods" inputName="middle_name"/></div>
            </div>

            <div class="row justify-content-center list">
                <listHeader columns="col-4" :row="['Фамилия', 'Имя', 'Отчество']"/>
                <List  v-for="row in getPrepodData" :row="row" :key="row.code" v-show="!getLoading" data_switch_action="switchPrepod" @clickEvent="openModalEdit"/>
            </div>

            <Loader v-show="getLoading"/>

            <BootstrapModal id="editModal" body="PrepodEdit" title="Редактирование"/>
            <BootstrapModal id="createModal" body="PrepodCreate" title="Добавление"/>
        </div>

    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    import {debounce} from 'lodash';

    export default {
        name: "Prepod",
        data() {
            return {
                query: {}
            }
        },
        mounted() {
            this.getAllPrepods();
        },
        methods: {
            ...mapActions(['getAllPrepods', 'savePrepod', 'deletePrepod', 'createPrepod', 'switchPrepod']),
            queryPrepods(event) {
                const type = event.target.name;
                this.query[type] = event.target.value;
                this.debounceHandler();
            },
            filter() {
                this.getAllPrepods(this.query);
            },
            debounceHandler: debounce(function () {
                this.filter();
            }, 700),
            openModalEdit() {
                $('#editModal').modal('show');
            },
            openModalCreate() {
                $('#createModal').modal('show');
            }
        },
        computed: {
            ...mapGetters(['getPrepodData', 'getPrepodDropdown', 'getCurrentPrepod', 'getLoading'])
        }
    }
</script>

<style scoped>

</style>
