<template>
    <div class="wrapper mt-5 container">
        <div class="row justify-content-center">
            <div class="card bg-dark text-white col-10 col-sm-8 col-lg-6">
                <form class="card-body" method="POST" action="/login">
                    <div class="card-title d-flex align-items-center">
                        <a href="/" class="arrow-back"><b-icon-arrow-left class="arrow-back"/></a>
                        <h4 class="mb-0 ml-2">Вход</h4>
                    </div>
                    <div class="form-group">
                        <label for="login">Логин</label>
                        <input type="text" id="login" name="login"
                               placeholder="Ваш логин" class="form-control btn-secondary">
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" id="password" name="password"
                               placeholder="Пароль" class="form-control btn-secondary">
                    </div>
                    <div class="row justify-content-between align-items-center pr-3 pl-3">
                        <a href="#" id="forgotPassword">
                            Забыли пароль?
                        </a>
                        <b-popover target="forgotPassword" triggers="hover" placement="bottom">
                            Пожалуйста, обратитесь к администратору для восстановления пароля
                        </b-popover>
                        <button type="submit" class="btn btn-outline-success text-white col-5">
                            Войти
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {BPopover, BButton} from 'bootstrap-vue';
    export default {
        name: "login",
        components: {BPopover, BButton}
    }
</script>

<style scoped>
    .card-title a {
        color: white;
    }
</style>
