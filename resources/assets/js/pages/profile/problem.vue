<template>
    <el-row>
        <el-col :span="18">
            <h2>问题管理</h2>
        </el-col>
        <el-col :span="6">
            <el-button type="success" @click="newProblem">添加问题</el-button>
        </el-col>
        <el-col :span="24">
        <el-table :data="problem.data" style="width: 100%">
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
                    <el-button @click.native.prevent="handleClick(scope.$index, problem.data)" type="text" size="small">
                        编辑
                    </el-button>
                </template>
            </el-table-column>
        </el-table></el-col>
        <el-col :span="24" style="text-align: center">
            <el-pagination layout="prev, pager, next" @current-change="handleCurrentChange" :total="problem.total"
                           :page-size="problem.per_page">
            </el-pagination></el-col>
        </el-row>
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
            this.updateProblem(1);
        },
        methods: {
            handleCurrentChange: function (val) {
                this.updateProblem(val);
            },
            updateProblem: function (val) {
                var _this = this;
                axios.get('problem/rack', {params: {page: val}})
                    .then(function (res) {
                        _this.problem = res.data;
                    });
            },
            handleClick: function (index, rows) {
                window.location.hash = '/profile/problem/' + rows[index].id;
            },
            newProblem: function () {
                window.location.hash = 'profile/new-problem';
            }
        }
    }
</script>
