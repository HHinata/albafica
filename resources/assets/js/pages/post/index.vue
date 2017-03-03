<template>
<div>
    <article>
        <header><h3>{{ post.title }}</h3></header>
        <section v-html="post.content"></section>
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
        data: function(){
            return {
                post: {},
                comments: [],
                comment: "",
                editorOption: {
                    theme: 'snow'
                },
            };
        },
        mounted() {
            this.__construct();
        },
        methods: {
            __construct: function () {
                var _this = this;
                axios.get('post/detail', {params:{id:this.$route.params.id}})
                    .then(function (res) {
                        _this.post = res.data;
                    });
                axios.get('comment', {params:{id:this.$route.params.id, type:"post"}})
                    .then(function (res) {
                        _this.comments = res.data;
                    });
            },
            commentTo: function () {
                var _this = this;
                var obj = {type:"post", id: this.post.id, content: this.comment};
                axios.put('comment', obj)
                    .then(function (res) {
                        console.log(res.data);
                        _this.comments.push(res.data);
                        _this.$message({
                            message: '恭喜你，评论成功',
                            type: 'success'
                        });
                    }).catch(function () {
                    _this.$message({
                        message: '评论失败,请稍后再试',
                        type: 'error'
                    });
                });
            }
        }
    }
</script>
<style>
    .comment p{
        line-height: 16px;
    }

    .comment{
        border-top: 1px solid #e5e9ef;
    }

    .username{
        color: #d4d4d4;
    }
</style>