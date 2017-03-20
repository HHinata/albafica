<template>
    <el-row>
        <el-col :span="18">
            <h2>团队管理</h2>
        </el-col>
        <el-col :span="6">
            <el-button type="success" @click="newTeam">添加团队</el-button>
        </el-col>
        <el-col :span="24">
            <el-table :data="team.data" style="width: 100%">
                <el-table-column prop="id" label="#">
                </el-table-column>
                <el-table-column prop="name" label="Name">
                </el-table-column>
                <el-table-column label="操作" width="100">
                    <template scope="scope">
                        <el-button @click.native.prevent="handleClick(scope.$index, team.data)" type="text" size="small">编辑</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>
        <el-pagination layout="prev, pager, next"  @current-change="handleCurrentChange" :total="team.total" :page-size="team.per_page">
        </el-pagination>
    </el-row>
</template>

<script>
    export default {
        data: function () {
            return {
                team: {
                    data: []
                }
            };
        },
        mounted() {
            this.updateTeam(1);
        },
        methods: {
            handleCurrentChange: function (val) {
                this.updateTeam(val);
            },
            updateTeam: function (val) {
                var _this = this;
                axios.get('team/rack', { params: { page: val }})
                    .then(function(res) {
                        _this.team = res.data;
                    });
            },
            handleClick: function (index, rows) {
                window.location.hash = 'profile/team/'+rows[index].id;
            },
            newTeam: function () {
                window.location.hash = 'profile/new-team';
            }
        }
    }
</script>
