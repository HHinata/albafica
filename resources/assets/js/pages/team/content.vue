<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="24">
                <el-col :span="4">
                    <img :src="team.avatar" style="border-radius: 50%;width: 128px;height: 128px;"/>
                </el-col>
                <el-col :span="20">
                    <div><h1>{{team.name}} </span></h1><small>{{team.desc}}</small></div>
                </el-col>
            </el-col>
            <el-col :span="24" style="margin-top: 50px">
                <el-tabs >
                    <el-tab-pane label="动态">
                        <comments ctype="App\Models\Team" :cid="this.$route.params.id" :open="true" :single="true">
                        </comments>
                    </el-tab-pane>
                    <el-tab-pane label="用户">
                        <el-table :data="team.users" style="width: 100%">
                            <el-table-column type="index" label="#" width="180">
                            </el-table-column>
                            <el-table-column prop="name" label="姓名">
                            </el-table-column>
                            <el-table-column :formatter='roleFormat' prop="pivot.role"
                                    label="身份" width="180">
                            </el-table-column>
                            <el-table-column v-if="team.inTeam==1" label="操作" width="100">
                                <template scope="scope">
                                    <el-button @click.native.prevent="switchRole(scope.$index, team.users)" type="text" size="small">
                                        {{roleSwitchFormat(scope.$index, team.users)}}
                                    </el-button>
                                </template>
                            </el-table-column>
                        </el-table>
                    </el-tab-pane>
                    <el-tab-pane label="相关竞赛">
                        <el-table :data="team.contests" style="width: 100%">
                            <el-table-column type="index" label="#"
                                    width="180">
                            </el-table-column>
                            <el-table-column prop="title" label="名称">
                            </el-table-column>
                            <el-table-column :formatter="time" prop="start_time"
                                    label="开始时间" width="220">
                            </el-table-column>
                            <el-table-column :formatter="time" prop="end_time"
                                    label="结束时间" width="220">
                            </el-table-column>
                        </el-table>
                    </el-tab-pane>
                </el-tabs>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import comments from '../../components/comments.vue'
    export default {
        components: { comments },
        data: function() {
            return {
                team: {
                    name: '',
                    desc: '',
                    users:[],
                    contests:[],
                    comments:[],
                    inTeam: null
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
            roleFormat:function (row) {
                return this.roleOptions[row.pivot.role];
            },
            time: function (row, column) {
                return new Date(parseInt(row[column.property]) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
            },
            switchRole: function (index, rows) {
                var _this = this;
                axios.post('team/switch', {id: this.team.id, uid: rows[index].id})
                    .then(function (res) {
                        _this.$message({
                            message: '恭喜你，操作成功',
                            type: 'success'
                        });
                    })
                    .catch(function () {
                        _this.$message({
                            message: '操作失败,请稍后再试',
                            type: 'error'
                        });
                    });
            },
            roleSwitchFormat: function (index, rows) {
                if (rows[index].pivot.role == 0)    return '同意';
                return '踢出';
            }
        }
    }
</script>
