<template>
    <section>
         <div class="card bg-dark text-white container mt-lg-5 mt-4">
             <component v-bind:is="currentTab" class="card-body"></component>
         </div>
    </section>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "Card",
        computed: {
            ...mapGetters({
                currentTab: 'getCurrentTab'
            })
        }
    }
</script>

<style scoped>

</style>
