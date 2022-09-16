<template >
    <div class="card bg-dark text-white">
        <div class="card-body">
            <h5 class="card-title">
                {{ week_day }}
            </h5>
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
            type: Object,
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
