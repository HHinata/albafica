<template>
<div style="margin-top:20px">
    <h3>Title</h3>
    <p>{{ status.title }}</p>
    <h3>Desc</h3>
    <p>{{ status.code }}</p>
    <h3>Input</h3>
    <p>{{ status.input }}</p>
    <h3>Output</h3>
    <p>{{ status.output }}</p>
    <h3>Sample Input</h3>
    <p>{{ status.sample_input }}</p>
    <h3>Sample Output</h3>
    <p>{{ status.sample_output }}</p>
</div>
</template>

<script>
    export default {
        data: function () {
            return {
                status: {
                }
            };
        },
        mounted() {
            this.__construct();
        },
        methods: {
            __construct: function () {
                var _this = this;
                axios.get('solution/detail', { params: { id: this.$route.params.id }})
                .then(function(res) {
                    _this.status = res.data;
                    console.log(_this.status);
                });
            }
        }
    }
</script>
v