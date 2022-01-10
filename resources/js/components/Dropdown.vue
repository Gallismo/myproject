<template>
    <div class="dropdown col-xl-6 col-lg-7 col-md-12 mt-2 mt-lg-0">
        <button class="btn btn-secondary dropdown-toggle col-12" type="button"
                id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            {{header}}
        </button>
        <div class="dropdown-menu bg-dark mt-1 col-11" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item"
               v-for="(name, code) in items" :key="code"
               :id="code" @click="click">{{name}}</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dropdown",
        props: {
            items: {
                type: Object,
                required: true
            },
            header: {
                type: String,
                default: 'Выберите'
            }
        },
        methods: {
            click(event) {
                this.$emit('clickEvent', event)
            }
        }
    }
</script>

<style scoped>

</style>
