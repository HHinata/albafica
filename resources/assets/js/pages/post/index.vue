<template>
<el-row :gutter="20">
    <el-col :span="24">
        <article class="home-article" v-for="post in posts.data">
            <header>
                <h2 class="title">
                    <a :href="'#/post/'+post.id">{{ post.title }}</a>
                </h2>
                <p>
                    <i class="fa fa-user-o"><a :href="'#/home/' + post.user.name">{{post.user.name}}</a></i>
                    <span>|</span>
                    <span class="fa fa-clock-o">{{post.created_at}}</span>
                    <span>|</span>
                    <el-tag v-for="item in post.tags">{{ item.name }}</el-tag>
                </p>
            </header>
            <section class="home-section" v-html="post.content.substr(0, 800) + '...'"></section>
            <div class="info-bar">
                <div class="info-left-bar"><a :href="'#/post/'+post.id">阅读全文</a></div>
            </div>
        </article>
        <el-pagination layout="prev, pager, next"  @current-change="pageSwitch" :total="posts.total"
                       :page-size="posts.per_page">
        </el-pagination>
    </el-col>
</el-row>
</template>

<script>
    export default {
        data: function() {
            return {
                posts: [
                    {
                        user: { }
                    }
                ]
            };
        },
        mounted: function() {
            this.update(1);
        },
        methods: {
            pageSwitch: function (val) {
                this.update(val);
            },
            update: function (val) {
                var _this = this;
                axios.get('post', { params: { page: val }})
                    .then(function(res) {
                        _this.posts = res.data;
                    });
            },
        }
    }
</script>
