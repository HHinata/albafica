<template>
<div>
    <article class="home-article" v-for="notice in notices">
        <header>
            <h2 class="title" @click="read(notice.post.id)">{{ notice.post.title }}</h2>
            <p>
                <span>By: <i>{{notice.post.created_at}}</i></span>
            </p>
        </header>
        <section class="home-section" v-html="notice.post.content"></section>
        <p>
            <el-tag v-for="item in notice.post.tags">{{ item.name }}</el-tag>
        </p>
        <div class="info-bar">
            <div class="info-left-bar"><a @click="read(notice.post.id)">Read More</a></div>
        </div>
    </article>
</div>
</template>

<script>
    export default {
        data: function(){
            return {
                notices:[
                    {post:{content:""}}
                ]
            };
        },
        mounted() {
            var _this = this;
            axios.get('notice')
                .then(function (res) {
                    _this.notices = res.data;
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