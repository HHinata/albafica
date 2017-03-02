<template>
<div>
    <el-row :gutter="20">
        <el-col :span="24">
            <h1>New Problem</h1>
        </el-col>
        <el-col :span="2"><b>Time:</b></el-col>
        <el-col :span="5"><el-input-number v-model="problem.time_limit"></el-input-number></el-col>
        <el-col :span="2"><b>Memory:</b></el-col>
        <el-col :span="5"><el-input-number v-model="problem.mem_limit"></el-input-number></el-col>
        <el-col :span="24">
            <h3>Title</h3>
            <el-input v-model="problem.title" placeholder="请输入内容"></el-input>
        </el-col>
        <el-col :span="24">
            <h3>Descript</h3>
            <quill-editor v-model="problem.desc" :config="editorOption"></quill-editor>
        </el-col>
        <el-col :span="12">
            <h3>Input</h3>
            <quill-editor v-model="problem.input" :config="editorOption"></quill-editor>
        </el-col>
        <el-col :span="12">
            <h3>Output</h3>
            <quill-editor v-model="problem.output" :config="editorOption"></quill-editor>
        </el-col>
        <el-col :span="12">
            <h3>Sample-input</h3>
            <quill-editor v-model="problem.sample_input" :config="editorOption"></quill-editor>
        </el-col>
        <el-col :span="12">
            <h3>Sample-output</h3>
            <quill-editor v-model="problem.sample_output" :config="editorOption"></quill-editor>
        </el-col>
        <el-col :span="24">
            <el-button type="primary" @click="submit">更新题目</el-button>
        </el-col>
    </el-row>
</div>
</template>

<script>
    export default {
        data () {
            return {
                problem:{
                    id: 0,
                    title: 'This is title input box',
                    desc: '<b>This is descript input box</b>',
                    input: '<b>This is input input box</b>',
                    output: '<b>This is output input box</b>',
                    sample_input: '<b>This is sample-input input box</b>',
                    sample_output: '<b>This is sample-output input box</b>',
                    time_limit: 1000,
                    mem_limit: 65536,
                    platform: '',
                    sign: '',
                },

                editorOption: {
                    theme: 'snow',
                    modules: { toolbar: this.$refs.toolbar }
                },
            }
        },
        mounted: function() {
            this.id = this.$route.params.id;
            this.__construct();
        },
        methods: {
            __construct: function () {
                var _this = this;
                axios.get("problem/show", {params: {id: this.id}})
                    .then(function (res) {
                        _this.problem = res.data;
                    });
            },
            submit: function () {
                var _this = this;
                axios.post("problem", _this.problem)
                    .then(function (res) {
                        _this.$message({
                            message: '恭喜你，题目更新成功',
                            type: 'success'
                        });
                    });
            }
        }
    }
</script>

<style>
    .el-select .el-input {
        width: 110px;
    }
</style>