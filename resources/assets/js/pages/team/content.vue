<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="24">
                <el-col :span="4">
                    <img :src="team.avatar" width="100%" style="border-radius: 50%"/>
                </el-col>
                <el-col :span="20">
                    <div><h1>{{team.name}} </span></h1><small>{{team.desc}}</small></div>
                    <div><button @click="apply" style="margin-top: 15px">Apply</button></div>
                </el-col>
            </el-col>
            <el-col :span="24" style="margin-top: 50px">
                <el-tabs type="border-card">
                    <el-tab-pane label="动态">
                        <div class="comment" v-for="item in team.comments">
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
                    </el-tab-pane>
                    <el-tab-pane label="用户">
                        <el-table
                                :data="team.users"
                                style="width: 100%">
                            <el-table-column
                                    type="index"
                                    label="#"
                                    width="180">
                            </el-table-column>
                            <el-table-column
                                    prop="name"
                                    label="姓名">
                            </el-table-column>
                            <el-table-column
                                    :formatter='roleFormat'
                                    prop="pivot.role"
                                    label="身份"
                                    width="180">
                            </el-table-column>
                        </el-table>
                    </el-tab-pane>
                    <el-tab-pane label="相关竞赛">
                        <el-table
                                :data="team.contests"
                                style="width: 100%">
                            <el-table-column
                                    type="index"
                                    label="#"
                                    width="180">
                            </el-table-column>
                            <el-table-column
                                    prop="title"
                                    label="名称">
                            </el-table-column>
                            <el-table-column
                                    prop="desc"
                                    label="描述">
                            </el-table-column>
                            <el-table-column
                                    prop="start_time"
                                    label="开始时间"
                                    width="180">
                            </el-table-column>
                        </el-table>
                    </el-tab-pane>
                </el-tabs>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                team: {
                    name: '',
                    desc: '',
                    users:[],
                    contests:[],
                    comments:[]
                },
                comment:"",
                roleOptions:{
                    0:'游客',
                    1:'创建者',
                    2:'成员'
                }
            }
        },
        mounted: function() {
            this.id = this.$route.params.id;
            var _this = this;
            axios.get("team/detail", {params: {id: this.id}})
                .then(function (res) {
                    _this.team = res.data;
                });
        },
        methods: {
            apply: function () {
                axios.post("team/apply", {id: this.id})
                    .then(function (res) {
                        _this.team = res.data;
                    });
            },
            commentTo: function () {
                var _this = this;
                axios.put('team/comment', {id: this.id, content: this.comment})
                    .then(function (res) {
                        _this.team.comments.push(res.data);
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
            },
            roleFormat:function (row) {
                return this.roleOptions[row.pivot.role];
            }
        }
    }
</script>
