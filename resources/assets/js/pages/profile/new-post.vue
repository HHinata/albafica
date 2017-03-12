<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="24">
                <h1>New Post</h1>
            </el-col>
            <el-col :span="12">
                <h3>Title</h3>
                <el-input v-model="post.title" placeholder="请输入内容"></el-input>
            </el-col>
            <el-col :span="6">
                <h3>Tags:</h3>
                <el-select v-model="post.tags" multiple filterable
                           allow-create id="tag" placeholder="请选择文章标签" style="width: 100%">
                    <el-option v-for="item in tag_options" :label="item.label" :value="item.value">
                    </el-option>
                </el-select>
            </el-col>
            <el-col :span="6">
                <h3>Status</h3>
                <el-select v-model="post.private" placeholder="请选择">
                    <el-option
                            v-for="item in options"
                            :label="item.label"
                            :value="item.value">
                    </el-option>
                </el-select>
            </el-col>
            <el-col :span="24">
                <h3>Content</h3>
                <quill-editor v-model="post.content" :config="editorOption"></quill-editor>
            </el-col>
            <el-col :span="24">
                <el-button type="primary" @click="submit">添加文章</el-button>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                post: {
                    title: '',
                    content: '',
                    private: 1,
                    tags:[]
                },
                options:[
                    {
                        value: 1,
                        label: "Private"
                    },
                    {
                        value: 0,
                        label: "Public"
                    }
                ],
                tag_options: [],
                editorOption: {
                    theme: 'snow',
                    height: '100px'
                },
            }
        },
        mounted: function(){
            var _this = this;
            axios.get("tags")
                .then(function (res) {
                    _this.tag_options = res.data;
                });
        },
        methods: {
            submit: function () {
                var _this = this;
                axios.put("post", _this.post)
                    .then(function (res) {
                        _this.$message({
                            message: '恭喜你，比赛添加成功',
                            type: 'success'
                        });
                    });
            }
        }
    }
</script>
