<template>
<div>
    <el-tabs v-if="visible" v-model="activeName">
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
    <el-dialog title="密码验证" v-model="dialogFormVisible" :show-close="false">
        <el-input v-model="password" auto-complete="off"></el-input>
        <div slot="footer" class="dialog-footer">
            <el-button type="primary" @click="verify">确 定</el-button>
        </div>
    </el-dialog>
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
                cid: this.$route.params.id,
                visible: false,
                dialogFormVisible: false,
                password: ""
            };
        },
        components:{ 'overview': detail, submit, problem, discuss, rank, status},
        mounted:function () {
            this.verify();
        },
        methods: {
            show: function (index) {
                this.activeName = 'problem';
                this.pid = index;
            },
            submit: function (index) {
                this.activeName = 'submit';
                this.pid = index;
            },
            verify: function () {
                var _this = this;
                axios.get('contest/verify', { params: { id: this.cid, pwd: _this.password }})
                    .then(function(res) {
                        _this.visible = true;
                        _this.dialogFormVisible = false;
                    })
                    .catch(function () {
                        _this.$message({
                            message: '权限不足',
                            type: 'error'
                        });
                        _this.dialogFormVisible = true;
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