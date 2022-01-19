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

                    Логин <inputText class="w-50" placeholder="Иван" @changeEvent="queryPrepods" inputName="name"/>

                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">

                    Роль <inputText class="w-50" placeholder="Иванович" @changeEvent="queryPrepods" inputName="middle_name"/>

                </div>
            </div>

            <div class="grid-1 grid-sm-2 grid-md-3 grid-lg-4 grid-gap-2 w-100">
                <UserCard v-for="user in getUserData" :user="user" class="grid-item"/>
            </div>


            <Loader v-show="getLoading"/>

            <BootstrapModal id="editModal" body="PrepodEdit" title="Редактирование"/>
            <BootstrapModal id="createModal" body="PrepodCreate" title="Добавление"/>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        name: "User",
        data() {
            return {
                query: {}
            }
        },
        mounted() {
            this.getAllUsers();
        },
        methods: {
            ...mapActions(['getAllUsers', 'saveUser', 'deleteUser', 'createUser', 'switchUser'])
        },
        computed: {
            ...mapGetters(['getUserData', 'getCurrentUser', 'getLoading'])
        }
    }
</script>

<style scoped>

</style>
