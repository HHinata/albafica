<template>
    <div>
        <article>
            <header><h3>{{ contest.title }}</h3></header>
        </article>
        <div class="comment" v-for="item in comments">
            <p class="username">{{item.user.name}}</p>
            <p v-html="item.content"></p>
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
                contest: {},
                comments: [],
                comment: "",
                editorOption: {
                    theme: 'snow',
                    modules: { toolbar: this.$refs.toolbar }
                },
            };
        },
        props: ['cid'],
        mounted: function(){
            this.__construct();
        },
        methods: {
            __construct: function () {
                var _this = this;
                axios.get('contest/detail', { params: { id: this.cid }})
                    .then(function(res) {
                        _this.contest = res.data;
                    });
                axios.get('comment', {params:{id:this.cid, type:"cont"}})
                    .then(function (res) {
                        _this.comments = res.data;
                    });
            },
            commentTo: function () {
                var _this = this;
                var obj = {type:"cont", id: this.cid, content: this.comment};
                axios.put('comment', obj)
                    .then(function (res) {
                        _this.comments.push(res.data);
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
