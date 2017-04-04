<template>
<div>
    <article id="p-article">
        <header>
            <h1 class="title">{{ post.title }}</h1>
            <p>
                <span>By: <i>{{post.user.name}}</i>,<i>{{post.created_at}}</i></span>
            </p>
        </header>
        <hr>
        <section class="post-section" v-html="post.content"></section>
        <p>
            <el-tag v-for="item in post.tags">{{ item.name }}</el-tag>
        </p>
        <div class="info-bar">
            <div class="info-left-bar">
                <span @click="starOn" v-bind:style="[post.users_count>0?starStyle:'']">收藏</span>
                <span @click="edit(post.id)">编辑</span>
            </div>
            <div class="info-right-bar"><span>By: <i>{{post.user.name}}</i>,<i>{{post.created_at}}</i></span></div>
        </div>
    </article>
    <div style="clear: both"></div>
    <div class="comment" v-for="item in post.comments">
        <el-row>
            <el-col :span="2" style="text-align: center">
                <img width="60%" :src="item.user.avatar" style="border-radius:50%">
            </el-col>
            <el-col :span="22">
                <p><b>{{item.user.name}}</b></p>
                <p v-html="item.content"></p>
                <p>{{item.created_at}}-回复</p>
            </el-col>
        </el-row>
    </div>

    <el-row>
        <el-col :span="20">
            <el-input v-model="comment" placeholder="请输入内容"></el-input>
        </el-col>
        <el-col :span="2">
            <el-button @click="commentTo">评论</el-button>
        </el-col>
    </el-row>
</div>
</template>

<script>
    export default {
        data: function(){
            return {
                post: {
                    user:{},
                    comments: [],
                },
                comment: "",
                starStyle:{color:'blue'}
            };
        },
        mounted() {
            var _this = this;
            axios.get('post/detail', {params:{id:this.$route.params.id}})
                .then(function (res) {
                    _this.post = res.data;
                }).catch(function () {
                    window.location.hash = '/blog';
            });
        },
        methods: {
            commentTo: function () {
                var _this = this;
                axios.put('post/comment', {id: this.post.id, content: this.comment})
                    .then(function (res) {
                        _this.post.comments.push(res.data);
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
            edit: function (index) {
                window.location.hash = '/profile/post/' + index;
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
    #p-article{
        min-height: 10px;
    }
    .post-section{
        border-left: 4px solid rgb(185, 185, 185);
        padding-left: 10px;
        font-size: 1em;
        line-height: 1.4em;
        font-family: verdana,arial,sans-serif;
    }

    .info-bar{
        margin-bottom: 40px;
    }

    .comment{
        margin-bottom: 20px;
    }
</style>