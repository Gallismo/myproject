<template>
    <a class="list-group list-group-horizontal text-white" href="#list">
        <li class="list-group-item bg-dark col-4">{{group.name}}</li>
        <li class="list-group-item bg-dark col-4">{{group.department_name}}</li>
        <li class="list-group-item bg-dark col-4"><span>{{group.start_year}}</span> - <span>{{group.end_year}}</span></li>
    </a>
</template>

<script>
    export default {
        name: "groupList",
        props: {
            group: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
