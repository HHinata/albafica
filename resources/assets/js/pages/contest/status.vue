<template>
    <div>
        <el-table :data="status.data" style="width: 100%" @cell-click="cellClick" >
            <el-table-column prop="id" label="#" width="100" class-name="link"></el-table-column>
            <el-table-column prop="user.name" label="Who" width="100"></el-table-column>
            <el-table-column prop="problem.title" label="Problem"></el-table-column>
            <el-table-column prop="created_at" label="Create Time"></el-table-column>
            <el-table-column prop="lang" :formatter='langFormat' label="Lang" width="100"></el-table-column>
            <el-table-column prop="result" :formatter='resultFormat' label="Result"></el-table-column>
            <el-table-column prop="time" width="100" label="Time"></el-table-column>
            <el-table-column prop="memory" width="100" label="Memory"></el-table-column>
        </el-table>
        <el-row type='flex' justify='center' style="margin-top: 20px">
            <el-pagination layout="prev, pager, next"  @current-change="handleCurrentChange" :total="status.total" :page-size="status.per_page">
            </el-pagination>
        </el-row>
        <el-dialog title="代码" v-model="dialogVisible" size="tiny">
            <pre><code>{{code}}</code></pre>
            <span slot="footer" class="dialog-footer">
                <el-button type="primary" @click="dialogVisible = false">确 定</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                status: {
                    data: []
                },
                dialogVisible: false,
                code:"",
                resOptions: {
                    0:"Queuing",
                    1:"Accepted",
                    2:"Wrong Answer",
                    3:"Presentation Error",
                    4:"Compilation Error",
                    5:"Runtime Error",
                    6:"Time Limit Exceeded",
                    7:"Memory Limit Exceeded",
                    8:"Output Limit Exceeded",
                },
                langOptions: {
                    1:'C++',
                    2:'C',
                    3:'JAVA'
                },
            };
        },
        props: ['cid'],
        mounted() {
            this.updateStatus(1);
        },
        methods: {
            handleCurrentChange: function (val) {
                this.updateStatus(val);
            },
            updateStatus: function (val) {
                var _this = this;
                axios.get('solution', { params: { page: val, cid: this.cid}})
                    .then(function(res) {
                        _this.status = res.data;
                    });
            },
            cellClick: function (row, column, cell, event) {
                if (cell.cellIndex != 0)    return;
                var _this = this;
                axios.get('solution/detail', { params: { id: row.id }})
                    .then(function(res) {
                        _this.code = res.data.code;
                        _this.dialogVisible = true;
                    });
            },
            resultFormat: function (row, column) {
                return this.resOptions[row.result];
            },
            langFormat: function (row, column) {
                return this.langOptions[row.lang];
            },
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