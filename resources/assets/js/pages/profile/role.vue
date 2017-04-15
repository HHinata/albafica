<template>
    <el-row>
        <el-col :span="24">
            <h2>权限管理</h2>
        </el-col>
        <el-col :span="24">
            <el-table :data="role.data" style="width: 100%">
                <el-table-column type="index" label="#" width="150">
                </el-table-column>
                <el-table-column prop="name" label="Name">
                </el-table-column>
                <el-table-column label="角色" width="100">
                    <template scope="scope">
                        <el-button @click.native.prevent="handleClick(scope.$index, contest.data)" type="text" size="small">编辑</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>
        <el-col :span="24" style="text-align: center">
            <el-pagination layout="prev, pager, next"  @current-change="handleCurrentChange" :total="role.total" :page-size="role.per_page">
            </el-pagination></el-col>
    </el-row>
</template>

<script>
    export default {
        data: function () {
            return {
                role: {
                    data: []
                }
            };
        },
        mounted() {
            this.updateRole(1);
        },
        methods: {
            handleCurrentChange: function (val) {
                this.updateRole(val);
            },
            updateRole: function (val) {
                var _this = this;
                axios.get('user/role', { params: { page: val }})
                    .then(function(res) {
                        _this.role = res.data;
                    });
            },
        }
    }
</script>
