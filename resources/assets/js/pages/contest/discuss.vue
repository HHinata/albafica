<template>
    <div>
        <article>
            <header><h3>{{ contest.title }}</h3></header>
        </article>
        <div class="comment" v-for="item in contest.comments">
            <el-row>
                <el-col :span="2" style="line-height: 80px; text-align: center">
                    <!--<img :src="item.user.avatar" style="width: 60px;vertical-align: middle; border-radius: 50%"/>-->
                </el-col>
                <el-col :span="22">
                    <!--<p class="username">{{item.user.name}}</p>-->
                    <p v-html="item.content"></p>
                </el-col>
            </el-row>
        </div>
        <div>
            <quill-editor v-model="comment" :config="editorOption"></quill-editor>
            <el-button @click="commentTo">Comment</el-button>
        </div>
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                contest: {comments: [],},
                comment: "",
                editorOption: {
                    theme: 'snow'
                },
            };
        },
        props: ['cid'],
        mounted: function(){
            var _this = this;
            axios.get('contest/speech', { params: { id: this.cid }})
                .then(function(res) {
                    _this.contest = res.data;
                });
        },
        methods: {
            commentTo: function () {
                var _this = this;
                axios.put('contest/comment', { id: this.cid, content: this.comment})
                    .then(function (res) {
                        _this.contest.comments.push(res.data);
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
