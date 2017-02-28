<template>
<div>
    <el-tabs v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="OVERVIEW" name="overview">
            <overview :cid="$route.params.id" v-on:show='show' v-on:submit='submit' ></overview>
        </el-tab-pane>
        <el-tab-pane label="PROBLEM" name="problem">
            <problem :pid="pid" :cid="cid"></problem>
        </el-tab-pane>
        <el-tab-pane label="SUBMIT" name="submit">
            <submit :cid="cid" :pid="pid"></submit>
        </el-tab-pane>
    </el-tabs>
</div>
</template>

<script>
    import detail from './detail.vue'
    import problem from './problem.vue'
    import submit from './submit.vue'
    export default {
        data: function () {
            return {
                activeName: 'overview',
                pid: 0,
                cid: this.$route.params.id
            };
        },
        components:{ 'overview': detail, 'submit': submit, 'problem': problem},
        methods: {
            handleClick: function(tab, event) {
                console.log(tab, event);
            },
            show: function (index) {
                this.activeName = 'problem';
                this.pid = index;
            },
            submit: function (index) {
                this.activeName = 'submit';
                this.pid = index;
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