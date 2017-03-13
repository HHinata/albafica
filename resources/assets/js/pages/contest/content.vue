<template>
<div>
    <el-tabs v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="OVERVIEW" name="overview">
            <overview :cid="$route.params.id" v-on:show='show' v-on:submit='submit' ></overview>
        </el-tab-pane>
        <el-tab-pane label="PROBLEM" name="problem">
            <problem :pid="pid" :cid="cid"></problem>
        </el-tab-pane>
        <el-tab-pane label="STATUS" name="status">
            <status :cid="cid"></status>
        </el-tab-pane>
        <el-tab-pane label="SUBMIT" name="submit">
            <submit :cid="cid" :pid="pid"></submit>
        </el-tab-pane>
        <el-tab-pane label="DISCUSS" name="discuss">
            <discuss :cid="cid"></discuss>
        </el-tab-pane>
        <el-tab-pane label="RANK" name="rank">
            <rank :cid="cid"></rank>
        </el-tab-pane>
    </el-tabs>
</div>
</template>

<script>
    import detail from './detail.vue'
    import problem from './problem.vue'
    import submit from './submit.vue'
    import discuss from './discuss.vue'
    import rank from './rank.vue'
    import status from './status.vue'

    export default {
        data: function () {
            return {
                activeName: 'overview',
                pid: 0,
                cid: this.$route.params.id
            };
        },
        components:{ 'overview': detail, submit, problem, discuss, rank, status},
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