<template>
<div>
    <article>
        <header>
            <h1 class="title">{{ post.title }}</h1>
            <p>
                <span>By: <i>{{post.user.name}}</i>,<i>{{post.created_at}}</i></span>
                <span><i @click="starOn" v-bind:style="[post.users_count>0?starStyle:'']" class="el-icon-star-on"></i></span>
            </p>
        </header>
        <hr>
        <section class="post-section" v-html="post.content"></section>
        <p>
            <el-tag v-for="item in post.tags">{{ item.name }}</el-tag>
        </p>
        <div class="info-bar">
            <div class="info-left-bar"><a @click="read(post.id)">Read More</a></div>
            <div class="info-right-bar"><span>By: <i>{{post.user.name}}</i>,<i>{{post.created_at}}</i></span></div>
        </div>
    </article>

    <div class="comment" v-for="item in post.comments">
        <el-row>
            <el-col :span="2">
                <!--<img width="80%" :src="item.user.avatar" style="border-radius:50%">-->
            </el-col>
            <el-col :span="21">
                <!--<p><b>{{item.user.name}}</b>@<i>{{item.created_at}}</i></p>-->
                <p v-html="item.content"></p>
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