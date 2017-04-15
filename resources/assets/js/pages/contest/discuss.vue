<template>
    <div>
        <article>
            <header><h3>{{ contest.title }}</h3></header>
        </article>
        <comments ctype="App\Models\Contest" :cid="this.cid" :open="true" :single="true"></comments>
    </div>
</template>

<script>
    import comments from '../../components/comments.vue'
    export default {
        components:{comments},
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
