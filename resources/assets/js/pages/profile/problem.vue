<template>
    <el-row>
        <el-col :span="18">
            <h2>问题管理</h2>
        </el-col>
        <el-col :span="6">
            <a href="#/profile/new-problem"><el-button type="success">添加问题</el-button></a>
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
                        <a :href="'#/problem/'+problem.data[scope.$index].id">查看</a>
                        <a :href="'#/profile/problem/'+problem.data[scope.$index].id">编辑</a>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>
        <el-col :span="24" style="text-align: center">
            <el-pagination layout="prev, pager, next" @current-change="pageSwitch" :total="problem.total"
                           :page-size="problem.per_page">
            </el-pagination>
        </el-col>
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
            this.update(1);
        },
        methods: {
            pageSwitch: function (val) {
                this.update(val);
            },
            update: function (val) {
                var _this = this;
                axios.get('problem/rack', {params: {page: val}})
                    .then(function (res) {
                        _this.problem = res.data;
                    });
            }
        }
    }
</script>
