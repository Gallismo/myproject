<template>
    <ul class="list-group list-group-horizontal text-white" @click="switcher" :id="row.code">
        <li class="list-group-item bg-dark" :class="columns" v-for="(column, key) in  row" :key="key" v-show="key!=='code'">{{column}}</li>
    </ul>
</template>

<script>

    export default {
        name: "List",
        props: {
            row: {
                type: Object,
                required: true
            },
            columns: {
                type: String,
                default: 'col'
            },
            data_switch_action: {
                type: String,
                required: true
            }
        },
        methods: {
            switcher(e) {
                const parent = e.target.parentElement;
                this.$store.dispatch(this.data_switch_action, parent.id);

                this.$emit('clickEvent', parent.id);
            }
        }
    }
</script>

<style scoped>

</style>
