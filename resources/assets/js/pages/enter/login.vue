<template>
<el-row>
    <el-col :span="12" :offset="6">
        <el-form ref="form" :model="form" label-width="80px">
            <el-form-item label="邮箱">
                <el-input v-model="form.email"></el-input>
            </el-form-item>
            <el-form-item label="密码">
                <el-input type="password" v-model="form.password"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="login">登陆</el-button>
                <el-button>取消</el-button>
            </el-form-item>
        </el-form>
    </el-col>
</el-row>
</template>

<script>
    export default {
        data: function () {
            return {
                form: {}
            };
        },
        methods: {
            login: function() {
                var _this = this;
                axios.post('login', this.form).then(function(res) {
                    _this.$message({
                        message: '恭喜你，登陆成功',
                        type: 'success'
                    });
                    _this.$emit('login', true)
                    window.location.hash = '/';
                })
                .catch(function (error) {
                    _this.$message({
                        message: '你的信息有误,请重新提交',
                        type: 'error'
                    });
                });
            }
        }
    }
</script>