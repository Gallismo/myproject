<template >
    <div class="card bg-dark text-white">
        <button type="button" data-toggle="collapse"
                class="card-header"
                :data-target="'#schCollapse' + schedules[0].id"
                aria-expanded="false"
                :aria-controls="'schCollapse' + schedules[0].id">
            <h5>{{ week_day }}</h5>
        </button>
        <div class="card-body collapse" :id="'schCollapse' + schedules[0].id">
            <ScheduleLesson v-for="schedule in schedules" :key="schedule.id + 'key'" :schedule="schedule"/>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        week_day: {
            type: String,
            required: true
        },
        schedules: {
            type: Array,
            required: true
        }
    }
}
</script>
<style>
    .card-img-break{
        width: 16px;
        height: 16px;
        position: relative;
        top:-1px;
    }
</style>
