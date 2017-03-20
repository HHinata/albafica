<template>
<div>
    <div class='caption'>
      <h2>{{problem.id}}.{{ problem.title }}</h2>
      <p>Time limit per test: {{ problem.time_limit }} second</p>
      <p>Memory limit per test: {{ problem.mem_limit }} megabytes</p>
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
            <div v-html="problem.sample_output"><b>asdf</b></div>
    </div>
</div>
</template>

<script>
    export default {
        data: function () {
            return {
                problem: {
                },
                starStyle:{color:'blue'}
            };
        },
        props: ['pid'],
        mounted() {
            var _this = this;
            axios.get('problem/detail', { params: { id: this.pid }})
                .then(function(res) {
                    _this.problem = res.data;
                });
        },
        methods: {
            starOn: function() {
                var _this = this;
                axios.post('problem/star', {id: this.problem.id})
                    .then(function (res) {
                        _this.problem.users_count ^= 1;
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

    .pro-content, .caption p{
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 1em;
        line-height: 1.4em;
    }

</style>