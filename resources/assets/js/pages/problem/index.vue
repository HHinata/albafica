<template>
<div>
    <el-table :data="problem.data" style="width: 100%" >
        <el-table-column prop="id" label="#" width="100">
        </el-table-column>
        <el-table-column prop="title" label="Title">
        </el-table-column>
        <el-table-column prop="solved" width="150" label="Solved">
        </el-table-column>
        <el-table-column prop="submited" width="150" label="Submited">
        </el-table-column>
        <el-table-column label="操作" width="100">
          <template scope="scope">
            <el-button @click.native.prevent="handleClick(scope.$index, problem.data)" type="text" size="small">查看</el-button>
          </template>
        </el-table-column>
    </el-table>
    <el-row type='flex' justify='center' style="margin-top: 20px">
        <el-pagination layout="prev, pager, next"  @current-change="handleCurrentChange" :total="problem.total" :page-size="problem.per_page">
        </el-pagination>
    </el-row>
</div>
</template>

<script>
    export default {
        data: function () {
            return {
                problem: {
                    data: []
                }
            };
        },
        mounted() {
            this.__construct();
        },
        methods: {
            __construct: function () {
                this.updateProblem(1);
            },
            handleCurrentChange: function (val) {
                this.updateProblem(val);
            },
            updateProblem: function (val) {
                var _this = this;
                axios.get('problem', { params: { page: val }})
                .then(function(res) {
                    _this.problem = res.data;
                });
            },
            handleClick: function (index, rows) {
                window.location.hash = '/problem/'+rows[index].id;
            }
        }
    }
</script>
