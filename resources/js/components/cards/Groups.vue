<template >
    <div>
        <div class="row justify-content-around">
            <groupDescription class="col-12 col-md-6 col-lg-5" v-show="getCurrentGroup"/>
            <groupCreate class="col-12 col-md-5 mt-3 mt-md-0" v-show="getCurrentDepartment"/>
            <h5 class="card-title text-center" v-show="!getCurrentDepartment">
                Требуется наличие хотя бы одного отделения для того, чтобы добавить группу
            </h5>
        </div>

        <hr>

        <div class="row justify-content-around mt-3" v-show="getCurrentDepartment">

<!--            <Dropdown :items="getDepartmentDropdown" @clickEvent="queryDep"></Dropdown>-->

<!--            <ul class="list-group list-group-horizontal list-group-header">-->
<!--                <li class="list-group-item bg-dark col-3">Фильтры</li>-->
<!--                <li class="list-group-item bg-dark col-3">Отделение<SelectComp :items="getDepartmentDropdown" @clickEvent="queryDep" defaultValue="Все"/></li>-->
<!--                <li class="list-group-item bg-dark col-3">Годы</li>-->
<!--                <li class="list-group-item bg-dark col-3">Годы</li>-->
<!--            </ul>-->
            <div class="col-12 filter-string p-2">Фильтры</div>
            <div class="row justify-content-between col-12 mt-3">
                <div class="col-12 col-sm-9 col-md-7 col-xl-4 d-flex justify-content-between justify-content-xl-around align-items-center mb-3">Отделение<SelectComp class="w-50" :items="getDepartmentDropdown" @clickEvent="queryDep" defaultValue="Все"/></div>
                <div class="col-12 col-sm-9 col-md-7 col-xl-4 d-flex justify-content-between justify-content-xl-around align-items-center mb-3">Начало <inputText class="w-50" @changeEvent="queryYear" inputName="start"/></div>
                <div class="col-12 col-sm-9 col-md-7 col-xl-4 d-flex justify-content-between justify-content-xl-around align-items-center mb-3">Конец <inputText class="w-50" @changeEvent="queryYear" inputName="end"/></div>
            </div>

            <div class="row justify-content-center listGroups">
                <ul class="list-group list-group-horizontal list-group-header" v-if="getCurrentGroup" v-show="!loading">
                    <li class="list-group-item bg-dark col-4">Название группы</li>
                    <li class="list-group-item bg-dark col-4">Отделение</li>
                    <li class="list-group-item bg-dark col-4">Годы</li>
                </ul>

                <groupList  v-for="group in getGroupsData" :group="group" :key="group.code" v-show="!loading"/>
            </div>

            <Loader v-show="loading"/>
        </div>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    import {debounce} from "lodash";
    export default {
        name: "Groups",
        data() {
            return {
                query: [],
                loading: false
            }
        },
        async mounted() {
            this.getGroups();
            this.getAllDepartments();
        },
        methods: {
            ...mapActions(['getGroups', 'getAllDepartments', 'switchCurrentGroup']),
            queryDep(event) {
                this.query['department'] = event.target.id;
                this.loading = true;
                this.debounceHandler();
            },
            queryYear(event) {
                const type = event.target.name;
                this.query[type] = event.target.value;
                this.loading = true;
                this.debounceHandler();
            },
            filter() {
                this.getGroups(this.query);
            },
            debounceHandler: debounce(function () {
                this.filter();
                this.loading = false;
            }, 700)
        },
        computed: {
            ...mapGetters(['getCurrentGroup', 'getGroupsData', 'getCurrentDepartment', 'getDepartmentDropdown'])
        }
    }
</script>

<style scoped>

</style>
