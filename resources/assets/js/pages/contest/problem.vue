<template>
<div>
    <div name="info" v-if="problem.id">
        <div class='caption'>
          <h2>{{ problem.title }}</h2>
          <p>time limit per test: {{ problem.time_limit }} second</p>
          <p>memory limit per test: {{ problem.mem_limit }} megabytes</p>
        </div>
        <div class='pro-content'>
                <div v-html="problem.desc"></div>
            <h3>Input</h3>
                <div v-html="problem.input"></div>
            <h3>Output</h3>
                <div v-html="problem.output"></div>
            <h3>Sample Input</h3>
                <div v-html="problem.sample_input"></div>
            <h3>Sample Output</h3>
                <div v-html="problem.sample_output"></div>
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