<template>
    <div class="card bg-dark text-white">
        <div class="card-body" @click="editGroup">
            <div><h5 class="card-title" id="GroupName">{{group.name}}</h5></div>
            <div class="card-text" id="DepartmentName">{{group.department_name}}</div>
            <div class="card-text" id="StartYear">{{group.start_year}}</div>
            <div class="card-text" id="EndYear">{{group.end_year}}</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "groupDescription",
        props: {
            group: {
                type: Object,
                required: true
            }
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
