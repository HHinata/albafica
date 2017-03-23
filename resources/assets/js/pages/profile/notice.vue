<template>
    <el-row>
        <el-dialog title="提示" v-model="dialogVisible" size="tiny">
            <el-autocomplete
                    v-model="notice_obj.post_id.title"
                    :fetch-suggestions="querySearchAsync"
                    @select="handleSelect"
                    placeholder="请输入题目信息">
            </el-autocomplete>
            <span class="demonstration">默认</span>
            <el-date-picker
                    v-model="notice_obj.publish_time"
                    type="datetime"
                    placeholder="选择日期时间">
            </el-date-picker>
            <el-button @click="dialogVisible = false">取 消</el-button>
            <el-button type="primary" @click="addNotice">确 定</el-button>
          </span>
        </el-dialog>

        <el-col :span="18">
            <h2>公告管理</h2>
        </el-col>
        <el-col :span="6">
            <el-button type="success" @click="dialogVisible = true">添加公告</el-button>
        </el-col>
        <el-col :span="24">
            <el-table :data="notice.data" style="width: 100%">
                <el-table-column prop="id" label="#">
                </el-table-column>
                <el-table-column prop="post.title" label="Name">
                </el-table-column>
                <el-table-column label="操作" width="100">
                    <template scope="scope">
                        <el-button @click.native.prevent="handleClick(scope.$index, notice.data)" type="text" size="small">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>
        <el-col :span="24" style="text-align: center">
            <el-pagination layout="prev, pager, next"  @current-change="handleCurrentChange" :total="notice.total" :page-size="notice.per_page">
            </el-pagination></el-col>
    </el-row>
</template>
<script>
    export default{
        data: function () {
            return {
                notice:{
                    data: []
                },
                notice_obj: {
                    post_id: {title:""},
                    publish_time: 0
                },
                dialogVisible: false
            };
        },
        mounted:function () {
            this.updateNotice(1);
        },
        methods:{
            handleSelect:　function (item) {
                this.notice_obj.post_id = item;
            },
            handleCurrentChange: function (val) {
                this.updateNotice(val);
            },
            querySearchAsync(queryString, cb) {
                var _this = this;
                axios.get("post/seek", {params: {query: queryString}})
                    .then(function (res) {
                        cb(res.data);
                    });
            },
            addNotice: function () {
                this.dialogVisible = false;
                var _this = this;
                axios.put('notice', this.notice_obj)
                    .then(function(res) {
                        this.updateNotice(1);
                    });
            },
            handleClick: function (index, rows) {
                //TODO: 删除
            },
            updateNotice: function (val) {
                var _this = this;
                axios.get('notice/rack', { params: { page: val }})
                    .then(function(res) {
                        _this.notice = res.data;
                    });
            },
        }
    }
</script>