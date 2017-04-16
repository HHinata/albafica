<template>
    <el-row>
    <el-col :span="18">
        <h2>比赛管理</h2>
    </el-col>
    <el-col :span="6">
        <a href="#/profile/new-contest"><el-button type="success">添加比赛</el-button></a>
    </el-col>
    <el-col :span="24">
        <el-table :data="contest.data" style="width: 100%">
            <el-table-column type="index" label="#">
            </el-table-column>
            <el-table-column prop="title" label="Name">
            </el-table-column>
            <el-table-column prop="start_time" :formatter="time" width="200" label="Start">
            </el-table-column>
            <el-table-column prop="end_time" :formatter="time" width="200" label="End">
            </el-table-column>
            <el-table-column label="操作" width="100">
                <template scope="scope">
                    <a :href="'#/profile/contest/'+contest.data[scope.$index].id">编辑</a>
                    <a :href="'#/contest/'+contest.data[scope.$index].id">查看</a>
                </template>
            </el-table-column>
        </el-table>
    </el-col>
        <el-col :span="24" style="text-align: center">
            <el-pagination layout="prev, pager, next"  @current-change="pageSwitch" :total="contest.total" :page-size="contest.per_page">
            </el-pagination></el-col>
        </el-row>
</template>

<script>
    export default {
        data: function () {
            return {
                contest: {
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
                axios.get('contest/rack', { params: { page: val }})
                    .then(function(res) {
                        _this.contest = res.data;
                    });
            },
            time: function (row, column) {
                return new Date(parseInt(row[column.property]) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
            }
        }
    }
</script>
