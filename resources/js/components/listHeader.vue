<template>
    <ul class="list-group list-group-horizontal list-group-header">
        <li class="list-group-item bg-dark" v-for="column in row" :class="columns">{{column}}</li>
    </ul>
</template>

<script>
    export default {
        name: "listHeader",
        props: {
            row: {
                type: Array,
                required: true
            },
            columns: {
                type: String,
                default: "col"
            }
        }
    }
</script>

<style scoped>

</style>
