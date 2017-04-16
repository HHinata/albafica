<template>
<div>
    <el-table :data="contest.data" style="width: 100%">
        <el-table-column type="index" label="#" width="180">
        </el-table-column>
        <el-table-column prop="title" label="Name">
            <template scope="scope">
                <a :href="'#/contest/'+contest.data[scope.$index].id">{{contest.data[scope.$index].title}}</a>
            </template>
        </el-table-column>
        <el-table-column prop="start_time" :formatter="time" width="250" label="Start">
        </el-table-column>
        <el-table-column prop="end_time" :formatter="time" width="250" label="End">
        </el-table-column>
        <el-table-column label="Status" :formatter="calStatus" width="100">
        </el-table-column>
    </el-table>
    <el-row type='flex' justify='center' style="margin-top: 20px">
        <el-pagination layout="prev, pager, next"  @current-change="pageSwitch" :total="contest.total"
                       :page-size="contest.per_page">
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
        mounted: function() {
            this.update(1);
            this.timestamp = Date.parse(new Date())/1000;
        },
        methods: {
            pageSwitch: function (val) {
                this.update(val);
            },
            update: function (val) {
                var _this = this;
                axios.get('contest', { params: { page: val }})
                .then(function(res) {
                    _this.contest = res.data;
                });
            },
            time: function (row, column) {
                return new Date(parseInt(row[column.property]) * 1000).toLocaleString()
                    .replace(/年|月/g, "-").replace(/日/g, " ");
            },
            calStatus: function (row, column) {
                return row.start_time>this.timestamp?"Scheduled":(row.end_time>this.timestamp?"Running":"Ended");
            }
        }
    }
</script>
