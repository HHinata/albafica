<template>
    <div>
        <el-table :data="post.data" style="width: 100%">
            <el-table-column prop="id" label="#">
            </el-table-column>
            <el-table-column prop="title" label="Name">
            </el-table-column>
            <el-table-column label="操作" width="100">
                <template scope="scope">
                    <el-button @click.native.prevent="handleClick(scope.$index, post.data)" type="text" size="small">编辑</el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-row type='flex' justify='center' style="margin-top: 20px">
            <el-pagination layout="prev, pager, next"  @current-change="handleCurrentChange" :total="post.total" :page-size="post.per_page">
            </el-pagination>
        </el-row>
    </div>
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
            this.updatePost(1);
        },
        methods: {
            handleCurrentChange: function (val) {
                this.updatePost(val);
            },
            updatePost: function (val) {
                var _this = this;
                axios.get('post/rack', { params: { page: val }})
                    .then(function(res) {
                        _this.post = res.data;
                    });
            },
            handleClick: function (index, rows) {
                window.location.hash = 'profile/post/'+rows[index].id;
            }
        }
    }
</script>
