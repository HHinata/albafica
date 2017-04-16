<template>
<div>
    <article id="p-article">
        <header>
            <h1 class="title">{{ post.title }}</h1>
            <p>
                <i class="fa fa-user-o"><a :href="'#/home/' + post.user.name">{{post.user.name}}</a></i>
                <span>|</span>
                <span class="fa fa-clock-o">{{post.created_at}}</span>
                <span>|</span>
                <el-tag v-for="item in post.tags">{{ item.name }}</el-tag>
            </p>
        </header>
        <hr>
        <section class="post-section" v-html="post.content"></section>
        <div class="info-bar">
            <div class="info-left-bar">
                <span @click="starOn" v-bind:style="[post.users_count>0?starStyle:'']">收藏</span>
                <a :href="'#/profile/post/'+post.id">编辑</a>
            </div>
        </div>
    </article>
    <div style="clear: both"></div>
    <comments ctype="App\Models\Post" :cid="this.$route.params.id" :open="true" :single="true"></comments>
</div>
</template>

<script>
    import comments from '../../components/comments.vue'
    export default {
        components:{comments},
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
        mounted: function() {
            var _this = this;
            axios.get('post/detail', {params:{id:this.$route.params.id}})
                .then(function (res) {
                    _this.post = res.data;
                }).catch(function () {
                    window.location.hash = '/blog';
                });
        },
        methods: {
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
        margin: 10px;
        font-family: verdana,arial,sans-serif;
    }

    .info-bar{
        margin-bottom: 40px;
    }

    .comment{
        margin-bottom: 20px;
    }
</style>