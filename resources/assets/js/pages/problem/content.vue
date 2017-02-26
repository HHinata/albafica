<template>
<div style="margin-top:20px">
    <h3>Title</h3>
    <p>{{ problem.title }}</p>
    <h3>Desc</h3>
    <p>{{ problem.desc }}</p>
    <h3>Input</h3>
    <p>{{ problem.input }}</p>
    <h3>Output</h3>
    <p>{{ problem.output }}</p>
    <h3>Sample Input</h3>
    <p>{{ problem.sample_input }}</p>
    <h3>Sample Output</h3>
    <p>{{ problem.sample_output }}</p>
</div>
</template>

<script>
    export default {
        data: function () {
            return {
                problem: {
                }
            };
        },
        mounted() {
            this.__construct();
        },
        methods: {
            __construct: function () {
                var _this = this;
                axios.get('problem/detail', { params: { id: this.$route.params.id }})
                .then(function(res) {
                    _this.problem = res.data;
                    console.log(_this.problem);
                });
            }
        }
    }
</script>
