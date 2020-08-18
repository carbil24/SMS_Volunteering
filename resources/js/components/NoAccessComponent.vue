<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Access denied.</div>

                    <div class="card-body">
                        You have no permission to see this page.
                    </div>

                    <a class="btn btn-link btn-block" href="/home">Back</a>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
