<template>
<div>
    <article v-for="post in posts.data">
        <hr>
        <header>
            <h3 @click="read(post.id)">{{ post.title }}</h3>
            <p>
                <span><b>Author : </b>{{post.user.name}}</span>
                <span><b>Create : </b>{{post.created_at}}</span>
                <span><b>Update : </b>{{post.updated_at}}</span>
            </p>
        </header>
        <section v-html="post.content.substr(0, 800) + '...'"></section>
        <p>
            <el-tag v-for="item in post.tags">{{ item.name }}</el-tag>
        </p>
        <div><el-button @click="read(post.id)">Read More</el-button></div>
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
