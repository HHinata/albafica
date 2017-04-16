<template>
    <el-row>
        <el-col :span="18">
            <h2>文章管理</h2>
        </el-col>
        <el-col :span="6">
            <a href="#/profile/new-post"><el-button type="success">添加文章</el-button></a>
        </el-col>
        <el-col :span="24">
            <el-table :data="post.data" style="width: 100%">
                <el-table-column prop="id" label="#" width="100">
                </el-table-column>
                <el-table-column prop="title" label="Name">
                </el-table-column>
                <el-table-column label="操作" width="100">
                    <template scope="scope">
                        <a :href="'#/post/'+post.data[scope.$index].id">查看</a>
                        <a :href="'#/profile/post/'+post.data[scope.$index].id">编辑</a>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>
        <el-col :span="24" style="text-align: center">
            <el-pagination layout="prev, pager, next"  @current-change="pageSwitch"
                           :total="post.total" :page-size="post.per_page">
            </el-pagination>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        data: function () {
            return {
                post: {
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
                axios.get('post/rack', { params: { page: val }})
                    .then(function(res) {
                        _this.post = res.data;
                    });
            }
        }
    }
</script>
