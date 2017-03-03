<template>
<div>
    <article v-for="post in posts.data">
        <header><h3>{{ post.title }}</h3></header>
        <section v-html="post.content.substr(0, 800) + '...'"></section>
        <div><el-button @click="read(post.id)">Read More</el-button></div>
    </article>
</div>
</template>

<script>
    export default {
        data: function(){
            return {
              posts:[]
            };
        },
        mounted() {
            this.__construct();
        },
        methods: {
            __construct: function () {
                var _this = this;
                axios.get('post')
                    .then(function (res) {
                        _this.posts = res.data;
                    });
            },
            read: function (index) {
                window.location.hash = '/post/' + index;
            }
        }
    }
</script>
