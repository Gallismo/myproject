<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            axios({
                method: 'get',
                url: '/admin',
                headers: {
                    Authorization: 'Bearer MkrJXCDjE484OU1VKTgAMIfC1O4iTT'
                }
            });
        },
        name: 'ExampleComponent'
    }
</script>
