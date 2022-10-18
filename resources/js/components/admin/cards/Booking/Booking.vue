<template>
    <div>
        <div class="row justify-content-between align-items-center">
            <h5 class="col">Составление расписания занятий</h5>
            <PlusIcon target="#addLessonModal"/>
        </div>

        <hr>

        <div class="row justify-content-around mt-3">

            <div class="col-12 filter-string p-2">Фильтры</div>
            <div class="grid-1 grid-lg-3 grid-gap-3 mb-3 col-12 mt-3 filters">
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">
                    <span class="w-35">Отделение</span>
                    <SelectComp class="w-50" defaultTitle="Все" @clickEvent="querySchedule"
                                :items="getDepartmentDropdown" id="dep_filter"/>
                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">
                    <span class="w-35">Дата</span>
                    <b-form-datepicker id="date_filter" locale="ru" class="btn-secondary" :dark="true" @input="queryDate"
                                       :date-format-options="{'year': 'numeric', 'month': 'numeric', 'day': 'numeric'}"/>
                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">
                    <span class="w-35">Преподаватель</span>
                    <SelectComp class="w-50" defaultTitle="Все" @clickEvent="querySchedule"
                                :items="$store.getters.getTeacherDropdown" id="teacher_filter"/>
                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">
                    <span class="w-35">Аудитория</span>
                    <SelectComp class="w-50" defaultTitle="Все" @clickEvent="querySchedule"
                                :items="$store.getters.getAudienceDropdown" id="aud_filter"/>
                </div>
                <div class="d-flex justify-content-between
                justify-content-xl-around align-items-center">
                    <span class="w-35">Пара</span>
                    <SelectComp class="w-50" defaultTitle="Все" @clickEvent="querySchedule"
                                :items="$store.getters.getLessonOrderDropdown" id="les_filter"/>
                </div>
            </div>

            <div class="w-100 grid-1" v-show="!getLoading">
                <div v-for="department in $store.getters.getFormattedBookingsData" class="mt-3 p-1">
                    <div class="d-flex align-items-center">
                        <h3 class="m-0">
                            {{department.department_name}}
                        </h3>
                        <PlusIcon target="#addLessonModal" class="ml-2"/>
                    </div>
                    <hr>
                    <div v-for="day in department.days" class="mb-3 card bg-dark text-white ">
                        <button type="button" data-toggle="collapse"
                                class="card-header"
                                :data-target="'#groupCollapse' + day.date + department.department_id"
                                aria-expanded="false"
                                :aria-controls="'groupCollapse' + day.date + department.department_id">
                            <h4>{{ day.date }}</h4>
                        </button>
                        <div class="grid-5 grid-gap-1 collapse p-1" :id="'groupCollapse' + day.date + department.department_id">
                            <div v-for="group in day.groups" class="card bg-dark text-white">
                                <button type="button" data-toggle="collapse"
                                        class="card-header"
                                        :data-target="'#lessCollapse' + group.group_name + day.date"
                                        aria-expanded="false"
                                        :aria-controls="'lessCollapse' + group.group_name + day.date">
                                    <h5>{{ group.group_name }}</h5>
                                </button>
                                <div class="collapse p-1" :id="'lessCollapse' + group.group_name + day.date">
                                    <div v-for="lesson in group.bookings" :data-id="lesson.id" class="card lesson-card bg-dark text-white">
                                        <div class="lesson">
                                            <div class="d-flex justify-content-center">
                                                <div>{{lesson.lesson_order_name}} {{lesson.subject_name}}</div>
                                                <DeleteIconSec class="to-end"
                                                               target="#deleteConfirm"
                                                               data_switch_action="switchBooking"/>
                                            </div>
                                            <hr>
                                            Аудитория: {{lesson.audience_name}}
                                            <hr>
                                            {{lesson.teacher_name}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <BootstrapModal id="addLessonModal" body="BookingAddLesson"></BootstrapModal>
            <BootstrapModalConfirm id="deleteConfirm" @confirmEvent="del"/>
            <BootstrapModal id="editModal" body="Scheduleedit" title="Редактирование"/>

            <Loader v-show="getLoading"/>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import {BFormDatepicker} from 'bootstrap-vue';
import {debounce} from "lodash";
export default {
    name: "Booking",
    components: {BFormDatepicker},
    data() {
        return {
            query: {},
        }
    },
    mounted() {
        this.getAllBookings();
    },
    methods: {
        ...mapActions(['getAllBookings', 'deleteBooking']),
        querySchedule(event) {
            const type = event.target.id;
            if (event.target.value) {
                this.query[type] = event.target.value;
            } else {
                delete this.query[type];
            }
            this.filter();
        },
        filter() {
            this.getAllBookings(this.query);
        },
        openModalCreate() {
            $('#createModal').modal('show');
        },
        queryDate(date) {
            this.query.date_filter = date;
            this.filter();
        },
        del() {
            this.deleteBooking({id: this.getCurrentBooking.id})
        }
    },
    computed: {
        ...mapGetters(['getBookingsData', 'getDepartmentsData', 'getWeeksData', 'getLoading',
            'getDepartmentDropdown', 'getWeekDropdown', 'getLessonOrderDropdown', 'getCurrentBooking']),
        groupedLessons() {
            const data = {};

            this.getDepartmentsData.map(department => {
                data[department.name] = [];

                this.getBookingsData.map(booking => {
                    if (booking.department_id === department.id) {
                        data[department.name].push(booking)
                    }
                })

                if (data[department.name].length === 0) {
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
