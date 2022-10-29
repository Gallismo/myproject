<template>
    <div class="d-flex flex-column align-items-center">
        <div class="grid-1 grid-sm-2 grid-gap-1 w-100">
            <div class="form-group" id="search_container">
                <label for="teacher">Преподаватель</label>
                <input type="text" id="teacher" name="teacher" v-debounce:400="search"
                       placeholder="Преподаватель" class="form-control btn-secondary">
                <div id="search_list" v-show="showList" class="card bg-info">
                    <div class="p-1">
                        <button class="search_row btn btn-info" @click="selectRow"
                                :disabled="searchRow.id === 0"
                                v-for="searchRow in searchList" :value="searchRow.id">
                            {{searchRow.name}}
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="date">Дата</label>
                <b-form-datepicker id="date" locale="ru" :dark="true" start-weekday="1" class="btn-secondary"
                                   label-no-date-selected="Дата не выбрана" :reset-button="true"
                                   label-reset-button="Сбросить" label-today-button="Сегодня"
                                   label-current-month="Текущий месяц" label-next-month="Следующий месяц"
                                   label-next-year="Следующий год" label-prev-month="Предыдущий месяц"
                                   label-prev-year="Предыдущий год" label-help="Используйте стрелки для навигации по числам"
                                   :today-button="true" v-model="date" @input="findLessons"
                                   :date-format-options="{'year': 'numeric', 'month': 'numeric', 'day': 'numeric'}"/>
            </div>
        </div>
        <Loader v-if="loading"/>
        <div id="accordion" class="lessons w-100" v-if="!loading">
            <div class="card bg-dark lesson" v-for="lesson in lessons">
                <div class="card-header d-flex flex-wrap" data-toggle="collapse" :data-target="'#lesson' + lesson.id">
                    <div class="lesson_order col-6 col-sm-4 col-lg-3 col-xl-1">{{lesson.lesson_order_name}}</div>
                    <div class="time col-6 col-sm-4 col-lg-3 col-xl-1">
                        <p class="m-0">{{lesson.start_time}}</p>
                        <p class="m-0">{{lesson.end_time}}</p>
                    </div>
                    <div class="group col-5 col-sm-4 col-lg-3 col-xl-2">
                        <p class="m-0">{{lesson.group_name}}</p>
                        <small>{{lesson.group_part_name}}</small>
                    </div>
                    <div class="subject col-12 col-sm-8 col-lg-12 order-1 order-sm-0 order-lg-1 order-xl-0 col-xl-6">
                        <h4>{{lesson.subject_name}}</h4>
                        <h6>{{lesson.teacher_name}}</h6>
                    </div>
                    <div class="audience col-7 col-sm-4 col-lg-3 col-xl-2"><h5>{{lesson.audience_name}}</h5></div>
                </div>
                <div :id="'lesson' + lesson.id" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <h5 class="m-0">{{'Тема пары: ' + (lesson.lesson_topic ?? 'Не указано')}}</h5>
                        <h5 class="m-0">{{'Домашнее задание: ' + (lesson.lesson_homework ?? 'Не указано')}}</h5>
                        <hr>
                        <h5 class="mb-0 mt-2">{{lesson.is_remote ? 'Дистанционно' : 'Очно'}}</h5>
                        <h5 v-show="lesson.is_remote">{{'Ссылка на конференцию: ' + (lesson.conference_url ?? 'Не указано')}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {BFormDatepicker} from "bootstrap-vue";

export default {
    name: "TeacherLessons",
    components: {
        BFormDatepicker
    },
    data() {
        return {
            searchList: [],
            showList: false,
            selectedId: null,
            date: "",
            lessons: [],
            loading: false
        }
    },
    methods: {
        search(text) {
            if (text === '') {
                return;
            }
            axios.get('/search', {
                params: {
                    entity: 'teacher',
                    name: text
                }
            }).then(response => {
                if (response.data.length !== 0) {
                    this.searchList = response.data;
                } else if (response.data.length === 0) {
                    this.searchList = [{id: 0, name: 'Ничего не найдено'}]
                }
                this.showList = true;
            }).catch(error => {
                this.$store.dispatch('showNotification', error.response.data)
            })
        },
        selectRow(event) {
            this.showList = false;
            this.selectedId = event.target.value;
            $('input#teacher').val(event.target.innerText);
            this.searchList = [];
            this.findLessons();

        },
        findLessons() {
            if (!this.selectedId || !this.date) {
                return;
            }
            this.loading = true;
            axios.get('/api/lessons', {
                params: {
                    teacher_id: this.selectedId,
                    date: this.date
                }
            }).then(response => {
                this.lessons = response.data;
                this.loading = false;
            }).catch(error => {
                this.$store.dispatch('showNotification', error.response.data)
                this.loading = false;
            })
        }
    }
}
</script>

<style scoped>
#search_list {
    z-index: 10;
    position: absolute;
    min-width: 150px;
}
#search_container {
    position: relative;
}
.search_row {
    width: 100%;
    text-align: start;
}
.lessons .lesson .card-header div {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    /*border: 0.25rem solid rgba(255, 255, 255, 0.88);*/
}
.lesson .card-header:hover {
    cursor: pointer;
}
.lesson_order {
    border: 1px solid rgba(0, 0, 0, 0.125);
}
.time {
    border: 1px solid rgba(0, 0, 0, 0.125);
}
.group {
    border: 1px solid rgba(0, 0, 0, 0.125);
}
.subject {
    border: 1px solid rgba(0, 0, 0, 0.125);
}
.audience {
    border: 1px solid rgba(0, 0, 0, 0.125);
}

@media (min-width: 576px) {
    .subject {
        justify-content: start !important;
        align-items: start !important;
    }
}
@media (min-width: 1200px) {
    .lesson_order {
        border: none;
        border-right: 1px solid rgba(0, 0, 0, 0.125);
    }
    .time {
        border: none;
        border-left: 1px solid rgba(0, 0, 0, 0.125);
        border-right: 1px solid rgba(0, 0, 0, 0.125);
    }
    .group {
        border: none;
        border-left: 1px solid rgba(0, 0, 0, 0.125);
        border-right: 1px solid rgba(0, 0, 0, 0.125);
    }
    .subject {
        border: none;
        border-left: 1px solid rgba(0, 0, 0, 0.125);
        border-right: 1px solid rgba(0, 0, 0, 0.125);
    }
    .audience {
        border: none;
        border-left: 1px solid rgba(0, 0, 0, 0.125);
    }
}
.lesson .card-body {
    text-align: start;
}
</style>
