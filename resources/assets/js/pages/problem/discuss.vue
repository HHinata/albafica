<template>
<div>
    <article>
        <header><h1>{{problem.id}}.{{ problem.title }}</h1></header>
    </article>

    <div class="comment" v-for="item in problem.comments">
        <el-row>
            <el-col :span="2">
                <!--<img width="80%" :src="item.user.avatar" style="border-radius:50%">-->
            </el-col>
            <el-col :span="21">
                <!--<p><b>{{item.user.name}}</b>@<i>{{item.created_at}}</i></p>-->
                <p v-html="item.content"></p>
            </el-col>
        </el-row>
    </div>

    <el-row>
        <el-col :span="20">
            <el-input v-model="comment" placeholder="请输入内容"></el-input>
        </el-col>
        <el-col :span="2">
            <el-button @click="commentTo">评论</el-button>
        </el-col>
    </el-row>

</div>
</template>

<script>
    import Uploader from 'qiniu-web-uploader'
    export default {
        data: function () {
            return {
                problem: {comments: [],},
                comment: ""
            };
        },
        props: ['pid'],
        mounted: function(){
            var _this = this;
            axios.get('problem/speech', { params: { id: this.pid }})
                .then(function(res) {
                    _this.problem = res.data;
                });
        },
        methods: {
            commentTo: function () {
                var _this = this;
                axios.put('problem/comment', {id: this.pid, content: this.comment})
                    .then(function (res) {
                        _this.problem.comments.push(res.data);
                        _this.$message({
                            message: '恭喜你，评论成功',
                            type: 'success'
                        });
                    })
                    .catch(function () {
                        _this.$message({
                            message: '评论失败,请稍后再试',
                            type: 'error'
                        });
                    });
            }
        }
    }
</script>
