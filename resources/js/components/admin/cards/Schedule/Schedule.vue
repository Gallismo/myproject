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
                    <span class="w-35">Пользователь</span>
                    <inputText class="w-50" placeholder="Логин" @changeEvent="queryUsers" inputName="login"/>
                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">
                    <span class="w-35">Роль</span>
                    <SelectComp class="w-50" defaultTitle="Все" @clickEvent="queryRoles" :items="getRolesData" id="role"/>
                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">
                    <span class="w-35">ФИО</span>
                    <inputText class="w-50" placeholder="ФИО" @changeEvent="queryUsers" inputName="name"/>
                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">
                    <span class="w-35">Группа</span>
                    <inputText class="w-50" placeholder="Название группы" @changeEvent="queryUsers" inputName="group"/>
                </div>
            </div>

            <div class="w-100" v-show="!getLoading">
                <div v-for="(weeks, department) in groupedSchedules" :key="department" class="mt-3">
                    <h5>{{department}}</h5>
                    <hr>
                    <div v-for="(schedules, week) in weeks" class="p-2">
                        <h5>{{week}}</h5>
                        <hr>
                        <div class="grid-1 grid-sm-2 grid-lg-3 grid-xl-4 grid-gap-2">
                            <ScheduleCard v-for="schedule in schedules" :schedule="schedule"
                                          :key="'sch'+schedule.id" class="grid-item"/>
                        </div>
                    </div>

                </div>
            </div>


            <Loader v-show="getLoading"/>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        name: "Schedule",
        data() {
            return {
                query: {}
            }
        },
        mounted() {
            this.getSchedule();
        },
        methods: {
            ...mapActions(['getSchedule'])
        },
        computed: {
            ...mapGetters(['getScheduleData', 'getDepartmentsData', 'getWeeksData']),
            groupedSchedules() {
                const data = {};
                this.getDepartmentsData.map(department => {
                    data[department.name] = {};
                    this.getWeeksData.map(week => {
                        data[department.name][week.name] = [];
                        this.getScheduleData.map(schedule => {
                            if (schedule.department_name === department.name && schedule.week_day_name === week.name) {
                                data[department.name][week.name].push(schedule);
                            }
                        })
                    })

                })
                return data;
            }
        }
    }
</script>

<style scoped>

</style>
