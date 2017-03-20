<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="3">
                <img :src="info.avatar" width="100%" style="border-radius: 50%"/>
            </el-col>
            <el-col :span="21">
                <h1>{{info.name}}</h1>
                <small>{{info.info}}</small>
            </el-col>
            <el-col :span="24" style="margin-top: 30px ">
                <el-carousel trigger="click" height="150px">
                    <el-carousel-item>
                        <h3>{{ info.solved }} Accepted</h3>
                    </el-carousel-item>
                    <el-carousel-item>
                        <h3>{{info.solved}} Submited</h3>
                    </el-carousel-item>
                    <el-carousel-item>
                        <h3>{{ info.solved }} Posted</h3>
                    </el-carousel-item>
                </el-carousel>
            </el-col>
            <el-col :span="12">
                <div class="article">
                    <h3>文章 <a style="float:right" class="more" href="">更多</a></h3>
                </div>
                <ul>
                    <li v-for="post in info.posts">{{post.title}}</li>
                </ul>
            </el-col>
            <el-col :span="12">
                <div class="status">
                    <h3>提交状态 <a style="float:right" class="more" href="">更多</a></h3>
                </div>
                <ul>
                    <li v-for="status in info.solution">{{status.problem_id}}</li>
                </ul>
            </el-col>
            <el-col :span="12">
                <div class="article">
                    <h3>关注者 <a style="float:right" class="more" href="">更多</a></h3>
                </div>
                <ul>
                    <li v-for="user in info.followers">{{user.name}}</li>
                </ul>
            </el-col>
            <el-col :span="12">
                <div class="status">
                    <h3>团队 <a style="float:right" class="more" href="">更多</a></h3>
                </div>
                <ul>
                    <li v-for="team in info.teams">{{team.name}}</li>
                </ul>
            </el-col>
        </el-row>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                info:{},
            };
        },
        mounted: function () {
            var _this = this;
            axios.get('user/info')
                .then(function (res) {
                    _this.info = res.data;
                });
        }
    }
</script>

<style>
    .info{
        text-align: center;
        line-height: 20px;
        vertical-align: middle;
    }

    .more{
        color:#00a2ca;
        bottom: 0px;
        font-size: 12px;
        float: right;
    }

    .el-carousel__item{
        text-align: center;
    }

    .el-carousel__item h3 {
        color: #475669;
        font-size: 14px;
        opacity: 0.75;
        line-height: 150px;
        margin: 0;
    }

    .el-carousel__item:nth-child(2n) {
        background-color: #99a9bf;
    }

    .el-carousel__item:nth-child(2n+1) {
        background-color: #d3dce6;
    }
</style>