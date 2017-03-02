<template>
<div>
    <el-row>
        <el-col :span="24">
            <el-form :inline="true">
                <el-form-item label="Problem ID:">
                    <el-input v-model="pid" placeholder="Problem ID"></el-input>
                </el-form-item>
                <el-form-item label="Lang:">
                    <el-select v-model="lang" placeholder="Language">
                        <el-option v-for="item in options" :label="item.label" :value="item.value" ></el-option>
                    </el-select>
                </el-form-item>
            </el-form>
        </el-col>
        <el-col :span="24">
            <editor v-model="code" @init="editorInit();" lang="html" theme="chrome" width="100%" height="600"></editor>
        </el-col>
    </el-row>
x
    <div class='footer'>
        <el-button type="primary" @click="submit">提交</el-button>
    </div>
</div>
</template>

<script>
    export default {
        data: function () {
            return {
                code: '// Type away! \n',
                lang: '',
                options:[
                    {
                        value: 1,
                        label: 'C++'
                    }, {
                        value: 2,
                        label: 'C'
                    }, {
                        value: 3,
                        label: 'JAVA'
                    }
                ]
            };
        },
        props: ['pid', 'cid'],
        components: {
            editor:require('vue2-ace-editor')
        },
        methods: {
            editorInit:function () {
                require('vue2-ace-editor/node_modules/brace/mode/html');
                require('vue2-ace-editor/node_modules/brace/mode/javascript');
                require('vue2-ace-editor/node_modules/brace/mode/less');
                require('vue2-ace-editor/node_modules/brace/theme/chrome');
            },
            submit: function () {
                var _this = this;
                axios.post('contest/submit', { pid: this.pid, cid: this.cid, code: this.code, lang: this.lang })
                .then(function(res) {
                    _this.$message({
                      message: '恭喜你，代码提交成功',
                      type: 'success'
                    });
                })
                .catch(function (error) {
                    _this.$message({
                      message: '你的代码有些问题,请修改之后重新提交',
                      type: 'error'
                    });
                });
            }
        }
    }
</script>

<style>
    .el-input{
        width: 100%;
    }
</style>