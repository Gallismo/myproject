<template >
    <div>
        <div class="row justify-content-around">
            <groupDescription class="col-12 col-md-6 col-lg-5" v-show="getCurrentDepartment"/>
            <groupCreate class="col-12 col-md-5 mt-3 mt-md-0" v-show="getCurrentDepartment"/>
            <h5 class="card-title text-center" v-show="!getCurrentDepartment">
                Требуется наличие хотя бы одного отделения для того, чтобы добавить группу
            </h5>
        </div>

        <hr>

        <div class="row justify-content-around mt-3 listGroups" v-show="getCurrentDepartment">

            <ul class="list-group list-group-horizontal list-group-header">
                <a name="list"></a>
                <li class="list-group-item bg-dark col-4">Название группы</li>
                <li class="list-group-item bg-dark col-4">Отделение</li>
                <li class="list-group-item bg-dark col-4">Годы</li>
            </ul>

            <groupList  v-for="group in getGroupsData" :group="group" :key="group.code"/>

        </div>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    export default {
        name: "Groups",
        async mounted() {
            this.getGroups();
            this.getAllDepartments();
        },
        methods: {
            ...mapActions(['getGroups', 'getAllDepartments', 'switchCurrentGroup'])
        },
        computed: {
            ...mapGetters(['getCurrentGroup', 'getGroupsData', 'getCurrentDepartment'])
        }
    }
</script>

<style scoped>

</style>
