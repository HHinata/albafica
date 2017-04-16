<template>
<div>
    <el-tabs v-model="activeName">
        <el-tab-pane label="DETAIL" name="detail">
            <detail :pid="$route.params.id" v-on:submit='submit'></detail>
        </el-tab-pane>
        <el-tab-pane label="SUBMIT" name="submit">
            <submit :pid="$route.params.id"></submit>
        </el-tab-pane>
        <el-tab-pane label="DISCUSS" name="discuss">
            <discuss :pid="$route.params.id"></discuss>
        </el-tab-pane>
    </el-tabs>
</div>
</template>

<script>
    import detail from './detail.vue'
    import submit from './submit.vue'
    import discuss from './discuss.vue'
    export default {
        data: function () {
            return {
                activeName: 'detail'
            };
        },
        components: { 'detail': detail, 'submit': submit, 'discuss': discuss },
        methods: {
            submit: function (val) {
                this.activeName = 'submit';
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