<template>
    <section>
         <div class="card bg-dark text-white container mt-lg-5 mt-4">
                 <component v-bind:is="tab" class="card-body flex row"></component>
         </div>
    </section>
</template>

<script>
    export default {
        name: "Card",
        props: {
            tab: {
                type: String
            }
        }
    }
</script>

<style scoped>

</style>
