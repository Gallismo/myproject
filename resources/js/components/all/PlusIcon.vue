<template>
        <button type="button" class="plus-icon" @click="addEvent" data-toggle="modal" :data-target="target">
            <img src="/img/PlusIcon.svg">
        </button>
</template>

<script>
export default {
    name: "DeleteIcon",
    props: {
        target: {
            type: String,
            required: true
        }
    },
    methods: {
        addEvent(event) {
            event.preventDefault();
            event.stopPropagation();

            $(this.target).modal('show');
        }
    }
}
</script>

<style scoped>

</style>
