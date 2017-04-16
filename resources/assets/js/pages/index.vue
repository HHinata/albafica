<template>
<el-row :gutter="20">
    <el-col :span="18" class="atricles">
        <article class="home-article" v-for="notice in notices">
            <header>
                <h2 class="title" >
                    <a :href="'#/post/'+notice.post.id">{{ notice.post.title }}</a>
                </h2>
                <p>
                    <i class="fa fa-user-o"><a :href="'#/home/' + notice.post.user.name">{{notice.post.user.name}}</a></i>
                    <span>|</span>
                    <span class="fa fa-clock-o">{{notice.post.created_at}}</span>
                </p>
            </header>
            <hr>
            <section class="home-section" v-html="notice.post.content"></section>
            <p>
                <el-tag v-for="item in notice.post.tags">{{ item.name }}</el-tag>
            </p>
            <div class="info-bar">
                <div class="info-left-bar"><a :href="'#/post/'+notice.post.id">阅读全文</a></div>
            </div>
        </article>
    </el-col>
    <el-col :span="6">
        <h3>排行榜</h3>
        <el-table :data="rank" style="width: 100%">
            <el-table-column type="index" width="60">
            </el-table-column>
            <el-table-column label="姓名">
                <template scope="scope">
                    <a :href="'#/home/'+rank[scope.$index].name">
                        {{rank[scope.$index].name}}
                    </a>
                </template>
            </el-table-column>
        </el-table>
        <h3>最新竞赛</h3>
        <el-table :data="contest" style="width: 100%">
            <el-table-column type="index" width="60">
            </el-table-column>
            <el-table-column label="名称">
                <template scope="scope">
                    <a :href="'#/contest/'+contest[scope.$index].id">
                        {{contest[scope.$index].title}}
                    </a>
                </template>
            </el-table-column>
        </el-table>
    </el-col>
</el-row>
</template>

<script>
    export default {
        data: function(){
            return {
                notices:[
                    {
                        post:{
                            content:"",
                            user:
                                {name:""}
                        }
                    }
                ],
                rank: [
                    {name: ''}
                ],
                contest: [
                    {title:''}
                ]
            };
        },
        mounted: function()
        {
            var _this = this;
            axios.get('notice')
                .then(function (res) {
                    _this.notices = res.data;
                });
            axios.get('rank', { params: { page_count: 10 }})
                .then(function (res) {
                    _this.rank = res.data.data;
                });
            axios.get('contest', { params: { page_count: 10 }})
                .then(function (res) {
                    _this.contest = res.data.data;
                });
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
        border-top: 1px solid rgb(185, 185, 185);
        border-bottom: 1px solid rgb(185, 185, 185);
        padding: 5px;
        float:left;
        width: 100%;
    }

    .title{
        color: #3B5998 !important;
    }

    .info-left-bar{
        float: left;
    }

    .comment p{
        margin: 0;
        padding:0;
    }

    .atricles{
        border-right: 1px solid rgb(185, 185, 185);
    }

    a{
        text-decoration: none navy;
        color: rgb(0, 0, 0);
    }

    a:hover{
        color: #444;
    }

    .fa:before{
        padding-right: 0.3em;
    }
</style>