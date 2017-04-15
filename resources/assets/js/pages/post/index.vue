<template>
<div>
    <article class="home-article" v-for="post in posts.data">
        <header>
            <h2 class="title" @click="read(post.id)">{{ post.title }}</h2>
            <p>
                <span>By: <a :href="'#/home/' + post.user.name">{{post.user.name}}</a>,<i>{{post.created_at}}</i></span>
            </p>
        </header>
        <section class="home-section" v-html="post.content.substr(0, 800) + '...'"></section>
        <p>
            <el-tag v-for="item in post.tags">{{ item.name }}</el-tag>
        </p>
        <div class="info-bar">
            <div class="info-left-bar"><a @click="read(post.id)">Read More</a></div>
            <div class="info-right-bar"><span>By: <a :href="'#/home/' + post.user.name">{{post.user.name}}</a>,<i>{{post.created_at}}</i></span></div>
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
