<template>
<div>
    <article class="home-article" v-for="post in posts.data">
        <header>
            <h2 class="title" @click="read(post.id)">{{ post.title }}</h2>
            <p>
                <span>By: <i>{{post.user.name}}</i>,<i>{{post.created_at}}</i></span>
            </p>
        </header>
        <section class="home-section" v-html="post.content.substr(0, 800) + '...'"></section>
        <p>
            <el-tag v-for="item in post.tags">{{ item.name }}</el-tag>
        </p>
        <div class="info-bar">
            <div class="info-left-bar"><a @click="read(post.id)">Read More</a></div>
            <div class="info-right-bar"><span>By: <i>{{post.user.name}}</i>,<i>{{post.created_at}}</i></span></div>
        </div>
    </article>
</div>
</template>

<script>
    export default {
        data: function(){
            return {
              posts:[
                  {user:{}}
              ]
            };
        },
        mounted() {
            var _this = this;
            axios.get('post')
                .then(function (res) {
                    _this.posts = res.data;
                });
        },
        methods: {
            read: function (index) {
                window.location.hash = '/post/' + index;
            }
        }
    }
</script>
<style>
    .home-article{
        margin-bottom: 100px;
    }

    .home-section{
        border-left: 4px solid rgb(185, 185, 185);
        padding-left: 10px;
        font-size: 1em;
        line-height: 1.4em;
        max-height: 400px;
        font-family: verdana,arial,sans-serif;
        overflow:hidden;white-space:nowrap;
        text-overflow: ellipsis;
    }

    .info-bar{
        border: 1px solid rgb(185, 185, 185);
        padding: 5px;
        float:left;
        width: 100%;
    }

    .title{
        color: #3B5998 !important;
    }

    .info-right-bar{
        float: right;
    }

    .info-left-bar{
        float: left;
    }
</style>