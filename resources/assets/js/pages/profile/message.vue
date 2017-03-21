<template>
    <el-row>
        <el-col :span="24">
            <h2>消息管理</h2>
        </el-col>
        <el-col :span="24">
            <el-table :data="msg.data" style="width: 100%">
                <el-table-column prop="id" label="#" width="100">
                </el-table-column>
                <el-table-column label="内容" >
                    <template scope="scope">
                        <div class="message">
                            <p>{{msg.data[scope.$index].title}}</p>
                            <p>{{msg.data[scope.$index].title}}</p>
                        </div>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>
        <el-col :span="24" style="text-align: center">
            <el-pagination layout="prev, pager, next"  @current-change="handleCurrentChange" :total="msg.total" :page-size="msg.per_page">
            </el-pagination></el-col>
    </el-row>
</template>

<script>
    export default{
        data: function () {
            return {
                msg: {
                    data:[]
                }
            };
        },
        mounted: function () {
            this.updateMessage(1);
        },
        methods: {
            handleCurrentChange: function (val) {
                this.updateMessage(val);
            },
            updateMessage: function (val) {
                var _this = this;
                axios.get('message', { params: { page: val }})
                    .then(function(res) {
                        _this.msg    = res.data;
                    });
            },
        }
    }
</script>

<style>
    .message{
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 1em;
        line-height: 0.5em;
    }
</style>