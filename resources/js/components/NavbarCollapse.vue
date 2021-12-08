<template>
    <div class="collapse navbar-collapse" :id="id">
        <ul class="navbar-nav">
            <NavDropdown :id="index" :dropdown="item" v-for="(item, index) in links.dropdowns"
                         :key="index" @switchTab="switchTab"
            >

            </NavDropdown>
            <NavbarItem :name="[index, link]" v-for="(link, index) in links.simpleLinks"
                        :key="index" @switchHandle="switchTab"
            ></NavbarItem>
            <NavbarItem class="ml-lg-auto" :name="['Logout', 'Выйти']"></NavbarItem>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "NavbarCollapse",
        props: ['id'],
        methods: {
            switchTab: function (name){
                this.$emit('switchTab', name);
            },
        },
        data: function () {
            return {
                links: {
                    simpleLinks: {
                        Prepod:'Преподаватели',
                        User:'Пользователи'
                    },
                    dropdowns: {
                        dropdown1: {
                            name: 'Звонки и расписания',
                            items: {
                                Schedule:'Расписание звонков',
                                Booking:'Расписание занятий'
                            }
                        },
                        dropdown2: {
                            name: 'Группы и аудитории',
                            items: {
                                Groups:'Группы',
                                Counter:'Счетчик остатка часов',
                                Subjects:'Предметы',
                                Audiences:'Аудитории',
                                Department:'Отделения'
                            }
                        }
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
