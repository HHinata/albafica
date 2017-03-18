<template>
<div>
    <article>
        <header>
            <h1>{{ post.title }}</h1>
            <p>
                <span><b>Author : </b>{{post.user.name}}</span>
                <span><b>Create : </b>{{post.created_at}}</span>
                <span><b>Update : </b>{{post.updated_at}}</span>
                <span><i @click="starOn" v-bind:style="[post.users_count>0?starStyle:'']" class="el-icon-star-on"></i></span>
            </p>
        </header>
        <hr>
        <section v-html="post.content"></section>
        <p>
            <el-tag v-for="item in post.tags">{{ item.name }}</el-tag>
        </p>
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
                post: {
                    user:{}
                },
                comments: [],
                comment: "",
                editorOption: {
                    theme: 'snow'
                },
                starStyle:{color:'blue'}
            };
        },
        mounted() {
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
        methods: {
            commentTo: function () {
                var _this = this;
                var obj = {type:"post", id: this.post.id, content: this.comment};
                axios.put('comment', obj)
                    .then(function (res) {
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
            },
            starOn: function() {
                var _this = this;
                axios.post('post/star', {id: this.post.id})
                    .then(function (res) {
                        _this.post.users_count ^= 1;
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