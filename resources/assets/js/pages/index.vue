<template>
<div>
    <article class="home-article" v-for="notice in notices">
        <header>
            <h2 class="title" @click="read(notice.post.id)">{{ notice.post.title }}</h2>
            <p>
                <span>By: <i>{{notice.post.user.name}}</i> Publish: <i>{{notice.post.created_at}}</i></span>
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
                    {post:{content:"",user:{name:""}}}
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

    .home-section img{
        width: 100%;
    }

    .home-section code{
        padding: 0;
        padding-top: 0.2em;
        padding-bottom: 0.2em;
        margin: 0;
        font-size: 85%;
        background-color: rgba(27,31,35,0.05);
        border-radius: 3px;
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

    .comment p{
        margin: 0px;
        padding:0px;
    }
</style>