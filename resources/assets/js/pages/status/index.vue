<template>
<div>
    <el-table :data="status.data" style="width: 100%" @cell-click="cellClick" >
        <el-table-column prop="id" label="#" width="100" class-name="link"></el-table-column>
        <el-table-column prop="user.name" label="Who" width="100"></el-table-column>
        <el-table-column prop="problem.title" label="Problem"s></el-table-column>
        <el-table-column prop="lang" label="Lang" width="100"></el-table-column>
        <el-table-column prop="result" label="Result"></el-table-column>
        <el-table-column prop="time" width="100" label="Time"></el-table-column>
        <el-table-column prop="memory" width="100" label="Memory"></el-table-column>
    </el-table>
    <el-row type='flex' justify='center' style="margin-top: 20px">
        <el-pagination layout="prev, pager, next"  @current-change="handleCurrentChange" :total="status.total" :page-size="status.per_page">
        </el-pagination>
    </el-row>
</div>
</template>

<script>
    export default {
        data: function () {
            return {
                status: {
                    data: []
                }
            };
        },
        mounted() {
            this.updateStatus(1);
        },
        methods: {
            handleCurrentChange: function (val) {
                this.updateStatus(val);
            },
            updateStatus: function (val) {
                var _this = this;
                axios.get('solution', { params: { page: val }})
                .then(function(res) {
                    _this.status = res.data;
                });
            },
            cellClick: function (row, column, cell, event) {
                if (cell.cellIndex != 0)    return;
                window.location.hash = '/status/'+row.id;
            }
        }
    }
</script>

<style>
    .link{
        color: #600090;
    }
    .link:hover{
        cursor: pointer;
    }
</style>