<template>
<div style="margin-top:20px">
    <h3>Title</h3>
    <p>{{ contest.title }}</p>
    <h3>Desc</h3>
    <p>{{ contest.desc }}</p>
    <h3>Input</h3>
    <p>{{ contest.input }}</p>
    <h3>Output</h3>
    <p>{{ contest.output }}</p>
    <h3>Sample Input</h3>
    <p>{{ contest.sample_input }}</p>
    <h3>Sample Output</h3>
    <p>{{ contest.sample_output }}</p>
</div>
</template>

<script>
    export default {
        data: function () {
            return {
                contest: {
                }
            };
        },
        mounted() {
            this.__construct();
        },
        methods: {
            __construct: function () {
                var _this = this;
                axios.get('contest/detail', { params: { id: this.$route.params.id }})
                .then(function(res) {
                    _this.contest = res.data;
                    console.log(_this.contest);
                });
            }
        }
    }
</script>
