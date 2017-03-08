<template>
<div>
    <h4>Time: {{status.time}} Memory: {{status.memory}} Lang: {{status.lang}}</h4>
    <pre><code>{{status.code}}</code></pre>
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
                });
            }
        }
    }
</script>
v