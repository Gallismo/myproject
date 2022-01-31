<template>
    <div>
        <div class="row justify-content-between align-items-center">
            <h5 class="col">Старосты</h5>
            <CreateButton col="col-8 col-sm-6 col-lg-3" name="Добавить старосту" @clickButton="openModalCreate"/>
        </div>

        <hr>

        <div class="row justify-content-around mt-3">

            <div class="col-12 filter-string p-2">Фильтры</div>
            <div class="grid-1 grid-xl-3 grid-gap-3 mb-3 col-12 mt-3 filters">
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">

                    Группа <inputText class="w-50" placeholder="Название" @changeEvent="queryCaptains" inputName="group_name"/>

                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">

                    ФИО <inputText class="w-50" placeholder="Иванов Иван Иванович" @changeEvent="queryCaptains" inputName="name"/>

                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">

                    Пользователь <inputText class="w-50" placeholder="Логин" @changeEvent="queryCaptains" inputName="user"/>

                </div>
            </div>

            <div class="grid-1 grid-sm-2 grid-md-3 grid-lg-4 grid-gap-2 w-100" v-show="!getLoading">
                <CaptainCard :captain="captain" v-for="captain in getCaptainData"
                             class="grid-item" :key="captain.code"
                             data_switch_action="switchCaptain" @clickCard="openModalEdit" @clickButton="openModalConfirm"/>
            </div>


            <Loader v-show="getLoading"/>

            <BootstrapModal id="editModal" body="CaptainEdit" title="Редактирование"/>
            <BootstrapModal id="createModal" body="CaptainCreate" title="Добавление"/>
            <BootstrapModalConfirm id="confirmDeleteModal" @confirmEvent="deleteD"/>
        </div>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    import {debounce} from "lodash";
    export default {
        name: "Captain",
        data() {
            return {
                query: {}
            }
        },
        mounted() {
            this.getAllCaptains();
            this.getGroups();
            this.getAllUsers();
        },
        methods: {
            ...mapActions(['getAllCaptains', 'getGroups', 'getAllUsers', 'deleteCaptain']),
            queryCaptains(event) {
                const type = event.target.name;
                this.query[type] = event.target.value;
                this.debounceHandler();
            },
            filter() {
                this.getAllCaptains(this.query);
            },
            debounceHandler: debounce(function () {
                this.filter();
            }, 700),
            openModalCreate() {
                $('#createModal').modal('show');
            },
            openModalConfirm() {
                $('#confirmDeleteModal').modal('show');
            },
            openModalEdit() {
                $('#editModal').modal('show');
            },
            deleteD() {
                const data = {
                    code: this.getCurrentCaptain.code
                }
                this.deleteCaptain(data);
            }
        },
        computed: {
            ...mapGetters(['getCaptainData', 'getLoading', 'getCurrentCaptain'])
        }
    }
</script>

<style scoped>

</style>
