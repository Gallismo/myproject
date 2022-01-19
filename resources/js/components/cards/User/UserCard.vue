<template>
    <div class="card bg-dark user-card" @click="clickCard" :data-user="user.login">
        <div class="card-body">
            <h5 class="card-title">{{user.login}}</h5>
            <p class="card-text mb-2">{{user.role.name}}</p>
            <p class="card-text mb-2" v-if="user.name">{{user.name}}</p>
            <editButton title="Изменить пароль" class="bottom-button" @clickButton="clickButton"/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserCard",
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        methods: {
            clickCard(event) {
                event.preventDefault();

                this.$emit('clickCard', event.target.closest('.user-card'));
            }
        }
    }
</script>

<style scoped>

</style>
