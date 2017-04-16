<template>
    <el-row>
        <el-col :span="18">
            <h2>团队管理</h2>
        </el-col>
        <el-col :span="6">
            <a href="#/profile/new-team">
                <el-button type="success">添加团队</el-button>
            </a>
        </el-col>
        <el-col :span="24">
            <el-table :data="team.data" style="width: 100%">
                <el-table-column prop="id" label="#" width="100"></el-table-column>
                <el-table-column prop="name" label="Name"></el-table-column>
                <el-table-column label="操作" width="100">
                    <template scope="scope">
                        <a :href="'#/team/'+team.data[scope.$index].id">查看</a>
                        <a :href="'#/profile/team/'+team.data[scope.$index].id">编辑</a>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>
        <el-col :span="24" style="text-align: center">
            <el-pagination layout="prev, pager, next"  @current-change="pageSwitch"
                           :total="team.total" :page-size="team.per_page">
            </el-pagination>
        </el-col>
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
        mounted: function() {
            this.update(1);
        },
        methods: {
            pageSwitch: function (val) {
                this.update(val);
            },
            update: function (val) {
                var _this = this;
                axios.get('team/rack', { params: { page: val }})
                    .then(function(res) {
                        _this.team = res.data;
                    });
            }
        }
    }
</script>
