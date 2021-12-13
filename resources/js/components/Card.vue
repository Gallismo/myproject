<template>
    <section>
         <div class="card bg-dark text-white container mt-lg-5 mt-4">
                 <keep-alive>
                     <component v-bind:is="tab" class="card-body flex row justify-content-around"></component>
                 </keep-alive>
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
