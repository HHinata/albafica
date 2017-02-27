<template>
<div>
    <editor v-model="code" @init="editorInit();" lang="html" theme="chrome" width="100%" height="600"></editor>
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
            };
        },
        props: ['pid'],
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
                console.log(this.pid);
                axios.post('problem/submit', { id: this.pid, code: this.code })
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
