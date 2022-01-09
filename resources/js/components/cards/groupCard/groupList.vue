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
            }
        },
        methods: {
            ...mapActions(['switchCurrentGroup']),
            switcher(e) {
                let top = $('a[name=groups]').offset().top - 50;
                $('body,html').animate({scrollTop: top}, 300);

                let parent = e.target.parentElement;
                this.switchCurrentGroup(parent.id);
            }
        }
    }
</script>

<style scoped>

</style>
