<template>
<div>
    <article>
        <header><h3>{{ problem.title }}</h3></header>
    </article>
    <div class="comment" v-for="item in comments">
        <el-row>
            <el-col :span="2" style="line-height: 80px; text-align: center">
                <img :src="item.user.avatar" style="width: 60px;vertical-align: middle; border-radius: 50%"/>
            </el-col>
            <el-col :span="22">
                <p class="username">{{item.user.name}}</p>
                <p v-html="item.content"></p>
            </el-col>
        </el-row>
    </div>
    <div>
        <div id="toolbar">
            <input type="file" @change='upload' style='display: none !important;'>
            <!-- Add font size dropdown -->
            <select class="ql-size">
                <option value="small"></option>
                <!-- Note a missing, thus falsy value, is used to reset to default -->
                <option selected></option>
                <option value="large"></option>
                <option value="huge"></option>
            </select>
            <!-- Add a bold button -->
            <button class="ql-bold"></button>
            <!-- Add subscript and superscript buttons -->
            <button class="ql-script" value="sub"></button>
            <button class="ql-script" value="super"></button>
            <button @click="upclick"><i class="el-icon-upload"></i></button>
        </div>
        <quill-editor v-model="comment" :config="editorOption"></quill-editor>
        <el-button @click="commentTo">Comment</el-button>
    </div>
</div>
</template>

<script>
    import Uploader from 'qiniu-web-uploader'
    export default {
        data: function () {
            return {
                problem: {},
                comments: [],
                comment: "",
                editorOption: {
                    theme: 'snow',
                    modules: {
                        toolbar: '#toolbar'
                    }
                },
            };
        },
        props: ['pid'],
        mounted: function(){
            this.__construct();
        },
        methods: {
            __construct: function () {
                var _this = this;
                axios.get('problem/detail', { params: { id: this.pid }})
                    .then(function(res) {
                        _this.problem = res.data;
                    });
                axios.get('comment', {params:{id:this.pid, type:"prob"}})
                    .then(function (res) {
                        _this.comments = res.data;
                    });
            },
            upclick: function (event) {
                this.$el.querySelector('input[type=file]').click();
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
                        var img = 'http://'+uptoken.domain+'/'+uploader.imgRes.key;
                        _this.comment += '<img src="'+img+'"/>';
                    });
                    uploader.upload().then(imgRes => {
                            console.log(imgRes);
                    });
                });
            },
            commentTo: function () {
                var _this = this;
                var obj = {type:"prob", id: this.pid, content: this.comment};
                axios.put('comment', obj)
                    .then(function (res) {
                        _this.comments.push(res.data);
                        _this.$message({
                            message: '恭喜你，评论成功',
                            type: 'success'
                        });
                    })
                    .catch(function () {
                        _this.$message({
                            message: '评论失败,请稍后再试',
                            type: 'error'
                        });
                    });
            }
        }
    }
</script>
