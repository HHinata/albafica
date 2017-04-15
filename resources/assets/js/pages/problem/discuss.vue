<template>
<div>
    <article>
        <header><h1>{{problem.id}}.{{ problem.title }}</h1></header>
    </article>
    <comments ctype="App\Models\Problem" :cid="this.pid" :open="true" :single="true"></comments>
</div>
</template>

<script>
    import Uploader from 'qiniu-web-uploader'
    import comments from '../../components/comments.vue'
    export default {
        components:{comments},
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
