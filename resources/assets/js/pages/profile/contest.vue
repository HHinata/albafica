<template>
    <div>
        <el-table :data="contest.data" style="width: 100%">
            <el-table-column prop="title" label="Name">
            </el-table-column>
            <el-table-column prop="start_time" :formatter="time" width="300" label="Start">
            </el-table-column>
            <el-table-column prop="end_time" :formatter="time" width="300" label="End">
            </el-table-column>
            <el-table-column label="操作" width="100">
                <template scope="scope">
                    <el-button @click.native.prevent="handleClick(scope.$index, contest.data)" type="text" size="small">编辑</el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-row type='flex' justify='center' style="margin-top: 20px">
            <el-pagination layout="prev, pager, next"  @current-change="handleCurrentChange" :total="contest.total" :page-size="contest.per_page">
            </el-pagination>
        </el-row>
    </div>
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
        mounted() {
            this.updateContest(1);
        },
        methods: {
            handleCurrentChange: function (val) {
                this.updateContest(val);
            },
            updateContest: function (val) {
                var _this = this;
                axios.get('contest/rack', { params: { page: val }})
                    .then(function(res) {
                        _this.contest = res.data;
                    });
            },
            handleClick: function (index, rows) {
                window.location.hash = 'profile/contest/'+rows[index].id;
            },
            time: function (row, column) {
                return new Date(parseInt(row[column.property]) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
            },
        }
    }
</script>
