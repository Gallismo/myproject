<template>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle col-12" type="button" :id="id" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{header}}
        </button>
        <div class="dropdown-menu bg-dark mt-1" :aria-labelledby="id">
            <a class="dropdown-item" href="#groups"
               v-for="(item, index) in getDropdownData"
               :id="index" :key="index"
               @click="switcher"
            >{{item}}</a>
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
            ...mapActions(['switchCurrentGroup']),
            switcher(e) {
                this.switchCurrentGroup(e.target.id);
            }
        },
        computed: {
            ...mapGetters(['getDropdownData', 'getCurrentGroup']),
            header: function () {
                return this.getDropdownData[Object.keys(this.getDropdownData).find(code => code === this.getCurrentGroup.code)]
            }
        },
    }
</script>

<style scoped>

</style>
