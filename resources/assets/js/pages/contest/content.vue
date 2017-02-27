<template>
<div>
    <el-tabs v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="OVERVIEW" name="overview">
            <overview :cid="$route.params.id"></overview>
        </el-tab-pane>
        <el-tab-pane label="PROBLEM" name="problem">
            <problem :pid="1"></problem>
        </el-tab-pane>
        <el-tab-pane label="SUBMIT" name="submit">
            <submit :cid="$route.params.id" :pid="$route.params.id"></submits>
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
                activeName: 'overview'
            };
        },
        components:{ 'overview': detail, 'submit': submit, 'problem': problem},
        methods: {
            handleClick(tab, event) {
                console.log(tab, event);
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