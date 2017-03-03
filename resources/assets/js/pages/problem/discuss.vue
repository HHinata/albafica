<template>
<div>
    <article>
        <header><h3>{{ problem.title }}</h3></header>
    </article>
    <div class="comment" v-for="item in comments">
        <p class="username">{{item.user.name}}</p>
        <p v-html="item.content"></p>
    </div>
    <div>
        <quill-editor v-model="comment" :config="editorOption"></quill-editor>
        <el-button @click="commentTo">Comment</el-button>
    </div>
</div>
</template>

<script>
    export default {
        data: function () {
            return {
                problem: {},
                comments: [],
                comment: "",
                editorOption: {
                    theme: 'snow',
                    modules: { toolbar: this.$refs.toolbar }
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
