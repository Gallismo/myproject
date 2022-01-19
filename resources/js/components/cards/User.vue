<template>
    <div>
        <div class="row justify-content-between align-items-center">
            <h5 class="col">Пользователи</h5>
            <CreateButton col="col-8 col-sm-6 col-lg-3" name="Добавить пользователя" @clickButton="openModalCreate"/>
        </div>

        <hr>


        <div class="row justify-content-around mt-3">

            <div class="col-12 filter-string p-2">Фильтры</div>
            <div class="row justify-content-between col-12 mt-3 filters">
                <div class="col-12 col-sm-9 col-md-7 col-xl-4 d-flex justify-content-between justify-content-xl-around align-items-center mb-3">Имя <inputText class="w-50" placeholder="Иванов" @changeEvent="queryPrepods" inputName="surname"/></div>
                <div class="col-12 col-sm-9 col-md-7 col-xl-4 d-flex justify-content-between justify-content-xl-around align-items-center mb-3">Логин <inputText class="w-50" placeholder="Иван" @changeEvent="queryPrepods" inputName="name"/></div>
                <div class="col-12 col-sm-9 col-md-7 col-xl-4 d-flex justify-content-between justify-content-xl-around align-items-center mb-3">Роль <inputText class="w-50" placeholder="Иванович" @changeEvent="queryPrepods" inputName="middle_name"/></div>
            </div>

            <div class="grid-1 grid-md-2 grid-lg-3 grid-xl-4"><UserCard/></div>


            <Loader v-show="getLoading"/>

            <BootstrapModal id="editModal" body="PrepodEdit" title="Редактирование"/>
            <BootstrapModal id="createModal" body="PrepodCreate" title="Добавление"/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "User"
    }
</script>

<style scoped>

</style>
