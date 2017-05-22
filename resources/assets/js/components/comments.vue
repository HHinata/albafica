<template>
    <div>
        <span @click="showComments" v-if="theOpen==false">查看评论</span>
        <span v-if="single==false" @click="commentInput=!commentInput">回复</span>
        <div v-show="theOpen">
            <div class="comment" v-for="item in commentList">
                <el-row>
                    <el-col :span="2" style="text-align: center">
                        <img width="60%" :src="item.user.avatar" style="border-radius:50%">
                    </el-col>
                    <el-col :span="22">
                        <p>
                            <b><a :href="'#/home/' + item.user.name">{{item.user.name}}</a></b>
                            {{item.created_at}}
                        </p>
                        <p v-html="item.content"></p>
                        <comments ctype="App\Models\Comment" :cid='item.id' :open="false" :single="false"></comments>
                    </el-col>
                </el-row>
            </div>
        </div>
        <el-row v-if="commentInput">
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
    export default {
        name: 'comments',
        props: ['ctype', 'cid', 'open', 'single'],
        data() {
            return {
                commentList: [],
                commentInput: false,
                comment: "",
                theOpen: this.open
            }
        },
        mounted:function () {
            this.commentInput = this.single;
            if (this.theOpen) {
                var _this = this;
                axios.get('comment', { params:{type: this.ctype, id: this.cid }})
                    .then(function (res) {
                        _this.commentList = res.data;
                    });
            }
        },
        methods: {
            showComments: function () {
                this.theOpen = true;
                var _this = this;
                axios.get('comment', { params:{type: this.ctype, id: this.cid }})
                    .then(function (res) {
                        _this.commentList = res.data;
                    });
            },
            commentTo: function () {
                var _this = this;
                axios.put('comment', {type: this.ctype, id: this.cid, content: this.comment})
                    .then(function (res) {
                        _this.$message({
                            message: '恭喜你，评论成功',
                            type: 'success'
                        });
                        console.log(_this.commentList)
                        _this.commentList.push(res.data);
                    }).catch(function () {
                        _this.$message({
                            message: '评论失败,请稍后再试',
                            type: 'error',
                            onClose: function () {
                                window.location.hash = '/login';
                            }
                        });
                });
            }
        }
    }
</script>

<style>
    ul {
        list-style: none;
    }
    i.icon {
        display: inline-block;
        width: 15px;
        height: 15px;
        background-repeat: no-repeat;
        vertical-align: middle;
    }
    .icon.folder {
        background-image: url(/src/assets/folder.png);
    }
    .icon.folder-open {
        background-image: url(/src/assets/folder-open.png);
    }
    .icon.file-text {
        background-image: url(/src/assets/file-text.png);
    }
    .tree-menu li {
        line-height: 1.5;
    }
</style>