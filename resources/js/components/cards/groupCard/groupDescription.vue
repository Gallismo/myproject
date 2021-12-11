<template>
    <div class="card bg-dark text-white">
        <form class="card-body">
            <div class="card-text row align-items-center justify-content-around">Выбрать группу <slot></slot></div>
            <div class="card-text " id="GroupName">Название группы {{getCurrentGroup.name}}</div>
            <formGroup></formGroup>
            <div class="card-text" id="DepartmentName">Отделение {{getCurrentGroup.department_name}}</div>
            <div class="card-text" id="StartYear">Год поступления {{getCurrentGroup.start_year}}</div>
            <div class="card-text" id="EndYear">Год окончания {{getCurrentGroup.end_year}}</div>
        </form>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    export default {
        name: "groupDescription",
        computed: {
            ...mapGetters(['getCurrentGroup'])
        },
        methods: {
            replaceTag: function (element, newTag)  {
                let elementNew = document.createElement(newTag);
                if (element.localName === newTag) {
                    return;
                }
                elementNew.value = element.innerHTML;

                Array.prototype.forEach.call( element.attributes, function(attr) {
                    elementNew.setAttribute( attr.name, attr.value );
                });

                element.parentNode.insertBefore( elementNew, element );
                element.parentNode.removeChild( element );
                return elementNew;
            },
            editGroup: function (event) {
                let element = document.getElementById(event.target.id);
                switch (event.target.id) {
                    case 'GroupName':
                        this.replaceTag(element, 'input');
                        break;
                    case 'DepartmentName':
                        console.log('DepartmentName');
                        break;
                    case 'StartYear':
                        console.log('StartYear');
                        break;
                    case 'EndYear':
                        console.log('EndYear');
                        break;
                    default:
                        console.log('Lox');
                }
            }
        }
    }
</script>

<style scoped>

</style>
