<template>
    <div>
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
                            <el-button @click.native.prevent="showDialog(scope.$index)" type="text" size="small">编辑</el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-col>
            <el-col :span="24" style="text-align: center">
                <el-pagination layout="prev, pager, next"  @current-change="handleCurrentChange" :total="role.total" :page-size="role.per_page">
                </el-pagination>
            </el-col>
        </el-row>
        <el-dialog title="提示" v-model="dialogVisible" size="tiny">
            <el-row>
                <el-col :span="6">用戶名稱：</el-col>
                <el-col :span="18">
                    <el-select v-model="roleTmp" multiple placeholder="请选择">
                        <el-option
                                v-for="item in options"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-col>
                <el-col :span="24">
                    <el-button type="primary" @click="updateRole">确 定</el-button>
                    <el-button @click="dialogVisible = false">取 消</el-button>
                </el-col>
            </el-row>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                role: {
                    data: [],
                },
                dialogVisible: false,
                roleTmp: [],
                options: [],
                uidTmp: ''
            };
        },
        mounted() {
            this.showRole(1);
            var _this = this;
            axios.get("roles")
                .then(function (res) {
                    _this.options = res.data;
                });
        },
        methods: {
            handleCurrentChange: function (val) {
                this.showRole(val);
            },
            showRole: function (val) {
                var _this = this;
                axios.get('user/role', { params: { page: val }})
                    .then(function(res) {
                        _this.role = res.data;
                    });
            },
            showDialog: function (idx) {
                this.uidTmp = this.role.data[idx].id;
                this.roleTmp = [];
                for (var v in this.role.data[idx].roles) {
                    this.roleTmp.push(this.role.data[idx].roles[v].id);
                }
                this.dialogVisible = true;
            },
            updateRole: function () {
                axios.post("user/role", {uid: this.uidTmp, roles: this.roleTmp})
                    .then(function (res) {
                        console.log(res);
                    });
                this.dialogVisible = false
            }
        }
    }
</script>
