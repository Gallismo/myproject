<template>
    <ul class="list-group list-group-horizontal text-white" @click="switcher" :id="entity.code">
        <li class="list-group-item bg-dark" :class="columns" v-for="(column, key) in  entity" :key="key" v-show="key!=='code'">{{column}}</li>
    </ul>
</template>

<script>

    export default {
        name: "List",
        props: {
            entity: {
                type: Object,
                required: true
            },
            columns: {
                type: String,
                default: 'col'
            },
            data_switch: {
                type: String,
                required: true
            }
        },
        methods: {
            switcher(e) {
                let parent = e.target.parentElement;
                this.$store.dispatch(this.data_switch, parent.id);

                this.$emit('clickEvent', parent.id);
            }
        }
    }
</script>

<style scoped>

</style>
