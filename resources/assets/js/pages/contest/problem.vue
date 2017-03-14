<template>
<div>
    <div name="info" v-if="problem.id">
        <div class='caption'>
          <h2>{{ problem.title }}</h2>
          <p>time limit per test: {{ problem.time_limit }} second</p>
          <p>memory limit per test: {{ problem.mem_limit }} megabytes</p>
        </div>
        <div class='content'>
            <h3>Desc</h3>
                <blockquote v-html="problem.desc"></blockquote>
            <h3>Input</h3>
                <blockquote v-html="problem.input"></blockquote>
            <h3>Output</h3>
                <blockquote v-html="problem.output"></blockquote>
            <h3>Sample Input</h3>
                <blockquote v-html="problem.sample_input"></blockquote>
            <h3>Sample Output</h3>
                <blockquote v-html="problem.sample_output"></blockquote>
        </div>
    </div>
    <div v-else>
        <h1>There not have Problems</h1>
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
        props: ['pid', 'cid'],
        mounted() {
            var _this = this;
            axios.get('contest/problem', { params: { id: this.pid, cid: this.cid }})
                .then(function(res) {
                    _this.problem = res.data;
                });
        },
        watch: {
            pid: function () {
                var _this = this;
                axios.get('contest/problem', { params: { id: this.pid, cid: this.cid }})
                .then(function(res) {
                    _this.problem = res.data;
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