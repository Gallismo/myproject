<template>
    <div class="card bg-dark text-white grid-item mb-1" :data-id="schedule.id">
        <div class="card-body">
            <h5 class="card-title justify-content-between d-flex">
                {{ schedule.lesson_order_name }}
                <DeleteIcon @clickDelete="deleteD"/>
            </h5>
            <p class="card-text">
                {{ schedule.start_time }}-{{ schedule.end_time }}
                <img src="/img/break.svg" class="card-img-break">
                {{ schedule.break }}м
            </p>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "ScheduleLesson",
    props: {
        schedule: {
            type: Object,
            required: true
        }
    },
    methods: {
        ...mapActions(['deleteSchedule']),
        deleteD(event) {
            console.log();
            const item = $(event.target).parents('.grid-item')[0];
            const id = $(item).attr('data-id');
            this.deleteSchedule({id})
        }
    }
}
</script>

<style scoped>

</style>
