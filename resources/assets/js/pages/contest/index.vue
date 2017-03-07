<template>
<div>
    <el-table :data="contest.data" style="width: 100%">
        <el-table-column prop="title" label="Name">
        </el-table-column>
        <el-table-column prop="start_time" :formatter="time" width="250" label="Start">
        </el-table-column>
        <el-table-column prop="end_time" :formatter="time" width="250" label="End">
        </el-table-column>
        <el-table-column label="Status" :formatter="calStatus" width="80">
        </el-table-column>
        <el-table-column label="操作" width="100">
          <template scope="scope">
            <el-button @click.native.prevent="handleClick(scope.$index, contest.data)" type="text" size="small">查看</el-button>
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
                    data: [],
                    timestamp: 0
                }
            };
        },
        mounted() {
            this.__construct();
        },
        methods: {
            __construct: function () {
                this.updateContest(1);
                this.timestamp = Date.parse(new Date());
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
            },
            handleClick: function (index, rows) {
                window.location.hash = '/contest/'+rows[index].id;
            },
            time: function (row, column) {
                return new Date(parseInt(row[column.property]) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
            },
            calStatus: function (row, column) {
                return row.start_time>this.timestamp?"Scheduled":(row.end_time>this.timestamp?"Running":"Ended");
            }
        }
    }
</script>
