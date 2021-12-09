<template >
    <div @click="log" class="justify-content-center">
        <Dropdown :list="dropdownProp" id="GroupDropdown" @changeGroup="changeGroup" class="col-6 col-md-2"></Dropdown>
        <Card2 :group="currentGroup" class="col-4"></Card2>
    </div>
</template>

<script>
    export default {
        name: "Groups",
        async created() {
            await this.getAllGroups();
        },
        data: function () {
            return {
                currentGroup: {},
                groupsData: [],
                dropdownProp: {}
            }
        },
        watch: {
            groupsData: function () {
                this.currentGroup = this.groupsData[0]
            }
        },
        methods: {
            log: function () {
                // console.log(this.currentGroup);
            },
            getAllGroups: function () {
                axios('/api/Group')
                    .then(response => response.data)
                    .then(data => this.groupsData = data)
                    .catch(error => {
                        if (error.response) {
                            // Request made and server responded
                            console.log(error.response.data);
                            console.log(error.response.status);
                            console.log(error.response.headers);
                        } else if (error.request) {
                            // The request was made but no response was received
                            console.log(error.request);
                        } else {
                            // Something happened in setting up the request that triggered an Error
                            console.log('Error', error.message);
                        }
                    })
                    .then(info => {
                    info.map(group => {
                        this.$set(this.dropdownProp, group.code, group.name);
                    });
                });

            },
            changeGroup: function (code) {
                let target = this.groupsData.filter(obj => obj.code === code)[0];
                this.currentGroup = target;
            }
        }
    }
</script>

<style scoped>

</style>
