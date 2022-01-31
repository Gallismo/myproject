<template>
    <div class="modal fade" :id="id" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title" id="staticBackdropLabel">{{title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <component v-bind:is="body"></component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
export default {
    name: "BootstrapModal",
    props: {
        id: {
            type: String,
            required: true
        },
        title: {
            type: String,
            default: 'Модальное окно'
        },
        body: {
            type: String,
            required: true
        }
    },
    methods: {
        confirmEvent() {
            this.$emit('confirmEvent')
        }
    },
    computed: {
        ...mapGetters(['getLoading'])
    }
}
</script>

<style scoped>

</style>
