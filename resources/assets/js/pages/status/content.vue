<template>
<div style="text-align: center">
    <p>Submit from {{status.user.name}} at {{status.created_at}}</p>
    <p>Time: {{status.time}} Memory: {{status.memory}} Lang: {{langFormat(status.lang)}} Lang: {{resultFormat(status.result)}}</p>
    <pre style="text-align: left"><code>{{status.code}}</code></pre>
</div>
</template>
<script>
    export default {
        data: function () {
            return {
                status: {
                    user:{}
                },
                resOptions: {
                    0:"Queuing",
                    1:"Accepted",
                    2:"Wrong Answer",
                    3:"Presentation Error",
                    4:"Compilation Error",
                    5:"Runtime Error",
                    6:"Time Limit Exceeded",
                    7:"Memory Limit Exceeded",
                    8:"Output Limit Exceeded",
                },
                langOptions: {
                    1:'C++',
                    2:'C',
                    3:'JAVA'
                },
            };
        },
        mounted() {
            var _this = this;
            axios.get('solution/detail', { params: { id: this.$route.params.id }})
                .then(function(res) {
                    _this.status = res.data;
                });
        },
        methods: {
            resultFormat: function (result) {
                return this.resOptions[result];
            },
            langFormat: function (lang) {
                return this.langOptions[lang];
            },
        }
    }
</script>
<style>
    code {
        text-indent:0;
        border-color:#000;
        border-style:dashed;
        border-width:1px;
        display:block;
        font-size:18px;
        font-family:Courier, Calibri,"宋体";
        margin:10px 0 0 0;
        padding:10px 0 10px 5px;
        -moz-border-radius:5px;
        background:#f5f5f5;
        color:#000;
    }
</style>