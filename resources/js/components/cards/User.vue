<template>
    <div>
        <div class="row justify-content-between align-items-center">
            <h5 class="col">Пользователи</h5>
            <CreateButton col="col-8 col-sm-6 col-lg-3" name="Добавить пользователя" @clickButton="openModalCreate"/>
        </div>

        <hr>


        <div class="row justify-content-around mt-3">

            <div class="col-12 filter-string p-2">Фильтры</div>
            <div class="grid-1 grid-md-2 grid-gap-3 mb-3 col-12 mt-3 filters">
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">

                    Пользователь <inputText class="w-50" placeholder="Логин" @changeEvent="queryUsers" inputName="login"/>

                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">

                    Роль <SelectComp class="w-50" defaultTitle="Все" @clickEvent="queryRoles" :items="getRolesData" id="role"/>

                </div>
            </div>

            <div class="grid-1 grid-sm-2 grid-md-3 grid-lg-4 grid-gap-2 w-100" v-show="!getLoading">
                <UserCard v-for="user in getUserData" :user="user" class="grid-item"
                          :key="user.login" @clickCard="openModalEdit" data_switch_action="switchUser"/>
            </div>


            <Loader v-show="getLoading"/>

            <BootstrapModal id="editModal" body="UserEdit" title="Редактирование"/>
<!--            <BootstrapModal id="createModal" body="PrepodCreate" title="Добавление"/>-->
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    import {debounce} from "lodash";

    export default {
        name: "User",
        data() {
            return {
                query: {}
            }
        },
        mounted() {
            this.getAllUsers();
            this.getRoles();
        },
        methods: {
            ...mapActions(['getAllUsers', 'saveUser', 'deleteUser', 'createUser', 'switchUser', 'getRoles']),
            queryRoles(event) {
                this.query.role = event.target.value;
                this.filter();
            },
            queryUsers(event) {
                const type = event.target.name;
                this.query[type] = event.target.value;
                this.debounceHandler();
            },
            filter() {
                this.getAllUsers(this.query);
            },
            debounceHandler: debounce(function () {
                this.filter();
            }, 700),
            openModalEdit() {
                $('#editModal').modal('show');
            }
        },
        computed: {
            ...mapGetters(['getUserData', 'getCurrentUser', 'getLoading', 'getRolesData'])
        }
    }
</script>

<style scoped>

</style>
