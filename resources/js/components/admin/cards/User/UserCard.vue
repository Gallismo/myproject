<template>
    <div class="card bg-dark user-card" @click="clickCard" :id="user.login">
        <div class="card-body">
            <h5 class="card-title d-flex justify-content-between">
                {{user.login}}
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </h5>
            <p class="card-text mb-2 d-flex justify-content-between">
                {{user.role.name}}
                <span>{{user.group_name}}</span>
            </p>
            <p class="card-text mb-2">{{user.name}}</p>
            <div class="bottom-button">
                <editButton title="Изменить пароль" @clickButton="clickButton"/>
                <DeleteButton target="#deleteConfirm" name="delete" @clickButton="clickButton"/>
            </div>
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
            },
            data_switch_action: {
                type: String,
                required: true
            }
        },
        methods: {
            clickCard(event) {
                event.preventDefault();
                const element = event.target.closest('.user-card');
                this.$store.dispatch(this.data_switch_action, element.id);
                this.$emit('clickCard', element);
            },
            clickButton(event) {
                event.preventDefault();
                event.stopPropagation();
                const element = event.target.closest('.user-card');
                this.$store.dispatch(this.data_switch_action, element.id);
                if ($(event.target).attr('name') != 'delete') {
                    this.$emit('clickButton', element);
                } else {
                    this.$emit('deleteEvent', element);
                }
            }
        }
    }
</script>

<style scoped>

</style>
