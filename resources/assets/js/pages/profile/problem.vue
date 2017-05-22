<template>
    <div>
        <el-row>
            <el-col :span="15">
                <h2>问题管理</h2>
            </el-col>
            <el-col :span="9">
                <a href="#/profile/new-problem"><el-button type="success">添加问题</el-button></a>
                <a><el-button type="success" @click="exportDialog=true">导出问题</el-button></a>
                <a><el-button type="success" @click="importAction">导入问题</el-button></a>
                <input type="file" @change='upload' style='display: none !important;'>
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
        <el-dialog title="导出题目" v-model="exportDialog">
            <el-table :data="problem.data" height="250" @selection-change="handleSelectionChange">
                <el-table-column type="selection" width="55">
                </el-table-column>
                <el-table-column prop="id" label="#" width="100">
                </el-table-column>
                <el-table-column prop="title" label="Title">
                </el-table-column>
            </el-table>
            <el-button type="success" @click="makeDownload">导出</el-button>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                problem: {
                    data: []
                },
                exportDialog: false,
                exportData: [],
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
            },
            handleSelectionChange: function (val) {
                this.exportData = val;
            },
            makeDownload: function () {
                axios.post('problem/export', {problemSet: this.exportData})
                    .then(function (res) {
                        window.open('/problem/download?uuid='+res.data);
                    });
            },
            importAction: function () {
                this.$el.querySelector('input[type=file]').click();
            },
            upload: function(event) {
                var _this = this;
                var file = event.target.files[0];
                var form = new FormData();
                form.append("data", file);
                axios.post('problem/import', form)
                    .then(function(res){
                });
            },
        }
    }
</script>
