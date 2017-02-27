<template>
<div>
    <div class='caption'>
      <h2>{{ problem.title }}</h2>
      <p>time limit per test: {{ problem.time_limit }} second</p>
      <p>memory limit per test: {{ problem.mem_limit }} megabytes</p>
    </div>
    <div class='content'>
        <h3>Desc</h3>
            <blockquote>{{ problem.desc }}</blockquote>
        <h3>Input</h3>
            <blockquote>{{ problem.input }}</blockquote>
        <h3>Output</h3>
            <blockquote>{{ problem.output }}</blockquote>
        <h3>Sample Input</h3>
            <blockquote>{{ problem.sample_input }}</blockquote>
        <h3>Sample Output</h3>
            <blockquote>{{ problem.sample_output }}<b>asdf</b></blockquote>
    </div>
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
        props: ['pid'],
        mounted() {
            this.__construct();
        },
        methods: {
            __construct: function () {
                console.log(this.pid);
                var _this = this;
                axios.get('problem/detail', { params: { id: this.pid }})
                .then(function(res) {
                    _this.problem = res.data;
                    console.log(_this.problem);
                });
            }
        },
        watch: {
            pid: function () {
                var _this = this;
                axios.get('problem/detail', { params: { id: this.pid }})
                .then(function(res) {
                    _this.problem = res.data;
                    console.log(_this.problem);
                });
            }
        }
    }
</script>

<style>
    .caption {
        text-align: center;
    }
    .footer {
        margin-top: 20px;
        text-align: center;
    }
</style>