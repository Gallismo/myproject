<template>
    <ul class="list-group list-group-horizontal text-white" href="#list" @click="switcher" :id="group.code">
        <li class="list-group-item bg-dark col-4">{{group.name}}</li>
        <li class="list-group-item bg-dark col-4">{{group.department_name}}</li>
        <li class="list-group-item bg-dark col-4"><span>{{group.start_year}}</span> - <span>{{group.end_year}}</span></li>
    </ul>
</template>

<script>
    import {mapActions} from "vuex";

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
                let top = $('a[name=groups]').offset().top;
                $('body,html').animate({scrollTop: top}, 300);
                let target = e.target;
                let parent = target.parentElement;
                this.switchCurrentGroup(parent.id);
            }
        }
    }
</script>

<style scoped>

</style>
