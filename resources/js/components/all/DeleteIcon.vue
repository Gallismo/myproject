<template>
        <button type="button" class="delete-icon" @click="deleteEvent" data-toggle="modal" :data-target="target">
            <img src="/img/delete-icon.svg">
        </button>
</template>

<script>
export default {
    name: "DeleteIcon",
    props: {
        target: {
            type: String,
            required: true
        },
        data_switch_action:{
            type: String,
            required: true
        }
    },
    methods: {
        deleteEvent(event) {
            event.preventDefault();
            event.stopPropagation();
            const item = $(event.target).parents('.grid-item')[0];
            const id = $(item).attr('data-id');
            this.$store.dispatch(this.data_switch_action, id);
            $(this.target).modal('show');
        }
    }
}
</script>

<style scoped>

</style>
