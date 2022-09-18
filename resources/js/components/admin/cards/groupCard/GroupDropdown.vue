<template>
    <div class="dropdown mb-1 col-xl-6 col-lg-7 col-md-12 mt-2 mt-lg-0">
        <button class="btn btn-secondary dropdown-toggle col-12" type="button" :id="id" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{getCurrentGroup.name}}
        </button>
        <div class="dropdown-menu bg-dark mt-1 col-11" :aria-labelledby="id">
            <a class="dropdown-item" id="createGroup" @click="switcher">Создать новую</a>
            <a class="dropdown-item" v-for="(item, index) in getDropdownData"
               :data-id="index" :key="index" @click="switcher">
                {{item}}
            </a>
        </div>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    export default {
        name: "GroupDropdown",
        props: {
            id: {
                type: String,
                required: true
            }
        },
        methods: {
            ...mapActions(['switchCurrentGroup', 'switchGroupAction']),
            switcher(e) {
                if (e.target.id === 'createGroup') {
                    this.switchGroupAction(false);
                } else {
                    this.switchGroupAction(true);
                    this.switchCurrentGroup(e.target.id);
                }
            }
        },
        computed: {
            ...mapGetters(['getDropdownData', 'getCurrentGroup'])
        },
    }
</script>

<style scoped>

</style>
