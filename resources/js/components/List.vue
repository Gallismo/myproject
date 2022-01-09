<template>
    <ul class="list-group list-group-horizontal text-white" @click="switcher" :id="entity.code">
<!--        <li class="list-group-item bg-dark col-4">{{group.name}}</li>-->
<!--        <li class="list-group-item bg-dark col-4">{{group.department_name}}</li>-->
<!--        <li class="list-group-item bg-dark col-4"><span>{{group.start_year}}</span> - <span>{{group.end_year}}</span></li>-->
        <li class="list-group-item bg-dark" :class="columns" v-for="(column, key) in  entity" :key="key" v-show="key!=='code'">{{column}}</li>
    </ul>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "groupList",
        props: {
            entity: {
                type: Object,
                required: true
            },
            columns: {
                type: String,
                default: 'col'
            },
            scrollTo: {
                type: String,
                required: true
            }
        },
        methods: {
            ...mapActions(['switchCurrentGroup']),
            switcher(e) {
                let top = $(this.scrollTo).offset().top - 50;
                $('body,html').animate({scrollTop: top}, 300);

                let parent = e.target.parentElement;
                this.switchCurrentGroup(parent.id);
            }
        }
    }
</script>

<style scoped>

</style>
