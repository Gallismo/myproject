<template>
    <div class="card bg-dark text-white grid-item mb-1" :data-id="schedule.id">
        <div class="card-body">
            <h5 class="card-title">
                {{ schedule.lesson_order_name }}
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
export default {
    name: "ScheduleLesson",
    props: {
        schedule: {
            type: Object,
            required: true
        }
    },
    mounted() {
        console.log(this.schedule)
    }
}
</script>

<style scoped>

</style>
