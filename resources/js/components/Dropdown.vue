<template>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" :id="id" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{header}}
        </button>
        <div class="dropdown-menu bg-dark mt-2" :aria-labelledby="id">
            <a class="dropdown-item" href="#"
               v-for="(item, index) in list"
               :id="index" :key="index"
               @click="changeGroup"
            >{{item}}</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dropdown",
        async mounted() {
            console.log(this.groupList);
        },
        data: function () {
            return {
                header: '',
                groupList: this.list
            }
        },
        watch: {
            groupList: function (newValue, oldValue) {
                this.header = Object.values(this.groupList)[0]
            }
        },
        props: {
            list: {
                type: Object,
                required: true
            },
            id: {
                type: String,
                required: true
            }
        },
        methods: {
            changeGroup: function (event) {
                this.$emit('changeGroup', event.target.id)
            }
        }
    }
</script>

<style scoped>

</style>
