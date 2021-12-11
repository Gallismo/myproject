<template>
    <div class="form-group">
        <label for="exampleInputEmail1">Адрес электронной почты</label>
        <input type="email" class="form-control"
               id="exampleInputEmail1" aria-describedby="emailHelp" v-model="this.name">
        <small id="emailHelp" class="form-text text-muted">Мы никогда никому не передадим Вашу электронную почту.</small>
    </div>
</template>

<script>
    export default {
        name: "formGroup",
        inject: {
            name: {
                type: String,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
