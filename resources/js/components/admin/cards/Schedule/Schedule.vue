<template>
    <div>
        <div class="row justify-content-between align-items-center">
            <h5 class="col">Расписания звонков</h5>
            <CreateButton col="col-8 col-sm-6 col-lg-3" name="Добавить пару" @clickButton="openModalCreate"/>
        </div>

        <hr>


        <div class="row justify-content-around mt-3">

            <div class="col-12 filter-string p-2">Фильтры</div>
            <div class="grid-1 grid-lg-3 grid-gap-3 mb-3 col-12 mt-3 filters">
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">
                    <span class="w-35">Отделение</span>
                    <SelectComp class="w-50" defaultTitle="Все" @clickEvent="querySchedule" :items="getDepartmentDropdown" id="dep_filter"/>
                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">
                    <span class="w-35">День недели</span>
                    <SelectComp class="w-50" defaultTitle="Все" @clickEvent="querySchedule" :items="getWeekDropdown" id="week_filter"/>
                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">
                    <span class="w-35">Пара</span>
                    <SelectComp class="w-50" defaultTitle="Все" @clickEvent="querySchedule" :items="getLessonOrderDropdown" id="les_filter"/>
                </div>
            </div>

            <div class="w-100 grid-1 grid-md-2 grid-xl-3" v-show="!getLoading">
                <div v-for="(weeks, department) in groupedSchedules" :key="department" class="mt-3 p-1">
                    <h3>{{department}}</h3>
                    <hr>
                    <ScheduleDay v-for="(schedules, week) in weeks"
                                 :week_day="week" :schedules="schedules" :key="schedules[0].id" class="m-1"/>
                </div>
            </div>


            <BootstrapModalConfirm id="deleteConfirm" @confirmEvent="del"/>
            <BootstrapModal id="editModal" body="Scheduleedit" title="Редактирование"/>
            <BootstrapModal id="createModal" body="SheduleCreate" title="Добавление"/>

            <Loader v-show="getLoading"/>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    import {debounce} from "lodash";
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
            ...mapActions(['getSchedule', 'deleteSchedule']),
            querySchedule(event) {
                const type = event.target.id;
                this.query[type] = event.target.value;
                this.filter();
            },
            filter() {
                this.getSchedule(this.query);
            },
            openModalCreate() {
                $('#createModal').modal('show');
            },
            del() {
                this.deleteSchedule({id: this.getCurrentSchedule.id})
            }
        },
        computed: {
            ...mapGetters(['getScheduleData', 'getDepartmentsData', 'getWeeksData', 'getLoading',
                'getDepartmentDropdown', 'getWeekDropdown', 'getLessonOrderDropdown', 'getCurrentSchedule']),
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

                            if (data[department.name][week.name].length === 0) {
                                delete data[department.name][week.name];
                            }
                        })

                        if (Object.keys(data[department.name]).length === 0) {
                            delete data[department.name];
                        }
                    })
                    return data;
                }
        }
    }
</script>

<style scoped>

</style>
