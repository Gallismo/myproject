<template>
    <ul class="list-group list-group-horizontal text-white" @click="switcher" :id="group.code">
        <li class="list-group-item bg-dark col-4"><span>{{group.name}}</span></li>
        <li class="list-group-item bg-dark col-4">{{group.department_name}}</li>
        <li class="list-group-item bg-dark col-4"><span>{{group.start_year}}</span> - <span>{{group.end_year}}</span></li>
    </ul>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "groupList",
        props: {
            group: {
                type: Object,
                required: true
            },
            data_switch: {
                type: String,
                required: true
            }
        },
        methods: {
            ...mapActions(['switchCurrentGroup']),
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
