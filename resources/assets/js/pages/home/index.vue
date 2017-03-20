<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="3">
                <img :src="info.avatar" width="100%" style="border-radius: 50%"/>
            </el-col>
            <el-col :span="21">
                <h1>{{info.name}} <i @click="starOn" v-bind:style="[info.followers_count>0?starStyle:'']" class="el-icon-star-on"></i></span></h1><small>{{info.info}}</small>
            </el-col>
        </el-row>
        <hr>
        <el-row :gutter="20">
            <el-col :span="8" class="info"><h3>Accepted</h3><small>{{info.solved}}</small></el-col>
            <el-col :span="8" class="info"><h3>Submited</h3><small>{{info.solved}}</small></el-col>
            <el-col :span="8" class="info"><h3>Posted</h3><small>{{info.solved}}</small></el-col>
        </el-row>
        <hr>
        <el-row :gutter="20">
            <el-col :span="6"><h3>Post</h3>
                <ul>
                    <li v-for="post in info.posts">{{post.title}}</li>
                </ul>
            </el-col>
            <el-col :span="6"><h3>Problem</h3>
                <ul>
                    <li v-for="problem in info.problems">{{problem.title}}</li>
                </ul>
            </el-col>
            <el-col :span="6"><h3>Follower</h3>
                <ul>
                    <li v-for="follower in info.followers">{{follower.name}}</li>
                </ul>
            </el-col>
            <el-col :span="6"><h3>Following</h3>
                <ul>
                    <li v-for="following in info.followings">{{following.name}}</li>
                </ul>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                info: {
                    user:{}
                },
                starStyle:{color:'blue'}
            };
        },
        mounted() {
            var _this = this;
                axios.get('user/info', {params:{name:this.$route.params.name}})
                .then(function (res) {
                    _this.info = res.data;
                });
        },
        methods: {
            starOn: function() {
                var _this = this;
                axios.post('user/star', {id: this.info.id})
                    .then(function (res) {
                        _this.info.followers_count ^= 1;
                    });
            }
        },

    }
</script>
<style>

</style>