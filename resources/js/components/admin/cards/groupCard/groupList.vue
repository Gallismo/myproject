<template>
    <ul class="list-group list-group-horizontal text-white" @click="switcher" :data-id="group.id">
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
            switcher(event) {
                const element = $(event.target).parents('.list-group')[0];
                const id = $(element).attr('data-id')
                console.log(id);
                this.$store.dispatch(this.data_switch, id);

                this.$emit('clickEvent', id);
            }
        }
    }
</script>

<style scoped>

</style>
