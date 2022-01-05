<template>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button"
                id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            {{header}}
        </button>
        <div class="dropdown-menu bg-dark mt-1" aria-labelledby="dropdownMenuButton">
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
                default: '...'
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
