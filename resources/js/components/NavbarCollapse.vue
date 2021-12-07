<template>
    <div class="collapse navbar-collapse" :id="id">
        <ul class="navbar-nav">
            <NavDropdown :id="index" :dropdown="item" v-for="(item, index) in links.dropdowns" :key="index"></NavDropdown>
            <NavbarItem :name="link" v-for="link in links.simpleLinks" :key="link"></NavbarItem>
            <NavbarItem class="ml-lg-auto" name="Выйти"></NavbarItem>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "NavbarCollapse",
        props: ['id'],
        data: function () {
            return {
                links: {
                    simpleLinks: [
                        'Преподаватели',
                        'Пользователи'
                    ],
                    dropdowns: {
                        dropdown1: {
                            name: 'Звонки и расписания',
                            items: [
                                'Расписание звонков',
                                'Расписание занятий'
                            ]
                        },
                        dropdown2: {
                            name: 'Группы и аудитории',
                            items: [
                                'Группы',
                                'Счетчик остатка часов',
                                'Предметы',
                                'Аудитории',
                                'Отделения'
                            ]
                        }
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
