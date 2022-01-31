<template>
    <div class="modal fade" :id="id" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-confirm bg-dark w-75 m-auto">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title" id="staticBackdropLabel">Подтвердите действие</h5>
                    <button type="button" class="close" @click="close" :data-close="id">
                        <span aria-hidden="true" @click="close" :data-close="id">&times;</span>
                    </button>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-primary text-white"
                            @click="confirmEvent" :data-close="id">
                        Подтвердить
                    </button>
                    <button type="button" class="btn btn-outline-danger text-white" @click="close" :data-close="id">Отмена</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BootstrapModalConfirm",
        props: {
            id: {
                type: String,
                required: true
            }
        },
        methods: {
            confirmEvent(event) {
                this.$emit('confirmEvent');
                this.close(event);
            },
            close(event) {
                $("#" + $(event.target).attr('data-close')).modal('hide');
            }
        }
    }
</script>

<style scoped>

</style>
