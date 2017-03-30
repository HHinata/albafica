<template>
<div>
    <el-row :gutter="20">
        <el-col :span="24">
            <h1>New Problem</h1>
        </el-col>
        <el-col :span="2"><b>Title:</b></el-col>
        <el-col :span="8">
            <el-input v-model="problem.title" placeholder="请输入内容"></el-input>
        </el-col>
        <el-col :span="2"><b>Time:</b></el-col>
        <el-col :span="5"><el-input-number v-model="problem.time_limit"></el-input-number></el-col>
        <el-col :span="2"><b>Memory:</b></el-col>
        <el-col :span="5"><el-input-number v-model="problem.mem_limit"></el-input-number></el-col>
        <el-col :span="2"><b>Tags:</b></el-col>
        <el-col :span="4">
            <el-select v-model="problem.tags" multiple filterable
                       allow-create id="tag" placeholder="请选择文章标签" style="width: 100%">
                <el-option v-for="item in options" :label="item.label" :value="item.value">
                </el-option>
            </el-select>
        </el-col>
        <el-col :span="10">
            <el-input :disabled="problem.platform=='local'" placeholder="请输入内容" v-model="problem.sign">
                <el-select v-model="problem.platform" slot="prepend" placeholder="请选择">
                    <el-option label="HDU" value="hdu"></el-option>
                    <el-option label="POJ" value="poj"></el-option>
                    <el-option label="ZOJ" value="zoj"></el-option>
                    <el-option label="LOCAL" value="local"></el-option>
                </el-select>
                <el-button :disabled="problem.platform=='local'" slot="append" icon="search" @click="crawler"></el-button>
            </el-input>
        </el-col>
        <el-col :span="8" v-if="problem.platform=='local'">
            <input type="file" name="data_input" @change="upload" style='display: none !important;'>
            <input type="file" name="data_output" @change="upload" style='display: none !important;'>
            <input type="file" @change='upload' style='display: none !important;'>
            <el-tooltip class="item" effect="dark" :content="problem.data_input" placement="top-start">
                <el-button @click="upclick('data_input')" type="primary">输入样例上传<i class="el-icon-upload el-icon--right"></i></el-button>
            </el-tooltip>
            <el-tooltip class="item" effect="dark" :content="problem.data_output" placement="top-start">
                <el-button @click="upclick('data_output')" type="primary">输出样例上传<i class="el-icon-upload el-icon--right"></i></el-button>
            </el-tooltip>
        </el-col>
        <el-col :span="24">
            <h3>Descript</h3>
            <quill-editor v-model="problem.description" :config="editorOption"></quill-editor>
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
            <el-button type="primary" @click="submit">添加题目</el-button>
        </el-col>
    </el-row>
</div>
</template>

<script>
    import Uploader from 'qiniu-web-uploader'
    export default {
        data () {
            return {
                problem:{
                    title: '',
                    description: '',
                    input: '',
                    output: '',
                    sample_input: '',
                    sample_output: '',
                    data_input:'',
                    data_output:'',
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
        mounted: function () {
            var _this = this;
            axios.get("tags")
                .then(function (res) {
                    _this.options = res.data;
                });
        },
        methods: {
            crawler: function () {
                var _this = this;
                axios.get("problem/crawler", { params:{plat:this.problem.platform, sign: this.problem.sign} })
                    .then(function (res) {
                        _this.problem = res.data;
                        _this.problem.tags = [];
                    });
            },
            submit: function () {
                var _this = this;
                axios.put("problem", _this.problem)
                    .then(function (res) {
                        _this.$message({
                            message: '恭喜你，题目添加成功',
                            type: 'success'
                        });
                    });
            },
            selectChange: function (value) {
                console.log(value)
            },
            upclick: function (name) {
                this.$el.querySelector('input[name='+name+']').click();
            },
            upload: function(event) {
                var _this = this;
                axios.get('/token').then(function(res){
                    let uptoken = res.data;
                    let file = event.target.files[0];
                    let uploader = new Uploader(file, uptoken);
                    uploader.on('progress', e => {
                        console.log(uploader.percent); //加载进度
                    console.log(uploader.offset); //字节
                });
                    uploader.on('complete', e => {
                        _this.problem[event.target.name] = 'http://'+uptoken.domain+'/'+uploader.imgRes.key;
                        console.log(_this.problem)
                });
                    uploader.upload().then(imgRes => {
                        console.log(imgRes);
                });
                });
            },
        }
    }
</script>

<style>
    .el-select .el-input {
        width: 110px;
    }
    #tag > .el-input
    {
        width: 100%;
    }
</style>