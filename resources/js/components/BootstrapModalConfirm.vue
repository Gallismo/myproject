<template>
    <div class="modal fade" :id="id" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title" id="staticBackdropLabel">Подтвердите действие</h5>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-primary text-white"
                            data-dismiss="modal" @click="confirmEvent">
                        Подтвердить
                    </button>
                    <button type="button" class="btn btn-outline-danger text-white" data-dismiss="modal">Отмена</button>
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
            confirmEvent() {
                this.$emit('confirmEvent')
            }
        }
    }
</script>

<style scoped>

</style>
