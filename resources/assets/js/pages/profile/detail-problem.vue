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
        <el-col :span="12">
            <h3>Title</h3>
            <el-input v-model="problem.title" placeholder="请输入内容"></el-input>
        </el-col>
        <el-col :span="12">
            <h3>Tags:</h3>
            <el-select v-model="problem.tags" multiple filterable
                       allow-create id="tag" placeholder="请选择文章标签" style="width: 100%">
                <el-option v-for="item in options" :label="item.label" :value="item.value">
                </el-option>
            </el-select>
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
                    title: '',
                    desc: '',
                    input: '',
                    output: '',
                    sample_input: '',
                    sample_output: '',
                    time_limit: 0,
                    mem_limit: 0,
                    platform: '',
                    sign: '',
                    tags: [],
                },
                options: [],
                editorOption: {
                    theme: 'snow'
                },
            }
        },
        mounted: function() {
            this.id = this.$route.params.id;
            var _this = this;
            axios.get("problem/show", {params: {id: this.id}})
                .then(function (res) {
                    _this.problem = res.data;
                });
            axios.get("problem/tags")
                .then(function (res) {
                    _this.options = res.data;
                });
        },
        methods: {
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