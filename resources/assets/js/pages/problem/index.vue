<template>
    <div>
        <el-table :data="problem.data" style="width: 100%">
            <el-table-column prop="id" label="#" width="100">
            </el-table-column>
            <el-table-column label="Title">
                <template scope="scope">
                    <a :href="'#/problem/'+problem.data[scope.$index].id">
                        {{problem.data[scope.$index].title}}
                    </a>
                </template>
            </el-table-column>
            <el-table-column>
                <template scope="scope">
                    <el-tag v-for="item in problem.data[scope.$index].tags">{{ item.name }}</el-tag>
                </template>
            </el-table-column>
            <el-table-column prop="solved" width="150" label="Solved">
            </el-table-column>
            <el-table-column prop="submited" width="150" label="Submited">
            </el-table-column>
        </el-table>
        <el-row type='flex' justify='center' style="margin-top: 20px">
            <el-pagination layout="prev, pager, next" @current-change="pageSwitch" :total="problem.total"
                           :page-size="problem.per_page">
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
            this.update(1);
        },
        methods: {
            pageSwitch: function (val) {
                this.update(val);
            },
            update: function (val) {
                var _this = this;
                axios.get('problem', {params: { page: val } })
                    .then(function (res) {
                        _this.problem = res.data;
                    });
            }
        }
    }
</script>
<style>
    .el-tag{
        margin-right: 10px;
    }
</style>
