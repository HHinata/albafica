<template>
<div style="margin-top:20px">
    <el-table :data="contest.data" style="width: 100%">
        <el-table-column prop="title" label="Name">
        </el-table-column>
        <el-table-column prop="start_time" width="100" label="Start">
        </el-table-column>
        <el-table-column prop="end_time" width="100" label="End">
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
            this.__construct();
        },
        methods: {
            __construct: function () {
                this.updateContest(1);
            },
            handleCurrentChange: function (val) {
                this.updateContest(val);
            },
            updateContest: function (val) {
                var _this = this;
                axios.get('contest', { params: { page: val }})
                .then(function(res) {
                    _this.contest = res.data;
                });
            }
        }
    }
</script>
